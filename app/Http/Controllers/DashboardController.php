<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $ongoingEvents = Event::where('start_datetime', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('start_datetime')
            ->get();

        return view('dashboard', [
            'ongoingEvents' => $ongoingEvents,
        ]);
    }

    public function tampilData()
    {
        $events = Event::all();
        return view('dashboard', compact('events'));
    }
}