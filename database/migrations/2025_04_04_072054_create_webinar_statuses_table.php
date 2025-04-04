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
        Schema::create('webinar_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('enum_id')->comment('id в проекте');
            $table->string('slug')->unique()->comment('код статуса');
            $table->string('name')->comment('название статуса');
            $table->string('color')->nullable()->comment('цвет статуса');
            $table->timestamps();
        });
        
        DB::table('webinar_statuses')->insert([
            ['enum_id' => 1, 'slug' => 'DRAFT', 'name' => 'Черновик', 'color' => 'btn-secondary'],
            ['enum_id' => 2, 'slug' => 'PUBLISHED', 'name' => 'Опубликован', 'color' => 'btn-primary'],
            ['enum_id' => 3, 'slug' => 'STARTED', 'name' => 'В процессе', 'color' => 'btn-warning'],
            ['enum_id' => 4, 'slug' => 'FINISHED', 'name' => 'Завершён', 'color' => 'btn-success'],
            ['enum_id' => 5, 'slug' => 'ARCHIVED', 'name' => 'Архив', 'color' => 'btn-dark'],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinar_statuses');
    }
};
