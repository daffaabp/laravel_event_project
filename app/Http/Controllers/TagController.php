<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $newTagName = $request->input('new_tag');

        if ($newTagName) {
            $tag = Tag::create([
                'name' => $newTagName,
                'slug' => Str::slug($newTagName)
            ]);

            return redirect()->route('events.create')->with([
                'new_tag_added' => true,
                'new_tag_name' => $newTagName
            ]);
        }

        return redirect()->route('events.create'); // Redirect back to the create event page
    }
}