<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'entity_type',
        'tin',
        'direction',
        'lpgo_path',
        'root_user',
        'root_password',
        'client_id',
        'client_secret',
        'production',
        'user_id'
    ];

    // Relationship One To Many Inverse
    public function user() {
        return $this->belongsTo(User::class);
    }
}
