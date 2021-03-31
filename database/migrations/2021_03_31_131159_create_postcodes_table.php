<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('coutryId');
            $table->bigInteger('stateId');
            $table->string('postcode');
            $table->string('lang');
            $table->string('lot');
            $table->string('area');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        //queensland
        for ($i=200; $i <= 9999; $i++) { 
            //queensland
            if($i >= 4000 && $i <= 4999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 1,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 9000 && $i <= 9999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 1,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //victoria
            if($i >= 3000 && $i <= 3999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 2,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 8000 && $i <= 8999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 2,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //N S W
            if($i >= 1000 && $i <= 2599) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 3,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 2619 && $i <= 2899) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 3,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 2921 && $i <= 2999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 3,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //Tasmania
            if($i >= 7000 && $i <= 7999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 4,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //S A
            if($i >= 5000 && $i <= 5999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 5,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //W A
            if($i >= 6000 && $i <= 6797) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 6,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 6800 && $i <= 6999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 6,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //N T
            if($i >= 800 && $i <= 999) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 7,
                        'postcode' => '0'.$i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            //A C T
            if($i >= 200 && $i <= 299) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 8,
                        'postcode' => '0'.$i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 2600 && $i <= 2618) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 8,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
            if($i >= 2900 && $i <= 2920) {
                $data = [
                    [
                        'coutryId' => 1,
                        'stateId' => 8,
                        'postcode' => $i
                    ]
                ];
                DB::table('postcodes')->insert($data);
            }
        }
              
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcodes');
    }
}
