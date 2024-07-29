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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types');
            $table->string('project_name')->nullable();
            $table->string('olt_hostname')->nullable();
            $table->string('no_sp2k_spa')->nullable();
            $table->unsignedBigInteger('sbu_id')->nullable();
            $table->foreign('sbu_id')->references('id')->on('sbus');
            // $table->string('hp_plan')->nullable();
            // $table->string('hp_built')->nullable();
            // $table->string('fat_total')->nullable();
            // $table->string('fat_progress')->nullable();
            // $table->string('fat_built')->nullable();
            // $table->string('ip_olt')->nullable();
            $table->text('kendala')->nullable();
            $table->string('progress')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->date('start_date')->nullable();
            $table->date('target')->nullable();
            $table->date('end_date')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('radius')->nullable();
            $table->string('link_file')->nullable();
            $table->string('images')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('N');
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id')->references('id')->on('users');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
