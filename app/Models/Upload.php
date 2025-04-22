<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_filename',
        'filename',
        'type',
        'uploaded_by',
    ];

    // Define the relationship with the User model (uploaded_by)
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
