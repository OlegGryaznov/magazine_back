<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GroupAttribute
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|GroupAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupAttribute whereName($value)
 * @mixin \Eloquent
 */
class GroupAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'name'
    ];

    public function attributes()
    {
        return $this->hasMany(Attribute::class,'group_id');
    }

}
