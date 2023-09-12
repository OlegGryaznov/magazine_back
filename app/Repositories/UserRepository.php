<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }

    public function getCartProducts($id) : ?Collection
    {
        return $this->getModel()->find($id)->cart?->products;
    }
}
