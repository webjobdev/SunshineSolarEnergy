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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable()->index();
            $table->foreign('brand_id')->references('id')->on('product_brands')->nullOnDelete();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('product_categories')->nullOnDelete();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('new', ['active', 'inactive'])->default('inactive');
            $table->enum('trending', ['active', 'inactive'])->default('inactive');
            $table->enum('show_on_home_page', ['active', 'inactive'])->default('inactive');
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};