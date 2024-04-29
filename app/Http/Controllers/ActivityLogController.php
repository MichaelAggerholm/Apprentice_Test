<?php

namespace App\Http\Controllers;

use App\Exports\ActivityLogExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->take(20)->get();
        return view('admin.pages.activityLog.index', ['activityLogs' => $activityLogs]);
    }

    public function export()
    {
        return Excel::download(new ActivityLogExport, 'activitylogs.xlsx');
    }
}
