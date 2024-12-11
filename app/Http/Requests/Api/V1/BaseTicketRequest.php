<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseTicketRequest extends FormRequest
{

    public function mappedAttributes() {
        $attributeMap = [
            'data.attributes.title' => 'title',
            'data.attributes.description' => 'description',
            'data.attributes.status' => 'status',
            'data.relationships.author.data.id' => 'user_id'
        ];

        $attributesToUpdate = [];

        foreach ($attributeMap as $key => $value) {
            if ($this->has($key)) {
                $attributesToUpdate[$value] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }

    public function messages() {
        return [
            'data.attributes.status' => 'The data.attributes.status field must be one of A, C, H, X',
        ];
    }
}
