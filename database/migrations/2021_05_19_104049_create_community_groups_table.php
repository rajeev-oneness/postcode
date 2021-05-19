<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('name');
            $table->string('image');
            $table->longText('description');
            $table->integer('created_by');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            ['name' => 'Badminton Club', 'created_by' => 1],
            ['name' => '5-a-side football', 'created_by' => 1],
            ['name' => 'Knitting', 'created_by' => 1],
            ['name' => 'Bands', 'created_by' => 1],
            ['name' => 'Reading Club', 'created_by' => 1],
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
        Schema::dropIfExists('community_groups');
    }
}
