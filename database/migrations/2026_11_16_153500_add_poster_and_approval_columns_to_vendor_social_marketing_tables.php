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
                if (!Schema::hasColumn('vendor_face_books', 'title')) {
                    $table->string('title', 255)->nullable()->after('package_id');
                }
                if (!Schema::hasColumn('vendor_face_books', 'sub_title')) {
                    $table->string('sub_title', 255)->nullable()->after('title');
                }
                if (!Schema::hasColumn('vendor_face_books', 'poster_image')) {
                    $table->string('poster_image', 255)->nullable()->after('sub_title');
                }
                if (!Schema::hasColumn('vendor_face_books', 'link')) {
                    $table->string('link', 255)->nullable()->after('poster_image');
                }
                if (!Schema::hasColumn('vendor_face_books', 'approval_status')) {
                    $table->string('approval_status', 50)->default('Pending')->after('is_subscribed');
                }
                if (!Schema::hasColumn('vendor_face_books', 'admin_notes')) {
                    $table->text('admin_notes')->nullable()->after('approval_status');
                }
                if (!Schema::hasColumn('vendor_face_books', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->after('subscribed_at');
                }
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_instas', 'title')) {
                    $table->string('title', 255)->nullable()->after('package_id');
                }
                if (!Schema::hasColumn('vendor_instas', 'sub_title')) {
                    $table->string('sub_title', 255)->nullable()->after('title');
                }
                if (!Schema::hasColumn('vendor_instas', 'poster_image')) {
                    $table->string('poster_image', 255)->nullable()->after('sub_title');
                }
                if (!Schema::hasColumn('vendor_instas', 'link')) {
                    $table->string('link', 255)->nullable()->after('poster_image');
                }
                if (!Schema::hasColumn('vendor_instas', 'approval_status')) {
                    $table->string('approval_status', 50)->default('Pending')->after('is_subscribed');
                }
                if (!Schema::hasColumn('vendor_instas', 'admin_notes')) {
                    $table->text('admin_notes')->nullable()->after('approval_status');
                }
                if (!Schema::hasColumn('vendor_instas', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->after('subscribed_at');
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
                $table->dropColumn(['title', 'sub_title', 'poster_image', 'link', 'approval_status', 'admin_notes', 'approved_at']);
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                $table->dropColumn(['title', 'sub_title', 'poster_image', 'link', 'approval_status', 'admin_notes', 'approved_at']);
            });
        }
    }
};
