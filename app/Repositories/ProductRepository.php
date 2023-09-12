<?php


namespace App\Repositories;

use App\Models\Product;
use App\Models\Product as Model;

class ProductRepository extends BaseRepository
{

    public function model()
    {
        return Model::class;
    }

    public function getProductsAllCategories($paginate, $sort)
    {
        return $this->getModel()
            ->active()
            ->withWhereHas('categories', function ($q) {
                $q->active();
            })
            ->with([
                'labels',
                'media'
            ])
            ->when(!empty($sort), function ($q) use ($sort) {
                switch ($sort) {
                    case 'default':
                        $q->orderBy('sort', 'asc');
                        break;
                    case 'priceMinMax':
                        $q->orderBy('price', 'asc');
                        break;
                    case 'priceMaxMin':
                        $q->orderBy('price', 'desc');
                        break;
                }
            })
            ->paginate($paginate);
    }

    public function getProductForCategory($category, $payload)
    {
        return $this->getModel()
            ->with('labels', 'media')
            ->withWhereHas('categories', function ($categoryQ) use ($category) {
                $categoryQ->where('categories.id', $category->id);
            })
            ->when(isset($payload['attr']) && !empty($payload['attr']), function ($q) use ($payload) {
                $q->whereHas('attributes', function ($attributesQ) use ($payload) {
                    $attributesQ->whereIn('attributes.id', explode(',', $payload['attr']));
                });
            })
            ->when(isset($payload['sort']) && !empty($payload['sort']), function ($q) use ($payload) {
                switch ($payload['sort']) {
                    case 'default':
                        $q->orderBy('sort', 'asc');
                        break;
                    case 'priceMinMax':
                        $q->orderBy('price', 'asc');
                        break;
                    case 'priceMaxMin':
                        $q->orderBy('price', 'desc');
                        break;
                }
            })
            ->active()
            ->paginate($payload['paginate']);
    }
}
