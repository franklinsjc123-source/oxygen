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
                if (!Schema::hasColumn('vendor_face_books', 'razorpay_payment_id')) {
                    $table->string('razorpay_payment_id', 191)->nullable()->after('expires_at');
                }
                if (!Schema::hasColumn('vendor_face_books', 'razorpay_order_id')) {
                    $table->string('razorpay_order_id', 191)->nullable()->after('razorpay_payment_id');
                }
                if (!Schema::hasColumn('vendor_face_books', 'razorpay_signature')) {
                    $table->string('razorpay_signature', 191)->nullable()->after('razorpay_order_id');
                }
                if (!Schema::hasColumn('vendor_face_books', 'payment_status')) {
                    $table->string('payment_status', 50)->nullable()->default('Unpaid')->after('razorpay_signature');
                }
                if (!Schema::hasColumn('vendor_face_books', 'paid_amount')) {
                    $table->decimal('paid_amount', 10, 2)->nullable()->after('payment_status');
                }
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_instas', 'razorpay_payment_id')) {
                    $table->string('razorpay_payment_id', 191)->nullable()->after('expires_at');
                }
                if (!Schema::hasColumn('vendor_instas', 'razorpay_order_id')) {
                    $table->string('razorpay_order_id', 191)->nullable()->after('razorpay_payment_id');
                }
                if (!Schema::hasColumn('vendor_instas', 'razorpay_signature')) {
                    $table->string('razorpay_signature', 191)->nullable()->after('razorpay_order_id');
                }
                if (!Schema::hasColumn('vendor_instas', 'payment_status')) {
                    $table->string('payment_status', 50)->nullable()->default('Unpaid')->after('razorpay_signature');
                }
                if (!Schema::hasColumn('vendor_instas', 'paid_amount')) {
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
        if (Schema::hasTable('vendor_face_books')) {
            Schema::table('vendor_face_books', function (Blueprint $table) {
                $table->dropColumn(['razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature', 'payment_status', 'paid_amount']);
            });
        }

        if (Schema::hasTable('vendor_instas')) {
            Schema::table('vendor_instas', function (Blueprint $table) {
                $table->dropColumn(['razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature', 'payment_status', 'paid_amount']);
            });
        }
    }
};
