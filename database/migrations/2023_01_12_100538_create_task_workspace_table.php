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
        Schema::create('task_workspace', function (Blueprint $table) {
            $table->id();
            $table->biginteger('task_id')->nullable()->unsigned();
            $table->biginteger('workspace_id')->nullable()->unsigned();
            $table->biginteger('user_id')->nullable()->unsigned();
            $table->foreign('task_id')->nullable()->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workspace_id')->nullable()->references('id')->on('workspaces')->onDelete('cascade');
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
        Schema::table('task_workspace', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['workspace_id']);
        });

        Schema::table('task_workspace', function (Blueprint $table) {
            $table->dropColumn('task_id');
            $table->dropColumn('user_id');
            $table->dropColumn('workspace_id');
        });
        //Schema::dropIfExists('task_workspaces');
    }
};
