<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tax extends Model
{
     protected $table = 'tax';
    protected $primaryKey = 'id';
    protected $fillable = ['name','tax_rate', 'description', 
    'tax_type', 'start_date', 'end_date', 'currency','region','exemption_criteria',
'is_vat','applicable_to','status'
];

}
