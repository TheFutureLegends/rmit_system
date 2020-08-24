<?php

namespace App\Modules\Backend\Dashboard\Controllers;

use Illuminate\Support\Facades\DB;
// use App\Modules\Dashboard\Home\Repositories\DashboardRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
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

    public function dataTable_language()
    {
        $array = array(
            'search' => "_INPUT_",
            // 'sSearch'=> "Suchen",
            'sSearchPlaceholder' => __('dataTables.sSearchPlaceholder'),
            'sInfoThousands' => ".",
            'sLengthMenu' => __('dataTables.sLengthMenu'),
            'sEmptyTable' => __('dataTables.sEmptyTable'),
            'sProcessing' => __('dataTables.sProcessing'),
            'sLoadingRecords' => __('dataTables.sLoadingRecords'),
            'sZeroRecords' => __('dataTables.sZeroRecords'),
            'sInfo' => __('dataTables.sInfo'),
            'sInfoFiltered' => __('dataTables.sInfoFiltered'),
            'sInfoEmpty' => __('dataTables.sInfoEmpty'),
            'oPaginate' => [
                'sFirst' => __('dataTables.sFirst'),
                'sPrevious' => __('dataTables.sPrevious'),
                'sNext' => __('dataTables.sNext'),
                'sLast' => __('dataTables.sLast'),
            ],
        );

        return response()->json($array);
    }

    public function index()
    {
        return view('Dashboard::index');
    }
}
