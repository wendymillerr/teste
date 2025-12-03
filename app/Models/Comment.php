<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'id',       
        'post_id',
        'user',
        'body',
    ];

    
    protected $casts = [
        'user' => 'array',
    ];

    /**
     * Relacionamento com post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function actualUser()
    {
        return User::find($this->user['id'] ?? null);
    }

    public function getUserNameAttribute()
    {
        return $this->user['fullName'] ?? 'Anônimo';
    }
}
