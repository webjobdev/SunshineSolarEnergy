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
        Schema::create('website_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('config_key')->unique();
            $table->longText('config_value')->nullable();
            $table->enum('config_type', [
                'text',
                'textarea',
                'image',
                'file',
                'boolean',
                'number',
                'json',
                'email',
                'color',
                'url'
            ])->default('text');
            $table->string('config_group')->default('general');
            $table->string('config_label');
            $table->string('config_placeholder')->nullable();
            $table->string('config_help')->nullable();
            $table->json('config_options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_editable')->default(true);
            $table->integer('sort_order')->default(0);

            // Audit fields
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();

            // Indexes
            $table->index('config_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_configurations');
    }
};
