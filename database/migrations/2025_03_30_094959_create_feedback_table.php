<?php

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid(Feedback::ID)->primary()->comment("Primary Key");
            $table->uuid(Feedback::USER_ID)->comment("Foreign key (Users)");
            $table->tinyInteger(Feedback::RATING)->comment("Rating (1-5)");
            $table->text(Feedback::FEEDBACK_CONTENT)->nullable()->comment("Feedback Content");
            $table->boolean(Feedback::ACKNOWLEDGED)->default(false)->comment("Acknowledged (true/false)");
            $table->text(Feedback::ACKNOWLEDGE_CONTENT)->nullable()->comment("Acknowledgment Content");
            $table->timestamps();


            $table->foreign(Feedback::USER_ID)
                ->references(User::ID)
                ->on('users')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
