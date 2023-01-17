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
        Schema::create('user_workspace', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->nullable()->unsigned();
            $table->biginteger('workspace_id')->nullable()->unsigned();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workspace_id')->nullable()->references('id')->on('workspaces')->onDelete('cascade');
            $table->boolean('ownership')->default(0)->onDelete('cascade');
            $table->boolean('admin')->default(0)->onDelete('cascade');
            //$table->string("workspace_cover_name")->nullable()->onDelete('cascade');
            //$table->string("workspace_cover_path")->nullable()->onDelete('cascade');
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
        Schema::table('user_workspace', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['workspace_id']);
        });

        Schema::table('user_workspace', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('workspace_id');
            $table->dropColumn('ownership');
            $table->dropColumn('admin');
            //$table->dropColumn('workspace_cover_name');
            //$table->dropColumn('workspace_cover_path');
        });
        //Schema::dropIfExists('user_workspace');
    }
};
