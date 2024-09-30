<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property DateTime $birthday
 * @property boolean $is_active
 * @property int|null $image_id
 * @property Image|null $image
 * @property Collection|Feedback[] $feedbacks
 * @property Collection|Feedback[] $last3feedbacks
 * 
 *  @property-read float $averageRating
 */

class Info extends Model
{
    protected $table = "infos";

    protected $fillable = ['first_name','last_name','birthday','is_active'];

    use HasFactory;

    public function image(): BelongsTo{
        return $this->belongsTo(Image::class,'image_id','id');
    }
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'info_id', 'id');
    }

    public function last3feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'info_id', 'id')
            ->orderByDesc('created_at')->limit(3);
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->feedbacks()->avg('rating') ?? 0.0;
    }
}
