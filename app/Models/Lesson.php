<?php

namespace App\Models;

use App\Models\Module;
use App\Models\LessonTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uri',
        'title'
    ];

    /**
     * Get the modules for the lesson.
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Get the progresses for the lesson.
     */
    public function progresses(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the lessons_tags for the lesson.
     */
    public function lessonsTags(): HasMany
    {
        return $this->hasMany(LessonTag::class);
    }
}
