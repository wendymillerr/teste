<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',       // id do comentário da API
        'post_id',
        'user',
        'body',
    ];

    // Faz com que o campo user seja convertido para array automaticamente
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
}
