<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("feedbacks",function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("info_id");
            $table->unsignedSmallInteger("rating");
            $table->string("comment",1000);
            $table->timestamps();
            
            $table->foreign('info_id', 'FK_feedbacks_info_id')
            ->references('id')
            ->on('infos') 
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
