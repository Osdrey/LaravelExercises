<?php

namespace App\Models\Reservations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'topic_id', 'course_id', 'reservation_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function scopeAvailable($query, $course_id, $date, $time)
    {
        return $query->where('course_id', $course_id)
                     ->where('reservation_date', "{$date} {$time}")
                     ->doesntExist();
    }

    public function updateStatus()
    {
        $now = Carbon::now();
        if ($this->reservation_date > $now) {
            $this->status = 'pending';
        } elseif ($this->reservation_date->isToday()) {
            $this->status = 'in_progress';
        } else {
            $this->status = 'completed';
        }
        $this->save();
    }
}
