<?php

namespace App\Modules\Backend\Permissions\Controllers;

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
use App\Modules\Backend\Permissions\Repositories\PermissionsRepositoryInterface;
// use App\Modules\Backend\Roles\Repositories\RolesRepositoryInterface;

class PermissionsController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(PermissionsRepositoryInterface $permissionsRepository)
    {
        # parent::__construct();

        # need to add permission dashboard access
        $this->middleware(['auth', 'role:super-admin']);

        $this->permissionsRepository = $permissionsRepository;

        $this->permission = null;

        $this->badges = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'alternate', 'dark'];

        /**
         * <div class="mb-2 mr-2 badge badge-pill badge-primary">Primary</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-secondary">Secondary</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-success">Success</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-info">Info</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-warning">Warning</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-danger">Danger</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-focus">Focus</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-alternate">Alt</div>
         * <div class="mb-2 mr-2 badge badge-pill badge-dark">Dark</div>
         */
    }

    public function dataTable()
    {
        $permissions = $this->permissionsRepository->findAllPermissions();

        $init = array();

        foreach ($permissions as $key => $value) {
            $roles = $value->getRoleNames()->toArray();

            if (!empty($roles)) {
                foreach ($roles as $key => $role) {
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

                    $init[$role] = $badge;
                }
            }
        }

        return DataTables::of($permissions)
        ->addColumn('name', function ($permission) {
            return ucwords(implode(" ", explode(".", $permission->name)));
        })
        ->addColumn('role', function ($permission) use ($init) {
            $result = '';

            $roles = $permission->getRoleNames()->toArray();

            foreach ($roles as $key => $role) {
                if (array_key_exists($role, $init)) {
                    $result .= '<div class="mb-2 mr-2 badge badge-pill badge-'.$init[$role].'">'.format_string($role).'</div>';
                }
            }

            return $result;
        })
        ->addColumn('action', function ($permission) {
            return '<a href="' . route('permission.edit', $permission->name) . '" data-name="' . $permission->name . '" class="mb-2 btn btn-transition btn-outline-warning permission-edit" data-toggle="tooltip" title="Edit" data-placement="top">Edit</a>
                <a href="#" data-name="' . $permission->name . '" class="mb-2 btn btn-transition btn-outline-danger permission-remove" data-toggle="tooltip" title="Remove" data-placement="top">Delete</a>';
        })
        ->rawColumns(['role', 'action'])
        ->make(true);
    }

    public function loadOptions(Request $request)
    {
        $search = $request->search;

        return response()->json($this->permissionsRepository->loadOptions($search));
    }

    public function index()
    {
        return view('Permissions::index');
    }

    public function create()
    {
        return view('Permissions::form')->with([
            'permission' => $this->permission
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
        ], [
            'name.required' => 'You cannot leave permission name blank',
            'name.string' => 'It needs to be string.',
            'name.min' => 'Permission name must be at least :min characters.',
            'name.max' => 'Permission name must not be more than :max characters.',
        ]);

        $this->permissionsRepository->store($request->all());

        return redirect()->route('permission.create');
    }

    public function edit($name)
    {
        $this->permission = $this->permissionsRepository->findByName($name);

        return view('Permissions::form')->with([
            'permission' => $this->permission
        ]);
    }

    public function update($name, Request $request)
    {
        $this->permissionsRepository->update($name, $request->all());

        return redirect()->route('permissions.index');
    }

    public function destroy($name)
    {
        $this->permission = $this->permissionsRepository->findByName($name);

        ($this->permission)->delete();

        return response()->json(['message' => 'Delete successfully!', 'status' => 200]);
    }
}
