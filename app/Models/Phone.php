<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['contact_id', 'phone_number'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
