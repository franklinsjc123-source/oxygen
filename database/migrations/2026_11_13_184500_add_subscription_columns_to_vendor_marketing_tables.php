<?php

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
        if (Schema::hasTable('vendor_face_books')) {
            Schema::table('vendor_face_books', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_face_books', 'package_id')) {
                    $table->unsignedBigInteger('package_id')->nullable()->after('vendor_id');
                }
                if (!Schema::hasColumn('vendor_face_books', 'is_subscribed')) {
                    $table->tinyInteger('is_subscribed')->default(0)->after('status');
                }
                if (!Schema::hasColumn('vendor_face_books', 'subscribed_at')) {
                    $table->timestamp('subscribed_at')->nullable()->after('is_subscribed');
                }
                if (!Schema::hasColumn('vendor_face_books', 'expires_at')) {
                    $table->timestamp('expires_at')->nullable()->after('subscribed_at');
                }
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_instas', 'package_id')) {
                    $table->unsignedBigInteger('package_id')->nullable()->after('vendor_id');
                }
                if (!Schema::hasColumn('vendor_instas', 'is_subscribed')) {
                    $table->tinyInteger('is_subscribed')->default(0)->after('status');
                }
                if (!Schema::hasColumn('vendor_instas', 'subscribed_at')) {
                    $table->timestamp('subscribed_at')->nullable()->after('is_subscribed');
                }
                if (!Schema::hasColumn('vendor_instas', 'expires_at')) {
                    $table->timestamp('expires_at')->nullable()->after('subscribed_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('vendor_face_books')) {
            Schema::table('vendor_face_books', function (Blueprint $table) {
                $table->dropColumn(['package_id', 'is_subscribed', 'subscribed_at', 'expires_at']);
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                $table->dropColumn(['package_id', 'is_subscribed', 'subscribed_at', 'expires_at']);
            });
        }
    }
};
