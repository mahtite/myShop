<?php

namespace App\Models;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements mustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'two_factor_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUpdatedAtAttribute($updated_at)
    {
        $v=new Verta($updated_at);
        $v=$v->format('Y/n/j');
        return $v;
    }

    public function hasTwoFactorAuthenticatedEnable()
    {
        return  $this->two_factor_type !== 'off';
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function sendEmailVerificationNotification(){
        $this->notify(new VerifyEmail());
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isoperator()
    {
        return $this->is_operator;
    }

    public function hasPermission($permission)
    {
        //dd($permission);
        return $this->permissions->contains('name',$permission->name)|| $this->hasRole($permission->roles);
    }

    public function hasRole($roles)
    {
        return !! $roles->intersect($this->roles)->all();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function activeCodes()
    {
        return $this->hasMany(ActiveCode::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productFavorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

}
