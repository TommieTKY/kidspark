<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $fillable = ['name', 'email', 'bio'];

    public function programs(): BelongsToMany
    {
    return $this->belongsToMany(Program::class);
    }
}
