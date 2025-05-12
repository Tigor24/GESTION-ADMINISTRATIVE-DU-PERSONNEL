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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('motif')->nullable();
            
            // Nouveau flux conforme CDC
            $table->string('statut')->default('en_attente'); // global status
            $table->string('avis_directeur')->default('en_attente');
            $table->string('avis_rh')->default('en_attente');
            $table->string('avis_dpaf')->default('en_attente');
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
