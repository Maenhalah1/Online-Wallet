<?php

namespace App\Models;

use App\Helpers\Media\Src\IMedia;
use App\Helpers\Media\Src\MediaGroups;
use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class PaymentMethod extends Model implements IMedia
{
    use HasFactory, MediaInitialization;
    protected $fillable = ["name", "min_deposit", "max_deposit", "min_withdrawal", "max_withdrawal"];


    //Relations
    public function currencies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Currency::class , "payment_method_currencies", "payment_method_id","currency_id");
    }


    //Media Configuration
    public function setMainDirectoryPath(): string
    {
        return "payment-methods";
    }

    public function setGroups(): MediaGroups
    {
        return (new MediaGroups())->setGroup("single", "icon", DS);
    }
}
