<?php

namespace App\Modules\Backend\Events\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Events\Models\Events;
use App\Modules\Backend\Events\Repositories\EventRepositoryInterface;

class EventController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        # parent::__construct();

        $this->middleware(['auth']);

        $this->badges = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'alternate', 'dark'];

        $this->eventRepository = $eventRepository;

        $this->event = null;

        $this->attach_file = null;
    }

    public function dataTable()
    {
        $this->authorize('viewAny', Events::class);

        $init = array();

        $events = $this->eventRepository->findAllEvents();

        if (Auth::user()->hasAnyRole(['super-admin','admin','advisor'])) {
            # code...
            foreach ($events as $index => $event) {
                if (count($init) < count($this->badges)) {
                    do {
                        $badge = ($this->badges)[array_rand($this->badges)];
                    } while (in_array($badge, $init));
                } else {
                    // count($init) == count($this->badges)
                    if (count($init) % count($this->badges) == 0) {
                        $badge = ($this->badges)[array_rand($this->badges)];
                    } else {
                        $array_count_value = array_count_values($init);

                        $array_value = array();

                        foreach ($array_count_value as $index => $value) {
                            if ( $value >= ceil(count($init) / count($this->badges)) ) {
                                array_push($array_value, $index);
                            }
                        }

                        do {
                            $badge = ($this->badges)[array_rand($this->badges)];
                        } while (in_array($badge, $array_value));
                    }
                }

                $init[$event->club->slug] = $badge;
            }
        } else {

        }

        return DataTables::of($events)
        ->addColumn('name', function ($event) {
            return words($event->name, 4);
        })
        ->addColumn('created', function ($event) use ($init) {
            $result = '';

            if (Auth::user()->hasAnyRole(['super-admin','admin','advisor'])) {
                # code...
                if (array_key_exists($event->club->slug, $init)) {
                    # code...
                    return '<div class="mb-2 mr-2 badge badge-pill badge-'.$init[$event->club->slug].'">'.format_string($event->club->slug).'</div>';
                }
            }

            return '<div class="mb-2 mr-2 badge badge-pill badge-primary">You</div>';
        })
        ->addColumn('start_at', function ($event) {
            return Carbon::parse($event->start_at)->isoFormat('Do MMMM YYYY, h:mm:ss A');
        })
        ->addColumn('duration', function ($event) {
            return '<div class="badge badge-pill badge-danger">' . Carbon::parse($event->end_at)->diffForHumans(Carbon::parse($event->start_at), true) . '</div>';
        })
        ->addColumn('status', function ($event) {
            if ($event->status == 0) {
                return '<div class="mb-2 mr-2 badge badge-pill badge-warning">Need to be reviewed</div>';
            } else if ($event->status == 1) {
                return '<div class="mb-2 mr-2 badge badge-pill badge-success">Approved</div>';
            } else {
                return '<div class="mb-2 mr-2 badge badge-pill badge-danger">Denied</div>';
            }
        })
        ->addColumn('action', function ($event) {
            $result = '';

            $result .= '<a href="'.route('event.show', $event->slug).'" class="mb-2 mr-2 btn btn-info event-review" data-toggle="tooltip" title="Review" data-placement="top">Review</a>';

            if ($event->status != 1) {
                if (!Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor'])) {
                    $result .= '<a href="' . route('event.edit', $event->slug) . '" class="mb-2 mr-2 btn btn-warning event-edit" data-toggle="tooltip" title="Edit" data-placement="top">Edit</a>';
                }
            }

            $result .= '<a href="#" data-slug="' . $event->slug . '" class="mb-2 btn btn-danger event-remove" data-toggle="tooltip" title="Remove" data-placement="top">Delete</a>';

            return $result;
        })
        ->rawColumns(['created', 'duration', 'status','action'])
        ->make(true);
    }

    public function feedback(Request $request)
    {
        $this->event = $this->eventRepository->findBySlug($request->slug);

        $this->authorize('feedback', $this->event);

        ($this->event)->feedback = $request->feedback;

        ($this->event)->status = $request->status;

        ($this->event)->save();

        return response()->json(['url' => env('APP_URL') . '/dashboard/events']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Events::class);

        return view('Events::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Events::class);

        return view('Events::form')->with([
            'event' => $this->event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Events::class);

        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'string',
            'event_start' => 'required',
            'event_end' => 'required',
        ]);

        if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor'])) {
            $request->validate([
                'club' => 'required|string|min:5|max:36'
            ]);
        } else {
            $request->validate([
                'proposal' => 'required',
                'proposal.*' => 'mimes:doc,pdf,docx',
            ]);
        }

        $this->eventRepository->store($request->method(), $request->all());

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->event = $this->eventRepository->findBySlug($slug);

        $this->authorize('view', $this->event);

        $this->attach_file = ($this->event)->getMedia('file');

        return view('Events::show')->with([
            'event' => $this->event,
            'files' => $this->attach_file
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $this->event = $this->eventRepository->findBySlug($slug);

        $this->authorize('update', $this->event);

        return view('Events::form')->with([
            'event' => $this->event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // $request->validate([
        //     'name' => 'required|string|min:5|max:255',
        //     'description' => 'required|string',
        // ]);

        $this->event = $this->eventRepository->findBySlug($slug);

        $this->authorize('update', $this->event);

        $this->eventRepository->update($request->method(), $slug, $request->all());

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $this->event = $this->eventRepository->findBySlug($slug);

        $this->authorize('delete', $this->event);

        $this->eventRepository->destroy($this->event);

        return response()->json(['message' => 'Destroy successfully!', 'status' => 204]);
    }
}
