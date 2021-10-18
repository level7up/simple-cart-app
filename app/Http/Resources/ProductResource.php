<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=> Ucwords($this->name),
            'descreption'=> $this->descreption,
            'discount'=> $this->discount,
            'Weight'=> $this->Weight,
            'price'=> $this->price,
            'country'=> $this->country,
            'vat'=> $this->vat,
            'rate'=> $this->rate,
            'shipping'=>$this->shipping,
            'category_id'=> $this->category_id,
            'discount_id'=> $this->discount_id,

        ];
    }
}
