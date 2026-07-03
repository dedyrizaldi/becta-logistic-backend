<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {

            $table->id();

            $table->foreignId('news_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('author')->default('Becta Logistics');

            $table->string('source')->nullable();

            $table->string('reading_time')->nullable();

            $table->unsignedInteger('views')->default(0);

            $table->json('tags')->nullable();

            $table->text('excerpt')->nullable();

            $table->longText('description');

            $table->date('published_at')->nullable();

            $table->unsignedInteger('sort_order')->default(1);

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->string('seo_title')->nullable();

            $table->text('seo_description')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};