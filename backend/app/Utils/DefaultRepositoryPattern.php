<?php

namespace App\Utils;
use App\Models\Tenant\Category;
use App\Interfaces\CrudInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
class DefaultRepositoryPattern implements CrudInterface
{
    protected Model $model;
    protected JsonResource $resource;
    protected $collection;
    public function all() 
    {
        return $this->resource::collection($this->model::paginate());
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
