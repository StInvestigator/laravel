<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Image;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property DateTime $birthday
 * @property boolean $is_active
 * @property int|null $image_id
 * @property Image|null $image
 */

class Info extends Model
{
    protected $table = "infos";

    protected $fillable = ['first_name','last_name','birthday','is_active'];

    use HasFactory;

    public function image(): BelongsTo{
        return $this->belongsTo(Image::class,'image_id','id');
    }
}
