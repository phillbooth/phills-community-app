<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    // Automatically generate UUIDs for new models
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    // Indicate that the 'id' attribute should not be auto-incrementing
    public $incrementing = false;

    // Indicate that the 'id' attribute is a string, as UUIDs are strings, not integers
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class); // Adjust User::class as necessary
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
