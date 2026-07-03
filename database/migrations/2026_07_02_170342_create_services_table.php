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
        Schema::create('services', function (Blueprint $table) {

            $table->id();

            $table->foreignId('service_category_id')
                ->constrained('service_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('icon')->nullable();

            $table->string('excerpt', 500)->nullable();

            $table->longText('description')->nullable();

            $table->unsignedInteger('sort_order')->default(1);

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->string('seo_title')->nullable();

            $table->text('seo_description')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};