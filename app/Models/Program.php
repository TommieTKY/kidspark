<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\Relations\HasMany;



class Program extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public function instructors(): BelongsToMany
    {
    return $this->belongsToMany(Instructor::class);
    }
    protected $fillable = ['title', 'description', 'image', 'price'];
}
