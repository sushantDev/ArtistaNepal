<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'sen_name',
        'sen_email',
        'rec_name',
        'rec_email',
        'message',
        'subject',
        'price',
        'date',
        'venue'
    ];
}