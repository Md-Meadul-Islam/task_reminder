<?php

namespace App\Console\Commands;

use App\Models\DayCategories;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DateUpdateSchedular extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:date-update-schedular';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update next_date for tasks based on repeat schedules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todayDate = \Date::now()->format('Y-m-d');
        $parsedDate = Carbon::parse($todayDate);
        $todayInWeek = strtoupper($parsedDate->format('D')); # like 'SUN';
        $nextdayInWeek = strtoupper($parsedDate->copy()->addDay()->format('D')); # like 'MON';

        $tasks = DayCategories::where('next_date', '<', $parsedDate)->get();
        foreach ($tasks as $task) {
            if ($task->repeat === 'everyday') {
                $task->next_date = $parsedDate->copy()->addDay()->format('Y-m-d');
            }
            if ($task->repeat === 'every week') {
                $weekDays = json_decode($task->weekdays);
                if (in_array($nextdayInWeek, $weekDays, true)) {
                    $task->next_date = $parsedDate->copy()->addDay()->format('Y-m-d');
                } else {
                    $addedDays = $parsedDate->copy()->addDays(2)->format('Y-m-d');
                    $parsedAddedDate = Carbon::parse($addedDays);
                    for ($i = 0; $i < 7; $i++) {
                        $addedDaysInWeek = strtoupper($parsedAddedDate->format('D'));
                        if (in_array($addedDaysInWeek, $weekDays)) {
                            $task->next_date = $addedDays;
                            break;
                        } else {
                            $addedDays = $parsedAddedDate->addDay();
                        }
                    }
                }
            }
            if ($task->repeat === 'every fortnight') {
                $task->next_date = $parsedDate->copy()->addDays(15)->format('Y-m-d');
            }
            if ($task->repeat === 'every month') {
                $task->next_date = $parsedDate->copy()->addMonth()->format('Y-m-d');
            }
            if ($task->repeat === 'every 3 month') {
                $task->next_date = $parsedDate->copy()->addMonths(3)->format('Y-m-d');
            }
            if ($task->repeat === 'every 6 month') {
                $task->next_date = $parsedDate->copy()->addMonths(6)->format('Y-m-d');
            }
            if ($task->repeat === 'every year') {
                $task->next_date = $parsedDate->copy()->addYear()->format('Y-m-d');
            }
            if ($task->save()) {
                \Log::info("Task {$task->id} updated successfully.");
            } else {
                \Log::error("Failed to update task {$task->id}.");
            }
        }
    }
}
