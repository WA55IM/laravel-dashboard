<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code');
            $table->string('raison_sociale');
            $table->enum('type', ['étatique', 'privée', 'étranger']);
            $table->string('adresse');
            $table->string('code_postal', 10);
            $table->string('activite');
            $table->string('telephone', 20);
            $table->boolean('blockage')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
};
