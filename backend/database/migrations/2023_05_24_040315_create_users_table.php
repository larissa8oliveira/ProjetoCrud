<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('cpf')->unique();
            $table->foreignId('perfil_id')->constrained('profiles');
            $table->timestamps();
            $table->softDeletes(); // Adiciona a coluna 'deleted_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
