<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            /**
             * The content of user contact.
             * @example "John Doe.."
             * @default "..."
             */
            'given_name' => $this->given_name,
            'family_name'=> $this->family_name,
            'full_name'=> $this->fullname(),
            'nick_name'=> $this->nick_name,
            'title'=>$this->title,

//            /** @format date-time  */
//            'created_at' =>$this->created_at->toDateTimeString(),
//            'updated_at' =>$this->updated_at->toDateTimeString(),

        ];


    }

}
