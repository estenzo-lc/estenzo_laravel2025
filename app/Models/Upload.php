<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'uploads';

    protected $fillable = [
        'original_filename',
        'filename',
        'type',
        'uploaded_by',
    ];

    // Relationship: Upload belongs to a user
    public function user()
    {
        return $this->belongsTo(Usersinfo::class, 'uploaded_by');
    }
}