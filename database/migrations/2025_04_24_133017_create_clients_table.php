<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relationship with users table
            $table->string('code');
            $table->string('raison_sociale');
            $table->enum('type_client', ['étatique', 'privée', 'étranger']);
            $table->string('num_siret')->nullable();
            $table->string('adresse');
            $table->string('matricule_fiscale');
            $table->string('code_postal');
            $table->string('activite');
            $table->string('telephone');
            $table->boolean('blockage')->default(0);
            $table->boolean('exomee')->default(0);
            $table->string('num_decision')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
}