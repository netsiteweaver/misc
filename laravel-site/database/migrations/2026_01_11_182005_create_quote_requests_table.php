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
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('engine')->nullable();

            $table->string('part_name');
            $table->unsignedInteger('quantity')->default(1);
            $table->text('notes')->nullable();

            $table->string('preferred_contact')->default('facebook'); // facebook | phone | email
            $table->string('status')->default('new'); // new | contacted | quoted | closed
            $table->string('source')->default('website'); // website | facebook | phone
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
