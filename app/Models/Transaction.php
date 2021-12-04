<?php

namespace App\Models;

use App\SelectBuilder\WithSelectBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, WithSelectBuilder;
    protected $fillable = ["amount", "type", "status"];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
