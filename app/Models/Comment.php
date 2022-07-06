<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentApproval\Approvable;

class Comment extends Model
{

    use Approvable, Notifiable;

    const APPROVAL_STATUS = 'status';
    const APPROVAL_AT = 'approval_at';

    protected $fillable = [
        'body',
        'user_id',
        'commentable_id',
        'commentable_type',
        'status',
        'approval_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function post()
    {
       return $this->belongsTo(Post::class, 'commentable_id');
    }
}
