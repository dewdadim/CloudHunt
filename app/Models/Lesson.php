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

    public static function getLessonsWithUserProgress($user)
    {
        return static::with(['modules' => function($query) use ($user) {
            $query->select('modules.*')
                  ->selectRaw('COALESCE(progresses.completed, false) as completed')
                  ->leftJoin('progresses', function($join) use ($user) {
                      $join->on('modules.id', '=', 'progresses.module_id')
                           ->where('progresses.user_id', '=', $user->id);
                  });
        }])
        ->whereHas('modules.progresses', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get()
        ->map(function($lesson) {
            $completedModules = collect($lesson->modules)->where('completed', true)->count();
            $totalModules = $lesson->modules->count();
            $completed = $totalModules > 0 && $completedModules === $totalModules;

            return [
                'id' => $lesson->id,
                'title' => $lesson->title, 
                'uri' => $lesson->uri,
                'modules' => $lesson->modules->toArray(),
                'completed' => $completed
            ];
        })
        ->reject(function($lesson) {
            return $lesson['modules'][0]['completed'] === true;
        })
        ->sortByDesc(function($lesson) {
            return collect($lesson['modules'])->where('completed', false)->count();
        })
        ->values()
        ->toArray();
    }
}
