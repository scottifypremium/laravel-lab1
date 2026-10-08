<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    protected $table = 'requests';

    // Only fields a student may submit. user_id, name, email and status
    // are set by the server, never by form input.
    protected $fillable = ['item_name', 'quantity', 'purpose'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}