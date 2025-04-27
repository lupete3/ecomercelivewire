<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Slider;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Attributes\On;

class SliderComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $top_title, $slug, $title, $sub_title, $offer, $link, $image, $new_image, $status, $start_date, $end_date;
    public $slider_id;
    public $editForm = false;
    public $form_title = "Ajouter un nouveau slider";
    public $productPerPage = 10;
    public $search;
    public $fileInputId;


    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->fileInputId = rand(); // ou uniqid()
    }

    protected function rules()
    {
        return [
            'top_title'   => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:sliders,slug,' . $this->slider_id,
            'title'       => 'required|string|max:255',
            'sub_title'   => 'nullable|string|max:255',
            'offer'       => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'image'   => $this->editForm ? 'nullable|image|max:5024' : 'required|image|max:5024',
            'status'      => 'required|in:0,1',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function render()
    {
        $sliders = Slider::where('top_title', 'like', '%'. $this->search .'%')
            ->orWhere('title', 'like', '%'. $this->search .'%')
            ->orWhere('sub_title', 'like', '%'. $this->search .'%')
            ->orWhere('offer', 'like', '%'. $this->search .'%')
            ->orWhere('start_date', 'like', '%'. $this->search .'%')
            ->orWhere('end_date', 'like', '%'. $this->search .'%')
            ->orWhere('type', 'like', '%'. $this->search .'%')
            ->orWhere('status', 'like', '%'. $this->search .'%')
            ->paginate($this->productPerPage);
        return view('livewire.admin.slider.slider-component', ['sliders' => $sliders]);
    }

    public function showAddSliderModal()
    {
        $this->resetForm();
        $this->dispatch('showAddSliderModal');
    }

    public function addSlider()
    {
        $this->validate();

        $filename = $this->saveImage($this->image);

        Slider::create([
            'top_title'  => $this->top_title,
            'slug'       => Str::slug($this->slug),
            'title'      => $this->title,
            'sub_title'  => $this->sub_title,
            'offer'      => $this->offer,
            'link'       => $this->link,
            'image'      => $filename,
            'status'     => $this->status,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'type'       => 'Slider'
        ]);

        $this->dispatch('hideAddSliderModal');
        flash()->success('Slider ajouté avec succès.');
        $this->resetForm();
    }

    public function showEditSliderModal($id)
    {
        $slider = Slider::findOrFail($id);

        $this->slider_id   = $slider->id;
        $this->top_title   = $slider->top_title;
        $this->slug        = $slider->slug;
        $this->title       = $slider->title;
        $this->sub_title   = $slider->sub_title;
        $this->offer       = $slider->offer;
        $this->new_image   = $slider->image;
        $this->link        = $slider->link;
        $this->status      = $slider->status;
        $this->start_date  = $slider->start_date;
        $this->end_date    = $slider->end_date;

        $this->editForm = true;
        $this->form_title = "Modifier le slider";

        $this->dispatch('showAddSliderModal');
    }

    public function updateSlider()
    {
        $this->validate();

        $slider = Slider::findOrFail($this->slider_id);

        if ($this->image) {
            if ($slider->image) {
                $imagePath = public_path('admin/slider/' . $slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $filename = $this->saveImage($this->image);
            $slider->image = $filename;
        }

        $slider->update([
            'top_title'  => $this->top_title,
            'slug'       => Str::slug($this->slug),
            'title'      => $this->title,
            'sub_title'  => $this->sub_title,
            'offer'      => $this->offer,
            'link'       => $this->link,
            'status'     => $this->status,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
        ]);

        $this->resetForm();
        flash()->success('Slider mis à jour avec succès.');
    }

    private function saveImage($image)
    {
        $filename = time().'.'.$image->extension();

        if($image)
        {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image);
            // resize image proportionally to 300px width
            //$image->scale(width: 300, height: 200);
            // save modified image in new format
            $image->toPng()->save(base_path('public/admin/slider/'.$filename));
        }

        return $filename;
    }

    public function sendConfirm($idSlider, $type, $message, $title)
    {
        $this->slider_id = $idSlider;

        $this->dispatch('clientConfirm',
            type: $type,
            title: $title,
            message: $message,
            id: $this->slider_id,
            action: 'sliderAction'
        );

    }

    #[On('sliderAction')]
    public function destroy($id)
    {
        $this->slider_id = $id;
        $slider = Slider::find($this->slider_id);

        if ($this->image) {
            if ($slider->image) {
                $imagePath = public_path('admin/slider/' . $slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $slider->delete();
        $this->dispatch('confirmDeleteShippingAdress');
        flash()->success('Slide supprimé.');

    }

    public function resetForm()
    {
        $this->dispatch('hideAddSliderModal');
        $this->reset([
            'top_title', 'slug', 'title', 'sub_title', 'offer', 'link',
            'image', 'status', 'start_date', 'end_date',
            'slider_id', 'editForm'
        ]);
        $this->form_title = "Ajouter un nouveau slider";
        $this->new_image = ''; // forcer le reset du champ file
    }
}
