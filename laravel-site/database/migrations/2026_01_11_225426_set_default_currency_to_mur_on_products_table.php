<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('products')
            ->whereNull('currency')
            ->orWhere('currency', '=', 'USD')
            ->update(['currency' => 'MUR']);

        Schema::table('products', function (Blueprint $table) {
            $table->string('currency', 3)->default('MUR')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->change();
        });
    }
};
