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
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman', 'petugas_id')) {
                $table->foreignId('petugas_id')->nullable()->after('user_id')->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('peminjaman', 'approver_id')) {
                $table->foreignId('approver_id')->nullable()->after('petugas_id')->constrained('users')->onDelete('set null');
            }
        });

        Schema::table('peminjaman_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman_detail', 'returned_by_id')) {
                $table->foreignId('returned_by_id')->nullable()->after('status_item')->constrained('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'petugas_id')) {
                $table->dropForeign(['petugas_id']);
                $table->dropColumn('petugas_id');
            }
            if (Schema::hasColumn('peminjaman', 'approver_id')) {
                $table->dropForeign(['approver_id']);
                $table->dropColumn('approver_id');
            }
        });

        Schema::table('peminjaman_detail', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman_detail', 'returned_by_id')) {
                $table->dropForeign(['returned_by_id']);
                $table->dropColumn('returned_by_id');
            }
        });
    }
};
