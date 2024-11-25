<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banks extends Model
{
    protected $table = 'banks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'bank_name',
        'branch_name',
        'cccd',
        'stk',
        'customer_id',
        'default'
    ];
    public function customers(){
        return $this->belongsTo(customers::class, 'customer_id');
    }
}
