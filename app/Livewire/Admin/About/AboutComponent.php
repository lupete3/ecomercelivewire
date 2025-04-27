<?php

namespace App\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutComponent extends Component
{
    use WithFileUploads;

    public $idAbout;
    public $title;
    public $description;
    public $image;
    public $new_image;
    public $form_title = 'Mettre à jour vos informations';

    public function mount()
    {
        $about = About::first();

        if ($about) {
            $this->idAbout = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->new_image = $about->image;
        }
    }

    public function updateAbout()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // pas 'required'
        ]);

        $about = About::find($this->idAbout);

        $about->title = $this->title;
        $about->description = $this->description;

        if ($this->image) {
            if ($about->image && file_exists(public_path('admin/about/'.$about->image))) {
                unlink(public_path('admin/about/'.$about->image));
            }

            $image_name = time() . '.' . $this->image->extension();
            $about->image = $image_name;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image->getRealPath());
            $image->toPng()->save(public_path('admin/about/'.$image_name));
        }

        $about->save();

        // Rafraîchir l'image affichée après update
        $this->new_image = $about->image;
        $this->image = null;
        $this->mount();

        $this->dispatch('refreshComponent');


        flash()->success('Informations mises à jour.');
    }

    public function render()
    {
        return view('livewire.admin.about.about-component');
    }
}
