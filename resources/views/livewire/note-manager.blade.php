<div class="max-w-2xl mx-auto p-4 col-md-12">

    <div>
        <h1>{{ __('messages.polo') }}</h1>
        {{ Lang::get('messages.polo', [], $locale) }}
    </div>


    <!-- Liste des notes -->
    <div>
        <h2 class="text-xl font-semibold mb-2">{{ __('messages.notes') }}</h2>
        @if ($notes->isEmpty())
            <p>{{ __('messages.no_notes') }}</p>
        @else
            <ul class="space-y-4">
                @foreach ($notes as $note)
                    <li class="border p-4 rounded-md">
                        <h3 class="text-lg font-medium">{{ $note->title[$locale] }}</h3>
                        <p class="text-gray-600">{{ $note->description[$locale] }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
