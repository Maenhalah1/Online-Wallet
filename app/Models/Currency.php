<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ["name", "code", "difference_in_dollar"];
    protected $table = "currencies";

    public function paymentMethods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class , "payment_method_currencies", "currency_id", "payment_method_id");
    }
}
