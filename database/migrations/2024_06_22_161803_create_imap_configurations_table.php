<?php

use App\Models\ImapConfiguration;
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
        Schema::create('imap_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('host')->default('imap.localhost');
            $table->integer('port')->default(993);
            $table->string('encryption')->default('ssl');
            $table->boolean('validate_cert')->default(true);
            $table->string('username')->default('username');
            $table->string('password')->default('password');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(ImapConfiguration::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imap_configurations');
    }
};
