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
        Schema::create('console_jeux', function (Blueprint $table) {
                // Attention pas de s à producer_id
                $table->bigInteger('console_id')->unsigned()->nullable();
                $table->foreign('console_id')
                        ->references('id')
                        ->on('consoles');
    
                // Attention pas de s à label_id        
                $table->bigInteger('jeux_id')->unsigned()->nullable();
                $table->foreign('jeux_id')
                        ->references('id')
                        ->on('jeux');
                $table->id();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('console_jeux');
    }
};
