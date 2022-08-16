<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS_SUCCESS=2;
    const STATUS_PENDING=1;
    const STATUS_FAILED=0;


    use HasFactory;
    protected $fillable=['payment_id','user_id','basket_id','paid','invoice_details','transaction_id','transaction_result'];


    public function getInvoiceDetailsAttribute()
    {
        return unserialize($this->attributes['invoice_details']);
    }

    public function setInvoiceDetailsAttribute($value)
    {
        $this->attributes['invoice_details']=serialize($value);
    }
    public function getTransactionResultAttribute(){
        return unserialize($this->attributes['transaction_result']);
    }

    public function setTransactionResultAttribute($value){
        $this->attributes['transaction_result']=serialize($value);
    }


    public function user()
    {
        return $this->belongsTo(User::class) ;
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class) ;
    }

}
