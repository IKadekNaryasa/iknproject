<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasUuids;

    public $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'status',
        'notes'
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
