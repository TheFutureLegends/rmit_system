<?php

namespace App\Modules\Frontend\FrontendEvents\Controllers;

use Illuminate\Support\Facades\DB;
use App\Modules\Backend\Events\Repositories\EventRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Events\Models\Events;

class EventFrontendController extends Controller
{
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
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
        $event = $this->eventRepository->findBySlug($slug);

        return view("FrontendEvents::detail")->with([
            'event' => $event
        ]);
    }
}
