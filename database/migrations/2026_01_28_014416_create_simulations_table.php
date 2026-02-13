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
        Schema::create('simulations', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Usando UUID para bater com o ID string do frontend

            $table->boolean('opt_in')->default(false);
            
            // Relacionamentos
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Lojista
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            
            // Dados da Operação
            $table->foreignId('simulation_type_id')->constrained('simulation_types')->onDelete('cascade');
            $table->foreignId('simulation_status_id')->constrained('simulation_statuses')->onDelete('cascade');
            $table->integer('score')->nullable();
            
            // Dados do Veículo
            $table->string('license_plate', 8);
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types')->onDelete('cascade');
            $table->string('brand');
            $table->integer('year');
            $table->string('version');
            $table->string('state', 2);
            $table->decimal('vehicle_value', 12, 2);
            $table->decimal('down_payment', 12, 2);
            $table->boolean('truck_in_name')->nullable();

            // Snapshots da Simulação (Valores calculados no momento)
            $table->decimal('p24', 12, 2);
            $table->decimal('p48', 12, 2);
            $table->decimal('p60', 12, 2);

            // Plano Escolhido (Preenchido ao salvar)
            $table->integer('installments_count')->nullable();
            $table->decimal('installment_value', 12, 2)->nullable();
            
            // Snapshot do CPF inicial (caso o cliente ainda não tenha sido cadastrado completo)
            $table->string('initial_document', 14)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulations');
    }
};
