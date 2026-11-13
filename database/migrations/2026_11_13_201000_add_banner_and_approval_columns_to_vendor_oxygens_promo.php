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
        if (Schema::hasTable('vendor_oxygens_promo')) {
            Schema::table('vendor_oxygens_promo', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_oxygens_promo', 'package_id')) {
                    $table->unsignedBigInteger('package_id')->nullable()->after('vendor_id');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'title')) {
                    $table->string('title', 255)->nullable()->after('package_id');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'sub_title')) {
                    $table->string('sub_title', 255)->nullable()->after('title');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'banner_image')) {
                    $table->string('banner_image', 255)->nullable()->after('sub_title');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'link')) {
                    $table->string('link', 255)->nullable()->after('banner_image');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'is_subscribed')) {
                    $table->tinyInteger('is_subscribed')->default(0)->after('status');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'approval_status')) {
                    $table->string('approval_status', 50)->default('Pending')->after('is_subscribed');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'admin_notes')) {
                    $table->text('admin_notes')->nullable()->after('approval_status');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'subscribed_at')) {
                    $table->timestamp('subscribed_at')->nullable()->after('admin_notes');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->after('subscribed_at');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'expires_at')) {
                    $table->timestamp('expires_at')->nullable()->after('approved_at');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'razorpay_payment_id')) {
                    $table->string('razorpay_payment_id', 191)->nullable()->after('expires_at');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'razorpay_order_id')) {
                    $table->string('razorpay_order_id', 191)->nullable()->after('razorpay_payment_id');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'razorpay_signature')) {
                    $table->string('razorpay_signature', 191)->nullable()->after('razorpay_order_id');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'payment_status')) {
                    $table->string('payment_status', 50)->default('Unpaid')->after('razorpay_signature');
                }
                if (!Schema::hasColumn('vendor_oxygens_promo', 'paid_amount')) {
                    $table->decimal('paid_amount', 10, 2)->nullable()->after('payment_status');
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
        if (Schema::hasTable('vendor_oxygens_promo')) {
            Schema::table('vendor_oxygens_promo', function (Blueprint $table) {
                $table->dropColumn([
                    'package_id',
                    'title',
                    'sub_title',
                    'banner_image',
                    'link',
                    'is_subscribed',
                    'approval_status',
                    'admin_notes',
                    'subscribed_at',
                    'approved_at',
                    'expires_at',
                    'razorpay_payment_id',
                    'razorpay_order_id',
                    'razorpay_signature',
                    'payment_status',
                    'paid_amount'
                ]);
            });
        }
    }
};
