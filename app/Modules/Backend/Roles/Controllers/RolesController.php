<?php

namespace App\Modules\Backend\Roles\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use App\Modules\Backend\Roles\Repositories\RolesRepositoryInterface;

class RolesController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(RolesRepositoryInterface $rolesRepository)
    {
        # parent::__construct();

        # need to add permission dashboard access
        $this->middleware(['auth', 'role:super-admin']);

        $this->rolesRepository = $rolesRepository;

        $this->role = null;
    }

    public function dataTable()
    {
        $roles = $this->rolesRepository->findAllRoles(['name']);

        return DataTables::of($roles)
        ->addColumn('name', function ($role) {
            return format_string($role->name);
        })
        ->addColumn('action', function ($role) {

            return '<a href="' . route('role.edit', $role->name) . '" data-name="' . $role->name . '" class="mb-2 btn btn-transition btn-outline-warning role-edit" data-toggle="tooltip" title="Edit" data-placement="top">Edit</a>
                <a href="#" data-name="' . $role->name . '" class="mb-2 btn btn-transition btn-outline-danger role-remove" data-toggle="tooltip" title="Remove" data-placement="top">Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function loadOptions(Request $request)
    {
        $search = $request->search;

        return response()->json($this->rolesRepository->loadOptions($search));
    }

    public function index()
    {
        return view('Roles::index');
    }

    public function create()
    {
        return view('Roles::form')->with([
            'role' => $this->role
        ]);
    }

    public function store(Request $request)
    {
        $this->rolesRepository->store($request->all());

        return redirect()->route('roles.index');
    }

    public function edit($name)
    {
        $this->role = $this->rolesRepository->findByName($name);

        return view('Roles::form')->with([
            'role' => $this->role
        ]);
    }

    public function update($name, Request $request)
    {
        $this->rolesRepository->update($name, $request->all());

        return redirect()->route('roles.index');
    }

    public function destroy($name)
    {
        $this->role = $this->rolesRepository->findByName($name);

        ($this->role)->delete();

        return response()->json(['message' => 'Delete successfully!', 'status' => 200]);
    }
}
