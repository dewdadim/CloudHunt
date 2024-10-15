<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uri',
        'title',
        'description',
        'lesson_id',
        'category',
        'difficulty'
    ];

    /**
     * Get the lesson that owns the module.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get the progresses for the module.
     */
    public function progresses(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'progress')->withPivot('completed')->withTimestamps();

    }
}
