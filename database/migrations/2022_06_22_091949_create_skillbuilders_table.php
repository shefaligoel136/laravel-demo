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
        Schema::create('skillbuilders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->date('publishedAt')->nullable();
            $table->boolean('isPublished')->default(0);
            $table->integer('effortTime');
            $table->integer('points');
            $table->integer('awards');
            // $table->uuid('reviewerId');
            $table->foreignUuid('reviewerId')->references('id')->on('users');
            // $table->uuid('creatorId');
            $table->foreignUuid('creatorId')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skillbuilders');
    }
};
