<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor', 15)->unique();
            $table->string('nama', 150);
            $table->string('jabatan', 200)->nullable();
            $table->date('talahir')->nullable();
            $table->string('photo_upload_path', 150)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->timestamp('updated_on')->nullable();
            $table->string('created_by', 150)->nullable();
            $table->string('updated_by', 150)->nullable();
            $table->string('deleted_on', 45)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
