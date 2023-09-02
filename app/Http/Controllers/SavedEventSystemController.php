<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Concerns\Events;

class SavedEventSystemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $savedEvent = $event->savedEvents()->where('user_id', auth()->id())->first();
        if (!is_null($savedEvent)) {
            $savedEvent->delete();
            return null;
        } else {
            $savedEvent = $event->savedEvents()->create([
                'user_id' => auth()->id()
            ]);
            return $savedEvent;
        }
    }

    public function coba() {
        $data = ['andre', 19, 'Masak'];
        return view('coba.index', compact('data'));
    }

    public function tampilData($id) {
        $event = DB::table('events')->where('id', '=', $id)->select('id', 'title', 'description', 'address', 'image')->first();
        // dd('event');
        return response()->json($event, 200); // http code
    }


    public function muncul($id){
        dd($id);
    }
}