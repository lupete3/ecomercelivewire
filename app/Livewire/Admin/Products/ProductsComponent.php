<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Attributes\On;

class ProductsComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $slug, $short_description, $long_description, $regular_price, $sale_price,
           $quantity = 100, $image, $new_image, $images = [], $images_new = [], $size, $color, $category_id;

    public $product_id;
    public $editForm = false;
    public $form_title = "Ajouter un nouveau produit";
    public $productPerPage = 10;
    public $search;
    public $fileInputId;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->fileInputId = rand();
    }

    public function changeProductPerPage($pageSize)
    {
        $this->productPerPage = $pageSize;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name,' . $this->product_id,
            'short_description' => 'required|string|max:255',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'image' => $this->editForm ? 'nullable|image|max:5024' : 'required|image|max:5024',
            'images.*' => $this->editForm ? 'nullable|image|max:5024' : 'required|image|max:5024',
            'category_id' => 'required|string',
        ];
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('short_description', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orWhere('category_id', 'like', '%' . $this->search . '%')
            ->paginate($this->productPerPage);

        return view('livewire.admin.products.products-component',
        ['products' => $products, 'categories' => $categories]);
    }

    public function showAddProductModal()
    {
        $this->resetForm();
        $this->dispatch('showAddProductModal');
    }

    public function addProduct()
    {
        $this->validate();
        $filename = $this->saveImage($this->image);
        //$filename_images = $this->saveImage($this->images);
        $filenames = [];
        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                $filenames[] = $this->saveImage($img);
            }
        }

        Product::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'image' => $filename,
            'images' => json_encode($filenames), // <<< ici, tu enregistres en JSON
            'category_id' => $this->category_id,
        ]);

        $this->dispatch('hideAddProductModal');
        flash()->success('Produit ajouté avec succès.');
        $this->resetForm();
    }

    public function showEditProductModal($id)
    {
        $product = Product::findOrFail($id);

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->long_description = $product->long_description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->quantity = $product->quantity;
        $this->new_image = $product->image;
        $this->images_new = json_decode($product->images, true) ?? [];
        $this->category_id = $product->category_id;

        $this->editForm = true;
        $this->form_title = "Modifier le produit";

        $this->dispatch('showAddProductModal');
    }

    public function updateProduct()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);

        if ($this->image) {
            if ($product->image) {
                $imagePath = public_path('admin/products/' . $product->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $filename = $this->saveImage($this->image);
            $product->image = $filename;
        }

        if ($this->images) {
            $filenames = [];
            foreach ($this->images as $img) {
                $filenames[] = $this->saveImage($img);
            }
            $product->images = json_encode($filenames);
        }

        $product->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id,
            'images' => $product->images, // soit les nouvelles, soit les anciennes

        ]);

        $this->resetForm();
        flash()->success('Produit mis à jour avec succès.');
    }

    private function saveImage($image)
    {
        $filename = Str::uuid()->toString() .'.' . $image->extension();

        if ($image) {
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->toPng()->save(public_path('admin/products/' . $filename));
        }

        return $filename;
    }

    public function sendConfirm($id, $type, $message, $title)
    {
        $this->product_id = $id;

        $this->dispatch('clientConfirm',
            type: $type,
            title: $title,
            message: $message,
            id: $this->product_id,
            action: 'productAction'
        );
    }

    public function sendConfirmRemoveImage($id, $type, $message, $title)
    {

        $this->dispatch('clientConfirm',
            type: $type,
            title: $title,
            message: $message,
            id: $id,
            action: 'productImageAction'
        );
    }

    #[On('productAction')]
    public function destroy($id)
    {
        $this->product_id = $id;
        $product = Product::find($this->product_id);

        if ($product && $product->image) {
            $imagePath = public_path('admin/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();
        $this->dispatch('confirmDeleteProduct');
        flash()->success('Produit supprimé.');
    }

    #[On('productImageAction')]
    public function removeImage($id)
    {
        $product = Product::findOrFail($this->product_id);
        if (isset($this->images_new[$id])) {
            unset($this->images_new[$id]);
            $this->images_new = [...$this->images_new]; // ← Astuce clean pour rafraîchir Livewire
        }
        $product->images = $this->images_new;
        $product->save();
    }



    public function resetForm()
    {
        $this->dispatch('hideAddProductModal');
        $this->reset([
            'name', 'slug', 'short_description', 'long_description', 'regular_price',
            'sale_price', 'quantity', 'image', 'images', 'size', 'color',
            'category_id', 'product_id', 'editForm'
        ]);
        $this->form_title = "Ajouter un nouveau produit";
        $this->new_image = '';
        $this->images_new = [];
    }
}

