<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayCategories extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'day_name', 'weekdays', 'start_date', 'next_date', 'repeat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }
}
