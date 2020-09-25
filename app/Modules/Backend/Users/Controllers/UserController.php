<?php
namespace App\Modules\Backend\Users\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Users\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        # parent::__construct();

        $this->userRepository = $userRepository;

        $this->badges = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'alternate', 'dark'];

        $this->user = null;
    }

    public function dataTable()
    {
        $init = array();

        $users = $this->userRepository->findUserByRole();

        foreach ($users as $user) {
            if ($user instanceof User) {
                $roles = $user->getRoleNames()->toArray();

                foreach ($roles as $key => $role) {
                    do {
                        $badge = ($this->badges)[array_rand($this->badges)];
                    } while (in_array($badge, $init));

                    $init[$role] = $badge;
                }
            }
        }

        return DataTables::of($users)
        ->addColumn('name', function ($user) {
            $badge = '';

            if (Auth::user()->hasAnyRole(['advisor'])) {
                if (empty($user->president)) {
                    $badge .= '&nbsp;<span class="mb-2 mr-2 badge badge-pill badge-danger">Not assigned</span>';
                }
            }

            return $user->name . $badge;
        })
        ->addColumn('email', function ($user) {
            return $user->email;
        })
        ->addColumn('access', function ($user) use ($init) {
            $result = '';

            if ($user instanceof User) {
                $roles = $user->getRoleNames()->toArray();

                foreach ($roles as $key => $role) {
                    if (array_key_exists($role, $init)) {
                        $result .= '<div class="mb-2 mr-2 badge badge-pill badge-'.$init[$role].'">'.format_string($role).'</div>';
                    }
                }
            } else {
                $result .= '<div class="mb-2 mr-2 badge badge-pill badge-success">Member</div>';
            }

            return $result;
        })
        ->addColumn('action', function ($user) {
            $result = '';

            if (Auth::user()->hasRole('admin')) {
                if ($user->hasRole('advisor')) {
                    $number_of_club = Clubs::query()
                    ->where([
                        ['advisor_id', '=', $user->id]
                    ])
                    ->count();

                    if ($number_of_club > 0) {
                        $result .= '<a href="'. route('user.transfer', $user->email) .'" class="mb-2 mr-2 btn btn-transition btn-outline-info user-transfer" data-toggle="tooltip" title="Edit" data-placement="top">Transfer club</a>&nbsp;';
                    }
                }
            }

            $result .= '<a href="#" class="mb-2 mr-2 btn btn-transition btn-outline-warning user-reset" data-toggle="tooltip" title="Edit" data-placement="top">Reset Password</a>
                <a href="#" data-email="'.$user->email.'" class="mb-2 btn btn-transition btn-outline-danger user-remove" data-toggle="tooltip" title="Remove" data-placement="top">Delete</a>';

            return $result;
        })
        ->rawColumns(['name', 'access', 'action'])
        ->make(true);
    }

    public function loadAdvisorOptions(Request $request)
    {
        $search = $request->search;

        return response()->json($this->userRepository->loadAdvisorOptions($search));
    }

    public function loadAdvisorWithNoClubOptions(Request $request)
    {
        $search = $request->search;

        return response()->json($this->userRepository->loadAdvisorWithNoClubOptions($search));
    }

    public function loadPresidentOptions(Request $request)
    {
        $search = $request->search;

        return response()->json($this->userRepository->loadPresidentOptions($search));
    }

    public function transfer($email)
    {
        $this->user = $this->userRepository->findByEmail($email);

        $advisor_to_transfer = $this->userRepository->loadAdvisorWithNoClubOptions(null);

        if (empty($advisor_to_transfer)) {
            abort(404);
        }

        return view('Users::transfer')->with([
            'user' => $this->user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Users::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Users::form')->with([
            'user' => $this->user
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
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|min:5|max:255|unique:users'
        ]);

        $this->userRepository->store($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        $request->validate([
            'transfer_advisor' => 'required'
        ]);

        $this->userRepository->update($email, $request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        // $this->user = $this->userRepository->findByEmail($email);

        // ($this->user)->delete();

        $this->userRepository->destroy($email);

        return response()->json(['message' => 'Update successfully!', 'status' => 200]);
    }
}
