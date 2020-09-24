<?php

namespace App\Modules\Frontend\Home\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Modules\Backend\Events\Models\Events;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latest = Events::query()->available()->orderBy('updated_at', 'DESC')->take(4)->get();

        $incoming = Events::query()->available()->orderBy('start_at', 'DESC')->take(3)->get();

        return view('Home::index')->with([
            'latest' => $latest,
            'incoming' => $incoming
        ]);
    }
}
