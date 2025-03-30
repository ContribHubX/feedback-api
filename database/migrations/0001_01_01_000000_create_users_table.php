<?php

use App\Enums\RoleEnums;
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
        Schema::create(User::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(User::ID)->primary()->comment("Primary key");
            $table->string(User::NAME)->comment("User's name");
            $table->string(User::EMAIL)->unique()->comment("Unique email");
            $table->string(User::EMAIL_VERIFIED_AT)->nullable()->comment("Email verification timestamp");
            $table->string(User::VERIFICATION_TOKEN)->nullable()->comment("Email verification token");
            $table->string(User::PASSWORD)->comment("Hashed password");
            $table->enum(User::ROLE, RoleEnums::values())->default(RoleEnums::USER->value)->comment("User role");
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
