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

    // Conversão automática de tags JSON <-> array
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

    /**
     * Aplica filtros à query de posts
     * Pode ser usado em PostController e UserController
     */
    public static function applyFilters($query, $request)
    {
        if ($request->search) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->tag) {
            $query->whereJsonContains('tags', $request->tag);
        }

        if ($request->date) {
            // Se quiser, aqui você pode converter 'today', 'week', etc para datas reais
            $query->whereDate('created_at', $request->date);
        }

        if ($request->likes) {
            if ($request->likes === 'most') {
                $query->orderBy('likes', 'desc');
            } elseif ($request->likes === 'least') {
                $query->orderBy('likes', 'asc');
            }
        }

        return $query;
    }

    /**
     * Extrai todas as tags únicas de uma query
     */
    public static function extractTags($query)
    {
        return $query->pluck('tags')
                     ->map(fn($t) => is_array($t) ? $t : [])
                     ->flatten()
                     ->unique()
                     ->sort()
                     ->values();
    }
}
