<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class SyncDummyJson extends Command
{
    protected $signature = 'sync:dummyjson';
    protected $description = 'Importa usuários, posts e comentários da API DummyJSON para o banco local';

    public function handle()
    {
        $this->info("Iniciando sincronização com DummyJSON...");

        // Tudo dentro de uma transação (atomicidade)
        DB::transaction(function () {
            
            $this->clearTables();

            $users = $this->fetchUsers();
            $savedUserIds = $this->saveUsers($users);

            $posts = $this->fetchPosts();
            $savedPostIds = $this->savePosts($posts, $savedUserIds);

            $comments = $this->fetchComments();
            $this->saveComments($comments, $savedPostIds, $savedUserIds);

        });

        $this->info("✅ Sincronização finalizada com sucesso!");
        return 0;
    }

    // ---------------------
    // Funções auxiliares
    // ---------------------

    private function clearTables()
    {
        $this->info("🗑️  Limpando tabelas existentes...");
        
        // Ordem importante para respeitar foreign keys
        Comment::query()->delete();
        Post::query()->delete();
        User::query()->delete();
        
        $this->info("✅ Tabelas limpas!");
    }

    private function fetchUsers()
    {
        $this->info("👥 Buscando usuários na API...");
        $response = Http::get('https://dummyjson.com/users?limit=0');

        if (!$response->successful()) {
            $this->error("❌ Erro ao buscar usuários.");
            throw new \Exception("Falha na API de usuários");
        }

        return $response->json()['users'] ?? [];
    }

    private function saveUsers(array $users)
    {
        $this->info("💾 Salvando usuários...");
        
        $savedIds = [];
        foreach ($users as $apiUser) {
            $user = User::create([
                'id' => $apiUser['id'],
                'first_name' => $apiUser['firstName'],
                'last_name' => $apiUser['lastName'],
                'email' => $apiUser['email'],
                'phone' => $apiUser['phone'],
                'image' => $apiUser['image'],
                'birth_date' => $apiUser['birthDate'],
                'address' => json_encode($apiUser['address'] ?? []),
            ]);
            $savedIds[$user->id] = true;
        }
        
        $this->info("✅ " . count($users) . " usuários sincronizados.");
        return $savedIds; // Retorna array de IDs para validação rápida
    }

    private function fetchPosts()
    {
        $this->info("📝 Buscando posts na API...");
        $response = Http::get('https://dummyjson.com/posts?limit=0');

        if (!$response->successful()) {
            $this->error("❌ Erro ao buscar posts.");
            throw new \Exception("Falha na API de posts");
        }

        return $response->json()['posts'] ?? [];
    }

    private function savePosts(array $posts, array $userIds)
    {
        $this->info("💾 Salvando posts...");
        
        $savedIds = [];
        $skipped = 0;
        
        foreach ($posts as $apiPost) {
            // Validação O(1) usando array_key_exists
            if (!isset($userIds[$apiPost['userId']])) {
                $skipped++;
                continue;
            }

            $post = Post::create([
                'id' => $apiPost['id'],
                'user_id' => $apiPost['userId'],
                'title' => $apiPost['title'],
                'body' => $apiPost['body'],
                'tags' => json_encode($apiPost['tags'] ?? []),
                'likes' => $apiPost['reactions']['likes'] ?? 0,
                'dislikes' => $apiPost['reactions']['dislikes'] ?? 0,
                'views' => $apiPost['views'] ?? 0,
            ]);
            $savedIds[$post->id] = true;
        }
        
        if ($skipped > 0) {
            $this->warn("⚠️  $skipped posts pulados (usuário não encontrado).");
        }
        
        $this->info("✅ " . (count($posts) - $skipped) . " posts salvos.");
        return $savedIds;
    }

    private function fetchComments()
    {
        $this->info("💬 Buscando comentários na API...");
        $response = Http::get('https://dummyjson.com/comments?limit=0');

        if (!$response->successful()) {
            $this->error("❌ Erro ao buscar comentários.");
            throw new \Exception("Falha na API de comentários");
        }

        return $response->json()['comments'] ?? [];
    }

    private function saveComments(array $comments, array $postIds, array $userIds)
    {
        $this->info("💾 Salvando comentários...");
        
        $saved = 0;
        $skipped = 0;
        
        foreach ($comments as $apiComment) {
            $commentUserId = $apiComment['user']['id'] ?? null;
            
            // Validação O(1) para post e usuário
            if (!isset($postIds[$apiComment['postId']]) || !isset($userIds[$commentUserId])) {
                $skipped++;
                continue;
            }

            Comment::create([
                'id' => $apiComment['id'],
                'post_id' => $apiComment['postId'],
                'body' => $apiComment['body'],
                'user' => json_encode($apiComment['user'] ?? []),
            ]);
            $saved++;
        }
        
        if ($skipped > 0) {
            $this->warn("⚠️  $skipped comentários pulados (post ou usuário não encontrado).");
        }
        
        $this->info("✅ $saved comentários salvos.");
    }
}