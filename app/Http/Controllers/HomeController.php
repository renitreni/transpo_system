<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function __invoke(string $lang)
    {
        switch ($lang) {
            case 'en':
                $direction = 'ltr';
                break;
            case 'ar':
                $direction = 'rtl';
                break;
            default:
                $direction = 'ltr';
                $lang = 'en';
                break;
        }
        App::setLocale($lang);

        return view('index')->with([
            'dir' => $direction ?? 'ltr',
            'lang' => $lang,
        ]);
    }
}
