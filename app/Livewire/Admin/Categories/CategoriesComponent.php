<?php


namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoriesComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $categoriesPerPage = 10;
    public $search_term;
    public $search;

    public $idCategory;
    public $name;
    public $slug;
    public $image;
    public $status = 1;

    public $new_image;
    public $form_title = 'Ajouter une Catégorie';
    public $editCategoryForm = false;

    public function mount()
    {
        $this->fill(request()->only('search'));
        $this->search_term = '%'.$this->search.'%';
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function showAddCategoryModal()
    {
        $this->resetForm();
        $this->form_title = 'Ajouter une Catégorie';
        $this->editCategoryForm = false;
        $this->dispatch('showAddCategoryModal');
    }

    public function showEditCategoryModal($id)
    {
        $this->resetForm();

        $category = Category::findOrFail($id);

        $this->idCategory = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->status = $category->status;
        $this->new_image = $category->image;

        $this->image = null; // Important : réinitialiser l'image temporaire
        $this->editCategoryForm = true;
        $this->form_title = "Modifier la catégorie";

        $this->dispatch('showAddCategoryModal');
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image',
            'status' => 'required|boolean',
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;

        $image_name = time().'.'.$this->image->extension();
        $category->image = $image_name;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->image);
        $image->toPng()->save(public_path('admin/categories/'.$image_name));

        $category->save();

        $this->dispatch('refreshComponent');
        $this->hideAddCategoryModal();

        flash()->success('Catégorie ajoutée.');
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required|boolean',
        ]);

        $category = Category::find($this->idCategory);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;

        if ($this->image) {
            if ($category->image && file_exists(public_path('admin/categories/'.$category->image))) {
                unlink('admin/categories/'.$category->image);
            }

            $image_name = time().'.'.$this->image->extension();
            $category->image = $image_name;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            $image->toPng()->save(public_path('admin/categories/'.$image_name));
        }

        $category->save();

        $this->dispatch('refreshComponent');
        $this->hideAddCategoryModal();

        flash()->success('Catégorie mise à jour.');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if ($category->image && file_exists(public_path('admin/categories/'.$category->image))) {
            unlink('admin/categories/'.$category->image);
        }

        $category->delete();
        flash()->success('Catégorie supprimée.');
    }

    public function hideAddCategoryModal()
    {
        $this->resetForm();
        $this->dispatch('hideAddCategoryModal');
    }

    public function resetForm()
    {
        $this->idCategory = null;
        $this->name = '';
        $this->slug = '';
        $this->status = null;
        $this->image = null;
        $this->new_image = null;
        $this->editCategoryForm = false;
        $this->form_title = "Ajouter une catégorie";
    }

    public function changeCategoryPerPage($pageSize)
    {
        $this->categoriesPerPage = $pageSize;
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->categoriesPerPage);

        return view('livewire.admin.categories.categories-component', ['categories' => $categories]);
    }
}

