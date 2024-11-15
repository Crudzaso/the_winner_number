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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number', 10)->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('users', 'identification_number')) {
                $table->string('identification_number')->unique()->nullable();// Cédula de ciudadanía
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->boolean('status')->default(true);
            }
            if (!Schema::hasColumn('users', 'agreement_terms')) {
                $table->boolean('agreement_terms')->default(false);  // Aceptación de términos y condiciones
            }
            if (!Schema::hasColumn('users', 'accepted_privacy_policy')) {
                $table->boolean('accepted_privacy_policy')->default(false);  // Aceptación de política de privacidad
            }
            if (!Schema::hasColumn('users', 'total_spent')) {
                $table->decimal('total_spent', 10, 2)->default(0.00);  // Monto total gastado
            }
            if (!Schema::hasColumn('users', 'raffles_created_count')) {
                $table->integer('raffles_created_count')->default(0);
            }
            if (!Schema::hasColumn('users', 'nequi_account')) {
                $table->string('nequi_account')->nullable();  //cuenta de nequi
            }            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'google_id')) {
                $table->dropColumn('google_id');
            }
            if (Schema::hasColumn('users', 'phone_number')) {
                $table->dropColumn('phone_number');
            }
            if (Schema::hasColumn('users', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }
            if (Schema::hasColumn('users', 'identification_number')) {
                $table->dropColumn('identification_number');
            }
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'agreement_terms')) {
                $table->dropColumn('agreement_terms');
            }
            if (Schema::hasColumn('users', 'accepted_privacy_policy')) {
                $table->dropColumn('accepted_privacy_policy');
            }
            if (Schema::hasColumn('users', 'total_spent')) {
                $table->dropColumn('total_spent');  
            }
            if (Schema::hasColumn('users', 'raffles_created_count')) {
                $table->dropColumn('raffles_created_count');
            }
            if (Schema::hasColumn('users', 'nequi_account')) {
                $table->dropColumn('nequi_account');
            } 
        });
    }
};
