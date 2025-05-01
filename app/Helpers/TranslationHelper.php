<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Lang;

class TranslationHelper
{
    public static function getTranslation($key, $locale)
    {
        return Lang::get($key, [], $locale);
    }
}
