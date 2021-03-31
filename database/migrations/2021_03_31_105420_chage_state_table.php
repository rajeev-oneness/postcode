<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChageStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //$data = DB::table('states')->get();
        Schema::dropIfExists('states');
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('countryId');
            $table->string('name');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            ['countryId'=>1,'name'=>'Queensland'],
            ['countryId'=>1,'name'=>'Victoria'],
            ['countryId'=>1,'name'=>'New South Wales'],
            ['countryId'=>1,'name'=>'Tasmania'],
            ['countryId'=>1,'name'=>'South Australia'],
            ['countryId'=>1,'name'=>'Western Australia'],
            ['countryId'=>1,'name'=>'Northern Territory'],
            ['countryId'=>1,'name'=>'Australian Capital Territory'],

            ['countryId'=>2,'name' => 'Delhi'],
            ['countryId'=>2,'name' => 'Kolkata'],
            ['countryId'=>2,'name' => 'Karnataka'],
        ];
        DB::table('states')->insert($data);
        // $newData = [];
        // foreach($data as $key => $d){
        //     $newData[] = [
        //         'countryId' => 1,
        //         'name' => $d->name,
        //     ];
        // }
        // foreach($newData as $h){
        //     DB::table('states')->insert($h);
        // }
        
        //unset($newData);unset($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
}
