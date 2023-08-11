<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Survey extends Model
{
    use HasFactory;

    /**
     * The questions that belong to a survey.
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'survey_questions');
    }
}
