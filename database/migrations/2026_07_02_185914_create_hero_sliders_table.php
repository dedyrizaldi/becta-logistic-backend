<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sliders', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('subtitle')->nullable();

            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Buttons
            |--------------------------------------------------------------------------
            */

            $table->string('primary_button_text')->nullable();

            $table->string('primary_button_url')->nullable();

            $table->string('secondary_button_text')->nullable();

            $table->string('secondary_button_url')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')->default(1);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};