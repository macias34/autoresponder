<?php

use App\Models\SmtpConfiguration;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('smtp_configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('host')->default('smtp.localhost');
            $table->string('user')->default('user');
            $table->string('password')->default('password');
            $table->foreignIdFor(User::class)->nullable();
            $table->integer('port')->default(587);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(SmtpConfiguration::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smtp_configurations');
    }
};
