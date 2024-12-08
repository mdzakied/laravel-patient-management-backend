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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->string('name')->unique();                                      
            $table->date('date_of_birth');               
            $table->enum('gender', ['male', 'female']); 
            $table->string('phone_number', 20)->unique()->nullable();   
            $table->string('email')->unique()->nullable();    
            $table->text('address')->nullable();         
            $table->string('emergency_contact_name')->nullable(); 
            $table->string('emergency_contact_phone', 20)->nullable();  
            $table->boolean('is_active')->default(true);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
