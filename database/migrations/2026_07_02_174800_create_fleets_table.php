<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('fleet_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('code')->nullable();

            $table->decimal('loa', 8, 2)->nullable();

            $table->decimal('beam', 8, 2)->nullable();

            $table->decimal('depth', 8, 2)->nullable();

            $table->integer('gt')->nullable();

            $table->integer('cargo_capacity')->nullable();

            $table->string('engine')->nullable();

            $table->string('speed')->nullable();

            $table->integer('crew')->nullable();

            $table->year('built_year')->nullable();

            $table->string('flag')->nullable();

            $table->longText('description')->nullable();

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
        Schema::dropIfExists('fleets');
    }
};