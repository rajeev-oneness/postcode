<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('short_description', 2000);
            $table->string('description', 5000);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            [
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pulvinar metus massa, non condimentum enim convallis eu. Donec faucibus nec massa vel sollicitudin. Duis a diam nec mi elementum vestibulum. Pellentesque et felis non justo rhoncus dapibus',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pulvinar metus massa, non condimentum enim convallis eu. Donec faucibus nec massa vel sollicitudin. Duis a diam nec mi elementum vestibulum. Pellentesque et felis non justo rhoncus dapibus. Quisque et tincidunt tortor, at eleifend turpis. Nullam ac mauris volutpat, tempor massa ut, venenatis nisl. Maecenas justo diam, ultricies sit amet nunc non, volutpat ullamcorper ante. Nulla est risus, blandit sit amet vestibulum sed, tincidunt a leo. Nam vitae varius sapien, vel faucibus enim. Phasellus sed interdum ex'
            ]
        ];

        DB::table('about_us')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_us');
    }
}
