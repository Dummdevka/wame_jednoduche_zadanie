<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Enums\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'user_id',
        'client_id',
        'status'
    ];

    protected $casts = [
        'deadline' => 'date: d.m.Y'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public static function boot() {
        parent::boot();
        static::deleting(function(Project $project) {
            $project->tasks()->delete();
        });
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function setDeadlineAttribute($value) {
        $this->attributes['deadline'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * SCOPES
     */
    public function scopeByStatus($query, $status) {
        return $query->where('status', $status);
    }
}
