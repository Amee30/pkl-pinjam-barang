<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('qr_code')->unique()->nullable()->after('serial_number');
        });

        DB::statement('ALTER TABLE borrowings MODIFY COLUMN status ENUM("pending", "approved", "waiting_pickup", "borrowed", "returned", "rejected", "overdue") DEFAULT "pending"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn('qr_code');
        });

        DB::statement('ALTER TABLE borrowings MODIFY COLUMN status ENUM("pending", "approved", "borrowed", "returned", "rejected", "overdue") DEFAULT "pending"');
    }
};
