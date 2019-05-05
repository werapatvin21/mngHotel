<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropStaffRoleColumnFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'staff_role_reception',
                'staff_role_housekeeping',
                'staff_role_food_and_beverage']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('staff_role_reception')->nullable()->default(false);
            $table->boolean('staff_role_housekeeping')->nullable()->default(false);
            $table->boolean('staff_role_food_and_beverage')->nullable()->default(false);
        });
    }
}
