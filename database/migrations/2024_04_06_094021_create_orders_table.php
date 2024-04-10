<?php

use App\Enums\OrderStatusEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentStatusEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedInteger('total_price');
            $table->enum('status', OrderStatusEnums::toArray());

            $table->string('shipping_address');
            $table->string('shipping_country');
            $table->string('shipping_state');
            $table->string('shipping_postal_code');

            $table->enum('payment_method', PaymentMethodEnums::toArray());
            $table->enum('payment_status', PaymentStatusEnums::toArray());
            $table->string('cc_number');
            $table->string('cc_expiration');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
