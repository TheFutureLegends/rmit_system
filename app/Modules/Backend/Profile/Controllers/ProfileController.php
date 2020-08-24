<?php

namespace App\Modules\Backend\Profile\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # DashboardRepositoryInterface $dashboardRepository

        # parent::__construct();

        # need to add permission dashboard access
        $this->middleware(['auth']);

        // $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        return view('Profile::index');
    }

    public function update_bio(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255'
        ], [
            'name.required' => 'You can not leave name empty',
            'name.min' => __('ruleMessages.name_profile_min')
        ]);

        if (!Auth::user()->hasRole('president')) {
            if (isset($request->about_me)) {
                $request->validate([
                    'about_me' => "string|min:10|max:255"
                ], [
                    'about_me.min' => "Your about cannot be less than :min characters",
                    'about_me.max' => "Your about cannot be greater than :max characters"
                ]);
            }

            $user = Auth::user();

            $user->name = $request->name;

            $user->about_me = $request->about_me;

            $user->save();
        } else {
            $user = Auth::user();

            $user->name = $request->name;

            $user->president->description = $request->description;

            $user->president->save();

            $user->save();
        }

        return redirect()->route('profile.index');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => __('ruleMessages.current_password'),
            'password.required' => __('ruleMessages.password_required'),
            'password.min' => __('ruleMessages.password_min'),
            'password.confirmed' => __('ruleMessages.password_confirmed'),
        ]);

        $user = User::find(Auth::id());

        $checked = Hash::check($request->current_password, $user->password);

        if (!$checked) {
            return redirect()->back()->withErrors(['errors' => [__('ruleMessages.current_password_match')]]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('profile.index');
    }

    public function update_avatar(Request $request)
    {
        $name = Str::random(10, 60) . time();

        $extension = ($request->avatar)->getClientOriginalExtension();

        Auth::user()->addMediaFromRequest('avatar')->usingName($name)->usingFileName($name . '.' . $extension)->toMediaCollection('avatar');

        return redirect()->route('profile.index');
    }
}
