<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_collection', function (Blueprint $table) {
            $table->unsignedInteger('card_id')->index();
            $table->unsignedInteger('collection_id')->index();
            $table->unsignedInteger('artist_id')->nullable()->index();
            $table->string('image_url');
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
        Schema::dropIfExists('card_collection');
    }
}
