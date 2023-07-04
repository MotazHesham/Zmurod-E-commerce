<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comment',
        'comment_for',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const COMMENT_FOR_SELECT = [
        'Forum-comment' => 'Forum-comment',
        'Blog-comment'  => 'Blog-comment',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user_comments()
    {
        return $this->belongsToMany(User::class);
    }
}
