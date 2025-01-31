<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions'; // Table name
    protected $primaryKey = 'contriID'; // Primary key column

    protected $fillable = [
        'contriMemID',
        'amount',
        'datepaid',
    ];

    // Relationship with SinkMember
    public function sinkMember()
    {
        return $this->belongsTo(SinkMember::class, 'contriMemID', 'id');
    }
}