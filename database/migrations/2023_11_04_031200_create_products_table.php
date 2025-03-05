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
            $table->id(); // big int unsiged A_I
            $table->string('name', 150)->unique(); // varchar(150)
            $table->string('image', 150); // varchar(150)
            $table->float('price', 10,2); // varchar(150)
            $table->float('sale_price', 10,2)->default(0); // varchar(150)
            $table->tinyInteger('status')->default(0);
            $table->text('content')->nullable();
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
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
