<?php
namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class NoteManager extends Component
{
    public $title_fr = '';
    public $title_en = '';
    public $description_fr = '';
    public $description_en = '';
    public $locale;

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
    }

    public function save()
    {
        $this->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
        ]);

        Note::create([
            'title' => [
                'fr' => $this->title_fr,
                'en' => $this->title_en,
            ],
            'description' => [
                'fr' => $this->description_fr,
                'en' => $this->description_en,
            ],
        ]);

        $this->reset(['title_fr', 'title_en', 'description_fr', 'description_en']);
        session()->flash('message', 'Note saved successfully!');
    }

    public function render()
    {
        $notes = Note::all();
        return view('livewire.note-manager', compact('notes'));
    }
}
