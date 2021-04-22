<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationTransactions extends Model
{
    use HasFactory;

    protected $fillable = [ 'donations_id',
                            'donator_name',
                            'donator_email',
                            'donator_number',
                            'is_anonym',
                            'message',
                            'payment_status',
                            'channel',
                            'donation_amount',
                            'unique_digit' ];
}
