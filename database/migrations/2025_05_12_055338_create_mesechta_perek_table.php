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
        Schema::create('mesechta_perek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesechta_id')->constrained('mesechta')->onDelete('cascade');
            $table->string('perek');
            $table->boolean('completed')->default(false);
            $table->date('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesechta_perek');
    }
};
