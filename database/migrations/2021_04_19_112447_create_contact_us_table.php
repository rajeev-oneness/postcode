<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contact_us');
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->comment('1:Settings,2:Visistors Contact,3:Business Contact');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('subject');
            $table->string('message');
            $table->string('address');
            $table->integer('claimed_by');
            $table->string('remarks');
            $table->string('media');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        //default company contact details
        $data = [
            [
                'type' => 1,
                'name' => 'Our Postcode',
                'email' => 'admin@admin.com',
                'mobile' => 9876543210,
                'address' => 'Australia'
            ]
        ];

        DB::table('contact_us')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
