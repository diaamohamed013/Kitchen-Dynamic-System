<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kitchen_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('status', ['queued', 'received', 'preparing', 'ready', 'served'])->default('queued');
            $table->timestamp('dispatched_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('served_at')->nullable();
            $table->integer('estimated_prep_minutes')->default(15);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kitchen_tickets');
    }
};
