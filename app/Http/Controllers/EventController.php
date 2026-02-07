<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('events')
            ->where('is_internal', 0)
            ->whereDate('event_date', '>=', Carbon::now())
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('pages.evenements', [
            'events' => $events,
            // 'header_title' => "Calendrier des Événements", // Le header automatique dans partials/header.blade.php s'en chargera si non défini, mais on peut forcer ici
            'header_bg' => asset('assets/img/canvas.png'),
            'title' => "Événements - VIP GPI"
        ]);
    }
}