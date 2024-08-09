<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class College extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function Users(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function CourseSelection(): HasOne
    {
        return $this->hasOne(User::class);
    }

    

}
