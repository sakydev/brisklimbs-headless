<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('video_key', 15)->unique();
        $table->string('filename', 15)->unique();
        
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');

        $table->string('title');
        $table->text('description')->nullable();
        $table->string('tags')->default('');
        $table->integer('category_id')->default(1);
        $table->enum('scope', ['public', 'private', 'unlisted'])->default('public');
        $table->enum('status', ['pending', 'processing', 'ok', 'failed'])->default('pending');
        $table->string('qualities')->default('');
        $table->integer('duration')->default(0);
        $table->string('directory');
        $table->integer('views')->default(0);
        $table->integer('comments')->default(0);
        $table->enum('state', ['active', 'inactive', 'frozen'])->default('active');
        $table->integer('allow_comments')->default(1);
        $table->timestamp('watched_at')->default(now());
        $table->timestamp('converted_at')->default(now());
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
      Schema::dropIfExists('videos');
    }
  }
