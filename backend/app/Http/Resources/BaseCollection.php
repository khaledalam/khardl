<?php
namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */

  public function template($request=null)
  {
    return [

      'data' => $this->collection,
      "meta" => [
        "current_page" => $this->currentPage(),
        "last_page" =>  $this->lastPage(),
        "per_page" =>  $this->perPage(),
        "hasMorePages" =>  $this->hasMorePages(),
        "total" =>  $this->total(),
      ],
      "links" => [
        "first" =>$this->url($this->firstItem()),
        "last"  =>$this->url($this->lastPage()),
        "next"  => $this->nextPageUrl() ,
        "prev"  => $this->previousPageUrl()
      ],
    ];
  }
}
