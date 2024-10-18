<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $casts = [
        'alarm_time' => 'datetime',
    ];
    protected $fillable = ['user_id', 'day_category_id', 'task_body', 'remark', 'alarm_time', 'remind_before', 'remind_after', 'ringtone', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function dayCategory()
    {
        return $this->belongsTo(DayCategories::class);
    }

    public function processFlows()
    {
        return $this->hasMany(ProcessFlows::class);
    }
}
