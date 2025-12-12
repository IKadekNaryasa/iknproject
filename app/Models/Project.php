<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasUuids;
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'project_code',
        'start_date',
        'end_date',
        'type',
        'customer_name',
        'email',
        'status',
        'price',
        'invoice_id',
        'total_payment'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
