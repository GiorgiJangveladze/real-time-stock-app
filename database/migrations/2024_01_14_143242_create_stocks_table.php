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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->timestamp('report_date')->notnull()->index();
            $table->decimal('open', 10, 2)->notnull();
            $table->decimal('high', 10, 2)->notnull();
            $table->decimal('low', 10, 2)->notnull();
            $table->decimal('close', 10, 2)->notnull();
            $table->bigInteger('volume')->notnull();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unique(['company_id', 'report_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
