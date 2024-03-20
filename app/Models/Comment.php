<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Str::uuid();
            }
        });
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Make sure User is the correct name of your User model
    }
    
}
