<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'commentable_id',
        'commentable_type',
        'text'
    ];

    public function getCreatedAtAttribute($created_at)
    {
        $v=new Verta($created_at);
        $v=$v->format('Y/n/j');
        return $v;
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        $v=new Verta($updated_at);
        $v=$v->format('Y/n/j');
        return $v;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
