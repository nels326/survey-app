<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    /**
     * The surveys that belong to a question.
     */
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(Survey::class, 'survey_questions');
    }
}
