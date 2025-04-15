<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderComponent extends Component
{
    use WithPagination;

    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $productPerPage = 10;
    public $search_term;
    public $search;
    public $idSlider;

    public $idSlide;
    public $top_title;
    public $slug;
    public $title;
    public $sub_title;
    public $link;
    public $offer;
    public $image;
    public $start_date;
    public $end_date;
    public $status = 1;

    public $new_image;
    public $form_title = 'Ajouter Slider';
    public $editForm = false;

    public function changeProductPerPage($pageSize)
    {
        $this->productPerPage = $pageSize;
    }

    public function mount()
    {
        $this->fill(request()->only('search'));
        $this->search_term = '%'.$this->search.'%';
    }

    public function showAddSliderModal()
    {
        $this->dispatch('showAddSliderModal');
    }

    public function showEditSliderModal($idSlider)
    {
        $this->form_title = 'Modifier Slider';
        $this->editForm = true;

        $slider = Slider::where('id',$idSlider)->first();

        $this->idSlide = $slider->id;
        $this->top_title = $slider->top_title;
        $this->slug = $slider->slug;
        $this->title = $slider->title;
        $this->sub_title = $slider->sub_title;
        $this->new_image = $slider->image;
        $this->link = $slider->link;
        $this->offer = $slider->offer;
        $this->start_date = $slider->start_date;
        $this->end_date = $slider->end_date;
        $this->status = $slider->status;

        $this->dispatch('showAddSliderModal');
    }

    public function sendConfirm($idSlider, $type, $message, $title)
    {
        $this->idSlider = $idSlider;

        $this->dispatch('sliderConfirm',
            type: $type,
            title: $title,
            message: $message,
            id: $this->idSlider
        );
    }

    #[On('sliderConfirmAction')]
    public function deleteShippingAdress($id)
    {
        $this->idSlider = $id;

        $this->dispatch('confirmDeleteShippingAdress');

        $slider = Slider::find($this->idSlider);

        if($slider->image)
        {

            unlink('admin/slider/'.$slider->image);

        }

        $slider->delete();

        flash()->success('Le slider est supprimé.');

    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->top_title);
    }

    public function addSlider()
    {
        $this->validate([
            'top_title' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'offer' => 'required',
            'image' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $slider = new Slider();

        $slider->top_title = $this->top_title;
        $slider->slug = $this->slug;
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->link = $this->link;
        $slider->offer = $this->offer;
        $slider->start_date = $this->start_date;
        $slider->end_date = $this->end_date;
        $slider->status = $this->status;
        $slider->type = 'Slider';


        $image_name = time().'.'.$this->image->extension();
        $slider->image = $image_name;

        if($this->image)
        {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            // resize image proportionally to 300px width
            //$image->scale(width: 300, height: 200);
            // save modified image in new format
            $image->toPng()->save(base_path('public/admin/slider/'.$image_name));
        }

        $slider->save();

        $this->dispatch('refreshComponent');

        $this->hideAddSliderModal();

        flash()->success('Le slide ajouté.');
    }

    public function updateSlider()
    {
        $this->validate([
            'top_title' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'offer' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $slider = Slider::find($this->idSlide);

        $slider->top_title = $this->top_title;
        $slider->slug = $this->slug;
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->link = $this->link;
        $slider->offer = $this->offer;
        $slider->start_date = $this->start_date;
        $slider->end_date = $this->end_date;
        $slider->status = $this->status;
        $slider->type = 'Slider';

        if($this->image)
        {
            unlink('admin/slider/'.$slider->image);

            $image_name = time().'.'.$this->image->extension();
            $slider->image = $image_name;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            // resize image proportionally to 300px width
            //$image->scale(width: 300, height: 200);
            // save modified image in new format
            $image->toPng()->save(base_path('public/admin/slider/'.$image_name));
        }

        $slider->save();

        $this->dispatch('refreshComponent');

        $this->hideAddSliderModal();

        flash()->success('Le slide modifié.');
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

    public function hideAddSliderModal()
    {
        $this->idSlide = '';
        $this->top_title = '';
        $this->slug = '';
        $this->title = '';
        $this->sub_title = '';
        $this->new_image = '';
        $this->link = '';
        $this->offer = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->status = '';

        $this->dispatch('hideAddSliderModal');

    }
}
