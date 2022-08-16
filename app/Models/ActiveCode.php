<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'code',
        'expired_at'
    ];

    public $timestamps=false;
    protected $table='active_code';

    public function scopeGenerateCode($query,$user)
    {
        if($code=$this->getActiveForUser($user)){
            $code=$code->code;
        }
        else
        {
            do{
                $code=mt_rand(100000,999999);
            }
            while($this->checkCodeIsUniq($code,$user));
            $user->activeCodes()->create([
                'code'=>$code,
                'expired_at'=>now()->addMinute(10)
            ]);
        }
    }

    private function checkCodeIsUniq(int $code, $user)
    {
        return !! $user->activeCodes()->whereCode($code)->first();
    }

    private function getActiveForUser($user)
    {
        return $user->activeCodes()->where('expired_at','>',now())->first();
    }

    public function scopeVerifyCode($query,$code,$user){
        return !! $user->activeCodes()->whereCode($code)->where('expired_at','>',now())->first();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
