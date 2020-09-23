<?php

namespace App\Modules\Frontend\FrontendEvents\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EventFrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('FrontendEvents::index');
    }

    public function show($slug)
    {
        return view("FrontendEvents::detail");
    }
}
