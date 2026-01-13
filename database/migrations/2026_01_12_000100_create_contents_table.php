<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('type')->default('awareness');
            $table->string('locale', 5)->default('en');
            $table->string('image_path')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->index(['type', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};

