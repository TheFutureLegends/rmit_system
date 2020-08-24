<?php

namespace App\Modules\Backend\Clubs\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Clubs\Repositories\ClubRepositoryInterface;

class ClubController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ClubRepositoryInterface $clubRepository)
    {
        # parent::__construct();

        $this->middleware(['auth']);

        $this->badges = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'alternate', 'dark'];

        $this->clubRepository = $clubRepository;

        $this->club = null;
    }

    public function dataTable()
    {
        $this->authorize('viewAny', Clubs::class);

        $init = array();

        $clubs = $this->clubRepository->findAllClubs();

        foreach ($clubs as $club) {
            do {
                $badge = ($this->badges)[array_rand($this->badges)];
            } while (in_array($badge, $init));

            if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
                # code...
                $init[$club->advisor->email] = $badge;
            }
        }

        return DataTables::of($clubs)
        ->addColumn('abbreviation', function ($club) {
            return $club->abbreviation;
        })
        ->addColumn('name', function ($club) {
            return $club->name;
        })
        ->addColumn('owner', function ($club) use ($init) {
            $result = '';

            if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
                # code...
                if (array_key_exists($club->advisor->email, $init)) {
                    return '<div class="mb-2 mr-2 badge badge-pill badge-'.$init[$club->advisor->email].'">'.$club->advisor->email.'</div>';
                }
            } else {
                return '<div class="mb-2 mr-2 badge badge-pill badge-primary">'.$club->president->email.'</div>';
            }
        })
        ->addColumn('action', function ($club) {
            return '<a href="' . route('club.edit', $club->slug) . '" class="mb-2 btn btn-transition btn-outline-warning club-edit" data-toggle="tooltip" title="Edit" data-placement="top">Edit</a>
                <a href="#" data-slug="' . $club->slug . '" class="mb-2 btn btn-transition btn-outline-danger club-remove" data-toggle="tooltip" title="Remove" data-placement="top">Delete</a>';
        })
        ->rawColumns(['owner', 'action'])
        ->make(true);
    }

    public function loadOptions(Request $request)
    {
        $this->authorize('create', Clubs::class);

        $search = $request->search;

        return response()->json($this->clubRepository->loadOptions($search));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Clubs::class);

        return view('Clubs::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Clubs::class);

        return view('Clubs::form')->with([
            'club' => $this->club
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
        $this->authorize('create', Clubs::class);

        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'abbreviation' => 'required|string|min:2|max:25',
            'president' => 'required|string|min:36|max:36'
        ], [
            'name.required' => 'You need to define club name',
            'name.min' => 'Club name must be at least :min characters',
            'name.max' => 'Club name must not exceed :max characters',

            'abbreviation.required' => 'You need to define club abbreviation',
            'abbreviation.min' => 'Club abbreviation must be at least :min characters',
            'abbreviation.max' => 'Club abbreviation must not exceed :max characters',

            'president.required' => 'You need to select president for the club.',
            'president.min' => 'Club president must be at least :min characters',
            'president.max' => 'Club president must not exceed :max characters',
        ]);

        $this->clubRepository->store($request->all());

        return redirect()->route('clubs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $this->club = $this->clubRepository->findBySlug($slug);

        $this->authorize('update', $this->club);

        return view('Clubs::form')->with([
            'club' => $this->club
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
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'abbreviation' => 'required|string|min:2|max:25',
            'president' => 'required|string|min:36|max:36'
        ], [
            'name.required' => 'You need to define club name',
            'name.min' => 'Club name must be at least :min characters',
            'name.max' => 'Club name must not exceed :max characters',

            'abbreviation.required' => 'You need to define club abbreviation',
            'abbreviation.min' => 'Club abbreviation must be at least :min characters',
            'abbreviation.max' => 'Club abbreviation must not exceed :max characters',

            'president.required' => 'You need to select president for the club.',
            'president.min' => 'Club president must be at least :min characters',
            'president.max' => 'Club president must not exceed :max characters',
        ]);

        $this->club = $this->clubRepository->findBySlug($slug);

        $this->authorize('update', $this->club);

        $this->clubRepository->update($slug, $request->all());

        return redirect()->route('clubs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $this->club = $this->clubRepository->findBySlug($slug);

        $this->authorize('delete', $this->club);

        ($this->club)->delete();

        return response()->json(['message' => 'Update successfully!', 'status' => 200]);
    }
}
