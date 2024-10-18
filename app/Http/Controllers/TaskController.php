<?php

namespace App\Http\Controllers;

use App\Models\DayCategories;
use App\Models\Tasks;
use DateTimeZone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        // dump(CarbonTimeZone::getType());
        // $timezpne = new CarbonTimeZone();
        // $carbon = new Carbon();
        // $now = Carbon::now();
        // dump($now->copy()->floatDiffInWeeks($now->format('Y-m-d')));
        // dump($now->copy()->diffForHumans(['parts' => 3, 'join' => true]));
        // dd($now);
        $ip = request()->ip();
        // $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
        $userId = 'qBflHnJlNTB7vn2ffchf8IYoV7fHFN';
        $dayCategories = DayCategories::where('user_id', $userId)
            ->where('status', 'active')
            ->where('next_date', Carbon::now()->format('Y-m-d'))
            ->select('id', 'day_name', 'repeat')
            ->get();
        $dayCategoryIds = $dayCategories->pluck('id');
        $dayCategoriesArray = $dayCategories->toArray();
        // dd($dayCategoriesArray, $dayCategoryIds);
        $timezone = new DateTimeZone('Asia/Dhaka');
        $datetime = new \DateTime('now', $timezone);
        // dd($datetime);
        $tasks = Tasks::where('user_id', $userId)
            ->whereIn('day_category_id', $dayCategoryIds)
            ->where('alarm_time', '>=', $datetime)
            ->with('dayCategory:id,day_name')
            ->orderBy('alarm_time')
            ->get()
            ->groupBy(function ($task) {
                return $task->alarm_time->format('H:00:00');
            })->toArray();
        return view('task.index', compact('dayCategoriesArray', 'tasks'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
