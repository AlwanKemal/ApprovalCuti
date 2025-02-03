<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->index();

            $table->foreignId('approver1_id')->nullable()->index();
            $table->foreign('approver1_id')
                  ->references('id')->on('users')
                  ->onDelete('set null')
                  ->name('fk_approver1_id_users');  

            $table->foreignId('approver2_id')->nullable()->index();
            $table->foreign('approver2_id')
                  ->references('id')->on('users')
                  ->onDelete('set null')
                  ->name('fk_approver2_id_users');  

            $table->date('start_date');
            $table->date('end_date');

            $table->enum('status_approver1', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status_approver2', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
}
