<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBusinessCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('business_categories')->truncate();
        Schema::table('business_categories', function (Blueprint $table) {
            $table->string('icon');
            $table->string('image');
        });
        $data = [
            ['name'=>'Restaurants','icon'=>'homepage_assets/images/cat6.png','image'=>'homepage_assets/images/c3.jpg'],
            ['name'=>'Adult','icon'=>'homepage_assets/images/cat5.png','image'=>'homepage_assets/images/cards-1066386_1920.png'],
            ['name'=>'Accommodation','icon'=>'homepage_assets/images/cat1.png','image'=>'homepage_assets/images/c1.jpg'],
            ['name'=>'Food & Beverages','icon'=>'homepage_assets/images/cat2.png','image'=>'homepage_assets/images/c3.jpg'],
            ['name'=>'Government','icon'=>'homepage_assets/images/cat4.png','image'=>'homepage_assets/images/ev3.jpg'],
            ['name'=>'Automotive','icon'=>'homepage_assets/images/cat7.png','image'=>'homepage_assets/images/14306.png'],
        ];
        DB::table('business_categories')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_categories', function (Blueprint $table) {
            $table->dropColumn(['icon','image']);
        });
    }
}
