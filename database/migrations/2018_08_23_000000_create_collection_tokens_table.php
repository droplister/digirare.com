<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_tokens', function (Blueprint $table) {
            $table->unsignedInteger('collection_id')->index();
            $table->unsignedInteger('token_id')->index();
            $table->string('image_url')->unique();
            $table->boolean('primary')->default(1);
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
        Schema::dropIfExists('collection_tokens');
    }
}
