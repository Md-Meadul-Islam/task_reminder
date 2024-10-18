<?php

namespace App\Http\Controllers;

use App\Models\DayCategories;
use Illuminate\Http\Request;

class DayCategoryController extends Controller
{
    public function index()
    {
        $userId = 'qBflHnJlNTB7vn2ffchf8IYoV7fHFN';
        $allDays = DayCategories::where('user_id', $userId)->get()->toArray();
        return view('task.alldays', compact('allDays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.addday');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $selectedDays = json_encode($request->selecteddays, true);
        // dd(json_encode($request->selecteddays, true));
        DayCategories::create([
            'user_id' => 'qBflHnJlNTB7vn2ffchf8IYoV7fHFN',
            'day_name' => $request->dayname,
            'weekdays' => $selectedDays,
            'repeat' => $request->repeat,
            'start_date' => $request->startdate,
            'next_date' => $request->nextdate,
            'status' => $request->status
        ]);
        return redirect()->route('alldays')->with('success', 'Your Day is Added Successfully !');
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
