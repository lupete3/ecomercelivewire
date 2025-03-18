<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SliderComponent extends Component
{
    use WithPagination;

    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $productPerPage = 10;
    public $search_term;
    public $search;
    public $idSlider;

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

        $idSlider = Slider::find($this->idSlider)->delete();

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
        $slider->image = $this->image;
        $slider->start_date = $this->start_date;
        $slider->end_date = $this->end_date;
        $slider->status = $this->status;
        $slider->type = 'Slider';

        $slider->save();

        $this->dispatch('refreshComponent');

        $this->dispatch('hideAddSliderModal');
        $this->reset();

        flash()->success('Le slide ajouté.');
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
}
