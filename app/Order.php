<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_email', 
        'customer_mobile',
        'status',
        'amount',
        'request_id_placetopay',
        'customer_document_type',
        'customer_document',
        'customer_country',
        'customer_province',
        'customer_city',
        'customer_street',
        'customer_postal_code',
        'customer_phone',
        'description'
    ];
}
