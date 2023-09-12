<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryPost
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\CategoryPostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'meta_description',
        'meta_keywords',
        'slug'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}

