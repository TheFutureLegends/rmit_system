<?php

namespace App\Modules\Frontend\Home\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Home::index');
    }
}
