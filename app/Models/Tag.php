<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\LessonTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Get the progress for the module.
     */
    public function lessonsTags(): HasMany
    {
        return $this->hasMany(LessonTag::class);
    }
}
