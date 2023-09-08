<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Event;
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $keyword = $request->keyword;
        $events = Event::with('country')
        ->where('title', 'LIKE', '%' . $keyword . '%')
        ->orWhere('start_datetime', 'LIKE', '%' . $keyword . '%')
        ->orWhereHas('country', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        })
        ->get();
        return view('events.index', compact('events', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.create', compact('countries', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request): RedirectResponse
    {
        // hal pertama disini saya ingin memeriksa apakah kita memiliki gambarnya
        if($request->hasFile('image')) {                                    // memeriksa apakah ada file gambar yang diunggah
            $data = $request->validated();                                  // mengambil data yang telah divalidasi
            $data['image'] = Storage::putFile('event', $request->file('image'));   // mengunggah file gambar yang diunggah oleh pengguna ke penyimpanan
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);                     // Slug biasanya digunakan dalam URL

            $event = Event::create($data);                                  // save data yang ada dalam array
            $event->tags()->attach($request->tags);                         // menghubungkan data dan sekalian melampirkan permintaan pajak;
            return to_route('events.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach(); // untuk menghapus hubungan pajak dan event
        $event->delete();
        return to_route('events.index');
    }
}
