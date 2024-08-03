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
        Schema::table('users', function (Blueprint $table){
            $table->string('phone')->nullable()->after('password');
            $table->string('address')->nullable()->afeer('phone');
            $table->string('country')->nullable()->after('address');
            $table->string('province')->nullable()->after('country');
            $table->string('city')->nullable()->after('province');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('district')->nullable()->after('postal_code');
            $table->string('roles')->default('USER')->after('district');
            $table->string('photo')->nullable()->after('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn([
                'phone',
                'address',
                'country',
                'province',
                'city',
                'postal_code',
                'district',
                'roles',
                'photo',
            ]);
        });
    }
};
