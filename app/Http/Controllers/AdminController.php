<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\UserReport;
use App\EventReport;
use App\File;

class AdminController extends Controller
{
    public function show(){

        $tempUserReports = UserReport::all();
        $userReports = [];
        $seenReports = [];


        foreach ($tempUserReports as $report) {
            if($report->report->veridict == 'Pending')
                array_push($userReports,$report);
        }

        foreach ($tempUserReports as $report) {
            if($report->report->veridict != 'Pending')
                array_push($seenReports,$report);
        }

        $tempEventReports = EventReport::all();
        $eventReports = [];
        $seenEventReports = [];

        foreach ($tempEventReports as $report) {
            if($report->report->veridict == 'Pending')
                array_push($eventReports,$report);
        }

        foreach ($tempEventReports as $report) {
            if($report->report->veridict != 'Pending')
                array_push($seenEventReports,$report);
        }

        return view('pages.admin', ['user' => Auth::user(),
                                    'userReports' => $userReports,
                                    'seenReports' => $seenReports,
                                    'eventReports' => $eventReports,
                                    'seenEventReports' => $seenEventReports
                                    ]);
    }
}