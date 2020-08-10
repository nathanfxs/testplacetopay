<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->text('description');

            $table->text('customer_name');
            $table->string('customer_document_type',10);
            $table->string('customer_document',80);

            $table->text('customer_country');
            $table->text('customer_city');
            $table->text('customer_province');

            $table->text('customer_street');
            $table->text('customer_postal_code');
            $table->string('customer_phone',30);
            $table->string('customer_mobile',30);
            $table->text('customer_email');
            
            $table->string('status',20);

            $table->dateTime('created_at',0);
            $table->dateTime('updated_at',0);

            $table->decimal('amount', 8, 2);
            $table->text('request_id_placetopay');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
