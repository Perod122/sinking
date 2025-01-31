<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinkMember extends Model
{
    use HasFactory;

    protected $table = 'sink_members'; // Table name
    protected $primaryKey = 'MemID'; // Primary key column

    protected $fillable = ['sinkMemID', 'fName', 'lName', 'count'];


    // Relationship with Sinking
    public function sinkings()
    {
        return $this->hasMany(Sinking::class, 'sMembers', 'sinkMemID');
    }

    // Relationship with Contributions
    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'contriMemID', 'MemID');
    }
}