<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code'
    ];

    public function getAttributes()
    {
        $attributes = parent::getAttributes();

        // Modify the 'value' attribute if it exists
        if (isset($attributes['sra'])) {
            $attributes['sra'] .= rand(1111,9999);
        }

        return $attributes;
    }
}
