<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('subject_type');
            $table->unsignedBigInteger('subject_id');
            $table->string('action')->default('view');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'subject_type', 'subject_id']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
