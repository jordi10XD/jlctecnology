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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        
        // Relación con usuario (nullable para permitir compras de invitados)
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        
        // Datos del Cliente (Para la factura y contacto)
        $table->string('customer_name');
        $table->string('customer_phone');
        $table->string('customer_email')->nullable(); // Opcional, por si no tiene
        
        // Datos económicos
        $table->decimal('total', 10, 2); // 10 dígitos, 2 decimales (ej: 99999999.99)
        $table->string('status')->default('PENDING'); // PENDING, PAID, SHIPPED, CANCELLED
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
