<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Widget
 *
 * @property int $id
 * @property string $section
 * @property string $text
 * @property string $link
 * @property string $text_link
 * @property int $is_active
 * @property string $start_date
 * @property string $expiration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Widget active()
 * @method static \Database\Factories\WidgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereTextLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Widget extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const IS_ACTIVE = 1;

    protected $fillable = [
        'section',
        'text',
        'link',
        'text_link',
        'is_active',
        'start_date',
        'expiration_date'
    ];

    public function scopeActive($q){
        $q->where('is_active', self::IS_ACTIVE);
    }

    public function categories(): MorphToMany{
        return $this->morphedByMany(Category::class, 'widgetable');
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'widgetable');
    }

}
