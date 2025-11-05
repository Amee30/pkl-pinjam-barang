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
        // Update enum untuk tambah waiting_return
        DB::statement("ALTER TABLE borrowings MODIFY COLUMN status ENUM('pending', 'waiting_pickup', 'borrowed', 'waiting_return', 'returned', 'rejected', 'overdue') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback ke enum sebelumnya
        DB::statement("ALTER TABLE borrowings MODIFY COLUMN status ENUM('pending', 'waiting_pickup', 'borrowed', 'returned', 'rejected', 'overdue') NOT NULL DEFAULT 'pending'");
    }
};
