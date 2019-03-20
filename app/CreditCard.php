<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table="credit_cards";
    protected $primaryKey='id';
    protected $fillable=['number','last_name','cvv2','first_name','type','expire_month','expire_year'];
    public static function storeCreditCard($data)
    {
        $creditCard=CreditCard::where('number','=',$data['number'])
                                ->where('type','=',$data['type']);
        $pago=Payment::find(\Session::get('id_pago'));
        if(count($creditCard->get())==0)
            $creditCard=CreditCard::create($data);
        $pago->credit_card_id=$creditCard->id;
        return $pago->save();
    }
}
