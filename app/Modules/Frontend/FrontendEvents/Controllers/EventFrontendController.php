<?php

namespace App\Modules\Frontend\FrontendEvents\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Events\Models\Events;

class EventFrontendController extends Controller
{
    public function __construct()
    {
        # code...
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Events::query()->available()->orderBy('updated_at', 'DESC')->get();

        // dd($events);

        return view('FrontendEvents::index')->with([
            'events' => $events
        ]);
    }

    public function show($slug)
    {
        $event = Events::query()->where('slug', $slug)->firstOrFail();

        return view("FrontendEvents::detail")->with([
            'event' => $event
        ]);
    }
}
