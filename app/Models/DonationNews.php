<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationNews extends Model
{
    use HasFactory;

    protected $fillable = ['donations_id','title', 'body'];
}
