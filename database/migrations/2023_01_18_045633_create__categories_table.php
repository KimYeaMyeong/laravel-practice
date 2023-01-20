<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId("category_id");
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name")->unique();
            $table->foreignId("brand_id");
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name")->unique();
        });

        Schema::create('modifylogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("log");
            $table->foreignId("user_id");
            $table->foreignId("book_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('modifylog_id');
        });

        Schema::dropIfExists('categories');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('modifylogs');
    }
};
