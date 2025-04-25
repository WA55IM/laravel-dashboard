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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_bank')->nullable();
            $table->string('rib')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift')->nullable();
            $table->string('type_compt'); // 'client' or 'fournisseur'
            $table->unsignedBigInteger('user_id'); // Associated user (client or fournisseur)
            $table->timestamps();

            // Foreign key to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comptes');
    }
};
