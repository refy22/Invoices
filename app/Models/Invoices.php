<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'invoices';
    public function section(){
        return $this->belongsTo(Sections::class);
    }
}
