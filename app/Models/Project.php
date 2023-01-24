<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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

    /**
     * SCOPES
     */
}
