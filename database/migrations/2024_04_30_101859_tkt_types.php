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
        Schema::create('tkt_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger(column: 'research_type_id');
            $table->foreign(columns: 'research_type_id')->references('id')->on('research_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkt_types');
    }
};
