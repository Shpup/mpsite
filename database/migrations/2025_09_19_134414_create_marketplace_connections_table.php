<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('marketplace_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('marketplace_type'); // 'wb', 'ozon', 'yandex-market'
            $table->string('name'); // Название магазина
            $table->string('slug')->unique();
            $table->string('api_key')->nullable(); // Для WB, Ozon
            $table->string('client_id')->nullable(); // Для Ozon, Yandex.Market
            $table->string('oauth_token')->nullable(); // Для Yandex.Market
            $table->boolean('is_connected')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marketplace_connections');
    }
};
