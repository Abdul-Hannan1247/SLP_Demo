<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPatients = Patient::count();

        $now = Carbon::now('Asia/Karachi'); // Set timezone
        $startOfMonth = $now->startOfMonth()->toDateString();
        $endOfMonth = $now->endOfMonth()->toDateString();

        $totalAppointmentsThisMonth = Appointment::whereBetween('date', [$startOfMonth, $endOfMonth])->count();


        // Patient Registration Over Time (Eloquent)
        $monthlyPatientCounts = Patient::selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $monthlyPatientCounts->pluck('month');
        $counts = $monthlyPatientCounts->pluck('count');

        // Patient Demographics (Gender) (Eloquent)
        $genderCounts = Patient::select('gender')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('gender')
            ->get()
            ->pluck('count', 'gender') // Changed pluck order to match label -> value for pie chart
            ->toArray();


        $genders = array_keys($genderCounts);
        $genderCountsData = array_values($genderCounts);

        // Fetch diagnose counts
        $diagnoseData = Patient::query()
            ->select('diagnose')
            ->selectRaw('count(*) as count')
            ->groupBy('diagnose')
            ->orderBy('diagnose')
            ->get();
            
        $diagnoseLabels = $diagnoseData->pluck('diagnose')->toArray();
        $diagnoseCounts = $diagnoseData->pluck('count')->toArray();

     //   dd($diagnoseLabels, $diagnoseCounts); // Inspect these arrays

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalAppointmentsThisMonth',
            'months',
            'counts',
            'genders',
            'genderCountsData',
            'totalPatients',
            'diagnoseLabels',
            'diagnoseCounts'

        ));
  }
}
