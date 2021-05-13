<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('communities')->truncate();
        Schema::table('communities', function (Blueprint $table) {
            $table->integer('created_by')->after('description');
        });
        $data = [];
        for ($i=0; $i < 6 ; $i++) { 
            $data[] = [
                'communityCategoryId' => $i+1,
                'image' => 'homepage_assets/images/community-bg.jpg',
                'title' => 'Community',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'created_by' => 1,
            ];
        }
        DB::table('communities')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn(['created_by','likes']);
        });
    }
}
