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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название вебинара');
            $table->text('description')->nullable()->comment('Описание вебинара');
            $table->string('video_url')->nullable()->comment('URL видео на сайте');
            $table->string('rtmp_url')->nullable()->comment('URL видеопотока');
            $table->string('date')->comment('Дата начала');
            $table->string('time')->comment('Время начала');
            $table->integer('status')->default(0)->comment('Статус вебинара');
            $table->decimal('price', 10, 2)->default(0)->comment('Стоимость вебинара');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
