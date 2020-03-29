<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Property;

/**
 * Class PropertyTransformer.
 *
 * @package namespace App\Transformers;
 */
class PropertyTransformer extends TransformerAbstract
{
    /**
     * Transform the Property entity.
     *
     * @param \App\Entities\Property $model
     *
     * @return array
     */
    public function transform(Property $model)
    {
        return [
            'id'    => (int) $model->id,
            'suburb' => $model->suburb,
            'state' => $model->state,
            'country' => $model->country,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
