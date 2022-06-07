<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'fr_url_partner';

    protected $fillable = [
        'name', 'cp_id', 'package_code', 'url', 'url_cp', 'created_date', 'user_created', 'status'
    ];
}
