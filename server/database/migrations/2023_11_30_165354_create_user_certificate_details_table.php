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
        Schema::create('user_certificate_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_certificate_id');
            $table->foreign('user_certificate_id')->references('id')->on('user_certificates');
            $table->string('major');
            $table->date('date_achieved');
            $table->string('university');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_certificate_details');
    }
};
