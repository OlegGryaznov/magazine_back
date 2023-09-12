<?php


namespace App\Repositories;


use App\Models\Widget;

class WidgetRepository extends BaseRepository
{

    public function model()
    {
        return Widget::class;
    }

    /**
     * @param $type
     * @param $slug
     * @param int $limit
     * @return mixed
     */
    public function getByType($type, $value, $limit = 1, $field = 'slug')
    {
        $widgetsBuilder = $this->getModel()
            ->where('expiration_date', '>=', now())
            ->limit($limit)
            ->active();

        switch ($type) {
            case 'category':
                $widgetsBuilder->whereHas('categories', fn($q) => $q->where('categories.' . $field, $value))->limit($limit);
                break;
            case 'product':
                $widgetsBuilder->whereHas('products', fn($q) => $q->where('products.' . $field, $value))->limit($limit);
                break;
            case 'allCategories':
                $widgetsBuilder->inRandomOrder()->limit(config('widgets.limit_categories'));
                break;
        }

        return $widgetsBuilder->get();
    }
}
