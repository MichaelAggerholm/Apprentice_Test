<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->take(20)->get();
        return view('admin.pages.activitylog.index', ['activityLogs' => $activityLogs]);
    }
}
