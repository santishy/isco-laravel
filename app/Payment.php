<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable=['forma_pago','total','paypal_payment_id'];
    public $table='pagos';
}
