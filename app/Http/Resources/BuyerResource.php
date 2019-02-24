<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;

class BuyerResource extends BaseResource
{
    public static $map = [
        'id' => 'identifier',
        'name' =>  'full_name',
        'email' => 'email_address',
        'updated_at' => 'last_modified',
        'created_at' => 'creation_date',
     ];

     public function generateLinks($request){

        return [
            [
                'rel' => 'self',
                'href' => route('buyers.show', $this->id),
            ],
            [
                'rel' => 'users',
                'href' => route('users.show', $this->id),
            ]


        ];
     }
}
