<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Support\Facades\Http;

class EntryController extends Controller
{
    public function index()
    {
        return view('entry', [
            'entries' =>  Entry::all()
        ]);
    }

    public function ajaxView(Entry $entry)
    {
        return $entry;
    }

    public function ajaxExchange()
    {
        return Http::get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
    }
}
