<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'company_name',
        'phone',
        'email',
        'self_employeed'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function(Client $client) {
            $client->projects()->delete();
        });
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

}
