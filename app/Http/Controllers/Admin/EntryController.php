<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryStoreRequest;
use App\Models\Entry;

class EntryController extends Controller
{
    public function index()
    {
        return view('admin.entry', [
            'entries' => Entry::author()->get()
        ]);
    }

    public function store(EntryStoreRequest $request)
    {
        Entry::query()->create([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return route('admin.entry.index');
    }

    public function show(int $entry)
    {
        return Entry::author()->find($entry);
    }

    public function update(EntryStoreRequest $request, int $entry)
    {
        $entry = Entry::author()->find($entry);

        $entry->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return route('admin.entry.index');
    }

    public function destroy(int $entry)
    {
        $entry = Entry::author()->find($entry);
        $entry->delete();
        return redirect()->route('admin.entry.index');
    }
}
