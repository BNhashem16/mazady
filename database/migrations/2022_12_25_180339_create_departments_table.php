<?php

use App\Models\Department;
use App\Models\Salary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Department::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained(Salary::getTableName())->cascadeOnDelete();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('description');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
