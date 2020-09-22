<?php

namespace App\Modules\Frontend\Events\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Events::index');
    }
}
