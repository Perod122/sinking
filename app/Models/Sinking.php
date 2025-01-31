<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinking extends Model
{
    use HasFactory;

    protected $table = 'sinking'; // Table name
    protected $primaryKey = 'SinkID'; // Primary key column

    protected $fillable = [
        'ownerID',
        'dateStart',
        'dateEnd',
        'method',
        'payment',
    ];

    // Relationship with SinkMember
    public function members()
{
    return $this->hasMany(SinkMember::class, 'sinkMemID', 'SinkID');
}
}