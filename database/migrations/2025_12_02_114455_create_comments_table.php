<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('comments', function (Blueprint $table) {
            $table->id(); // id do comentário da API
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->json('user'); // informações do usuário que comentou
            $table->text('body'); // conteúdo do comentário
            $table->timestamps();
        });
    }

    protected $casts = [
        'user' => 'array',
    ];
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
