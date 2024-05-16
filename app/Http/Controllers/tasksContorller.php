<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tasksContorller extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function show(Request $request)
    {
        $TaskDayStart = "2024-05-14";

        $WorkDayStart = 8;
        $WorkDayEnd = 17;
        $taskHours = 55;
        $NbDays = 0;
    
        $TaskHourStart = 10;
    
        $timestamp = strtotime($TaskDayStart);
        $DayName = date("l", $timestamp);
    
        while ($taskHours > 0) {
            if ($DayName === "Sunday") {
                $NbDays++;
            } else {
                if ($TaskHourStart < $WorkDayEnd) {
                    $TaskHourStart++;
                    $taskHours--; 
                } else {
                    $NbDays++;
                    $TaskHourStart = $WorkDayStart;
                }
            }
            $timestamp = strtotime($TaskDayStart . " + " . $NbDays . " days");
            $DayName = date("l", $timestamp);
        }
    
        if ($TaskHourStart > 8) {
            $NbDays++;
        }
    
        $deliveryDay = date('Y-m-d', strtotime($TaskDayStart . ' + ' . $NbDays . ' days'));
    
        $result =  'la date de fin : ' . $deliveryDay . ' à ' . $TaskHourStart . ' H' ;

        return view('tasks.index' , compact('result') );
    }
}
