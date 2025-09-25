<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone');
            $table->string('position')->nullable()->after('avatar');
            $table->string('department')->nullable()->after('position');
            $table->date('date_of_birth')->nullable()->after('department');
            $table->string('employee_id')->unique()->nullable()->after('date_of_birth');
            $table->timestamp('last_login_at')->nullable()->after('employee_id');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->boolean('is_active')->default(true)->after('last_login_ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'avatar',
                'position',
                'department',
                'date_of_birth',
                'employee_id',
                'last_login_at',
                'last_login_ip',
                'is_active'
            ]);
        });
    }
};
