<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "type" => "ticket",
            "id" => $this->id,
            "attributes" => [
                "title" => $this->title,
                "description" => $this->when(
                     $request->routeIs('api.v1tickets.show'),
                     $this->description
                ),
                "status" => $this->status,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "relationships" => [
                "author" => [
                    "data" => [
                        "type" => "user",
                        "id" => $this->user_id
                    ],
                    "links" => [
                        "self" => "todo"
                    ]
                ]
            ],
            "includes" => [
                new UserResource($this->user)
            ],
            "links" => [
                "self" => route("api.v1tickets.show", $this->id)
            ]
        ];
    }
}
