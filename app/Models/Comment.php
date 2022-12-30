<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_comment_id', 'id')->withTrashed()->get();
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_comment_id', 'id')->withTrashed()->first();
    }
}
