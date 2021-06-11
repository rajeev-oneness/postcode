<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCommunityGroupsTable11062021 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('community_groups')->truncate();
        Schema::table('community_groups', function (Blueprint $table) {
            $table->integer('postcode')->after('created_by');
        });
        $data = [
            ['name' => 'Badminton Club', 'created_by' => 1, 'image' => 'homepage_assets/images-new/groups-1.jpg', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum, nunc id ultrices aliquam, diam eros suscipit mauris, dapibus sodales est eros et leo.', 'postcode' => 3020],
            ['name' => '5-a-side football', 'created_by' => 1, 'image' => 'homepage_assets/images-new/groups-2.jpg', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum, nunc id ultrices aliquam, diam eros suscipit mauris, dapibus sodales est eros et leo.', 'postcode' => 3020],
            ['name' => 'Knitting', 'created_by' => 1, 'image' => 'homepage_assets/images-new/groups-3.jpg', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum, nunc id ultrices aliquam, diam eros suscipit mauris, dapibus sodales est eros et leo.', 'postcode' => 3020],
            ['name' => 'Bands', 'created_by' => 1, 'image' => 'homepage_assets/images-new/groups-4.jpg', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum, nunc id ultrices aliquam, diam eros suscipit mauris, dapibus sodales est eros et leo.', 'postcode' => 3020],
            ['name' => 'Reading Club', 'created_by' => 1, 'image' => 'homepage_assets/images-new/groups-2.jpg', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum, nunc id ultrices aliquam, diam eros suscipit mauris, dapibus sodales est eros et leo.', 'postcode' => 3020],
        ];
        DB::table('community_groups')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_groups', function (Blueprint $table) {
            $table->dropColumn('postcode');
        });
    }
}
