<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            //$table->foreign('role_id', 'role_id_fk_5358076')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('permission_id')->nullable();
            //$table->foreign('permission_id', 'permission_id_fk_5358076')->references('id')->on('permissions')->onDelete('cascade');
        });
    }
}
