<?php

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Note::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->constrained(Folder::getTableName())->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', [Note::PUBLIC_TYPE, Note::PRIVATE_TYPE]);
            $table->text('content');
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
        Schema::dropIfExists('notes');
    }
};
