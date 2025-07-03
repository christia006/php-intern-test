<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
   public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('nomor', 15);
        $table->string('nama', 150);
        $table->string('jabatan', 200)->nullable();
        $table->date('talahir')->nullable();
        $table->string('photo_upload_path', 150)->nullable();
        $table->timestamps();
        $table->string('created_by', 150)->nullable();
        $table->string('updated_by', 150)->nullable();
        $table->string('deleted_on', 45)->nullable();
    });
}

};
