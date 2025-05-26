<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Models\Upload;
use DB;

class ReportController extends Controller
{
    /**
     * Display various statistical reports such as:
     * - File upload types
     * - Monthly user registrations
     * - User birth year distribution
     * - Monthly file upload counts
     */
    public function index()
    {
        // Count the number of uploaded files grouped by their type (e.g., image, document, etc.)
        $fileTypes = Upload::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Count the number of users registered per month (formatted as YYYY-MM)
        $userRegistrations = Usersinfo::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Count users grouped by their year of birth
        $birthYears = Usersinfo::selectRaw('YEAR(birthday) as year, count(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Count the number of files uploaded per month (formatted as YYYY-MM)
        $fileUploads = Upload::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Return the 'reports' view with all compiled data passed as variables
        return view('reports', compact('fileTypes', 'userRegistrations', 'birthYears', 'fileUploads'));
    }
}
