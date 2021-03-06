<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('business_categoryId');       
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('abn');
            $table->string('company_website');
            $table->string('address');
            $table->integer('state_id');
            $table->integer('pin_code');
            $table->string('image');
            $table->string('mobile',20);
            $table->string('open_hour',10);
            $table->string('closing_hour',10);
            $table->string('services');
            $table->string('products');
            $table->longText('description');
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('twitter_link');
            $table->string('youtube_link');
            $table->string('linkedin_link');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }

    
}
