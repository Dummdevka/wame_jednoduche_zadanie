<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Enums\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function getStatusAttribute($value) {
        return Status::$value;
    }

    /**
     * SCOPES
     */
    public function scopeFinished($query) {
        return $query->where('status', 'FINISHED');
    }

    public function scopeDesign($query) {
        return $query->where('status', 'DESIGN');
    }

    public function scopeDev($query) {
        return $query->where('status', 'DESIGN');
    }

    public function scopeNew($query) {
        return $query->where('status', 'DESIGN');
    }
}
