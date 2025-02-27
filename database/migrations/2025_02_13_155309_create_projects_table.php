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
            $table->string('client_name');
            $table->string('company'); // Added company column
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Track logged-in user
            $table->foreignId('project_type_id')->constrained('project_types')->onDelete('cascade');
            $table->foreignId('project_subcategory_id')->nullable()->constrained()->onDelete('cascade'); // Add this line
            $table->decimal('price', 10, 2);
            $table->date('starting_date');
            $table->date('remain_date')->nullable(); // Added remain_date column
            $table->text('note')->nullable();
            $table->enum('status', ['not_complete', 'complete'])->default('not_complete'); // Status field
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
