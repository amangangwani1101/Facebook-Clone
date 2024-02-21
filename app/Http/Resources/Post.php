<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResources;
use Illuminate\Http\Resources\Json\JsonResource;
 
class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'=>[
                'type'=>'posts',
                'post_id'=> $this->id,
                'attributes'=>[
                    'posted_by' => new UserResources($this->user),
                    'body' => $this->body,
                ]
            ], 
            'links' =>[
                'self' =>url('/posts/'.$this->id),
            ],
        ];
    }
}
