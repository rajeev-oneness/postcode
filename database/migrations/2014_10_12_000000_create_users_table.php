<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile',15);
            $table->string('gender')->comment('Male, Female');
            $table->string('marital')->comment('Single,Married');
            $table->dateTime('dob');
            $table->string('image');
            $table->date('anniversary');
            $table->bigInteger('userType');
            $table->tinyInteger('subscribed')->comment('1:Subscribed,0:unsubscribed')->default(1);
            $table->string('alternate_mobile');
            $table->tinyInteger('status')->comment('1:Active, 0:Blocked')->default(1);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        // Insert age groups
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('secret'),
                'userType' => 1,
            ]
        ];

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
