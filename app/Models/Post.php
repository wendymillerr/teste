<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'id',         // id da API
        'user_id',
        'title',
        'body',
        'tags',
        'likes',
        'dislikes',
        'views',
    ];

    // Se quiser que tags seja automaticamente convertida de/para array JSON
    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Relacionamento com usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com comentários
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
