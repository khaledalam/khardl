<?php

namespace App\Utils;
use App\Models\Tenant\Category;
use App\Interfaces\CrudInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultRepositoryPattern implements CrudInterface
{
    protected Builder | Model | Collection $model;
    protected JsonResource $resource;
    protected $collection;
    public function all($request)
    {
        $model = $this->model
        ->with(['driver'])
        ->WhenSearch($request['search']??null)
        ->WhenStatus($request['status']??null)
        ->WhenDateString($request['date_string']??null)
        ->paginate($request['per_page']??1000);
        return $this->resource::collection($model);
    }


    // public function getById(Category $category): Category
    // {
    //    $category->get();
    //    return $category;
    // }

    // public function create(Category $category, array $data): Category
    // {
    //    return $category->create($data);

    // }

    // public function update(Category $category, array $data): Category
    // {
    //     $category->update($data);
    //     return  $category;
    // }

    // public function delete(Category $category): Category
    // {
    //     $category->delete();
    //     return $category;
    // }
}
