<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property DateTime $birthday
 * @property boolean $is_active
 */

class Info extends Model
{
    protected $table = "infos";

    protected $fillable = ['first_name','last_name','birthday','is_active'];

    use HasFactory;
}
