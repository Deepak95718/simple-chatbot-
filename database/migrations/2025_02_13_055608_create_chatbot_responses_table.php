<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chatbot_responses', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('response');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_responses');
    }
};
