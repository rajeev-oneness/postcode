<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommunityGroupsTable20052021 extends Migration
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
            $table->string('image')->after('name');
            $table->longText('description')->after('image');
        });
        $data = [
            ['name' => 'Badminton Club', 'image' => 'homepage_assets/images/community-bg.jpg', 'description' => 'Fusce sagittis arcu commodo congue viverra. In hac habitasse platea dictumst. Sed dapibus velit ut vulputate iaculis. Nulla facilisi.', 'created_by' => 1],
            ['name' => '5-a-side football', 'image' => 'homepage_assets/images/community-bg.jpg', 'description' => 'Vestibulum vitae ligula nec odio suscipit sollicitudin sed quis sapien. Ut scelerisque a justo in sollicitudin. Pellentesque commodo eu sem eget fermentum. In hac habitasse platea dictumst.', 'created_by' => 1],
            ['name' => 'Knitting', 'image' => 'homepage_assets/images/community-bg.jpg', 'description' => 'Fusce sagittis arcu commodo congue viverra. In hac habitasse platea dictumst. Sed dapibus velit ut vulputate iaculis. Nulla facilisi.', 'created_by' => 1],
            ['name' => 'Bands', 'image' => 'homepage_assets/images/community-bg.jpg', 'description' => 'Vestibulum vitae ligula nec odio suscipit sollicitudin sed quis sapien. Ut scelerisque a justo in sollicitudin. Pellentesque commodo eu sem eget fermentum. In hac habitasse platea dictumst.', 'created_by' => 1],
            ['name' => 'Reading Club', 'image' => 'homepage_assets/images/community-bg.jpg', 'description' => 'Fusce sagittis arcu commodo congue viverra. In hac habitasse platea dictumst. Sed dapibus velit ut vulputate iaculis. Nulla facilisi.', 'created_by' => 1],
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
            $table->dropColumn(['image', 'description']);
        });
    }
}
