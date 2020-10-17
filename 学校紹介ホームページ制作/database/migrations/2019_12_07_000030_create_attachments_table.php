<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id')->index();
            $table->string('filename');
            $table->unsignedBigInteger('bytes');
            $table->string('mime');
            $table->timestamps();
            // $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //        Schema::table('attachments', function (Blueprint $table) {
        //            $table->dropForeign('attachments_article_id_foreign');
        //        });
        Schema::dropIfExists('attachments');
    }
}