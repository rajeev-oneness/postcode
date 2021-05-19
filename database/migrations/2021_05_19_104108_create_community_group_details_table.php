<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityGroupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_group_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->integer('community_id');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            ['group_id' => '1', 'community_id' => '1'],
            ['group_id' => '1', 'community_id' => '2'],
            ['group_id' => '1', 'community_id' => '3'],
            ['group_id' => '2', 'community_id' => '4'],
            ['group_id' => '2', 'community_id' => '5'],
            ['group_id' => '3', 'community_id' => '6'],
        ];
        DB::table('community_group_details')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_group_details');
    }
}
