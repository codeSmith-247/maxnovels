<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_to_books', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('author_id')->constrained('authors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('author_to_books');
    }
}
