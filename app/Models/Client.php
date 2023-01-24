<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
