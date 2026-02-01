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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document', 14)->unique()->index();
            $table->string('document_rg')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('marital_status')->nullable(); // Estado civil
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable(); // Profissão
            $table->string('service_time')->nullable(); // Tempo de serviço
            $table->decimal('income', 12, 2)->nullable();
            
            // Endereço
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
