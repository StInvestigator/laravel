<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $info_id
 * @property Info $info
 * @property int $rating
 * @property string $comment
 * 
 *  @property Carbon $created_at
 */
class Feedback extends Model
{
    protected $table = "feedbacks";

    protected $fillable = ['rating','comment'];

    public function info(): BelongsTo
    {
        return $this->belongsTo(Info::class, 'info_id', 'id');
    }

    use HasFactory;
}
