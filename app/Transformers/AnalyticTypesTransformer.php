<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AnalyticTypes;

/**
 * Class AnalyticTypesTransformer.
 *
 * @package namespace App\Transformers;
 */
class AnalyticTypesTransformer extends TransformerAbstract
{
    /**
     * Transform the AnalyticTypes entity.
     *
     * @param \App\Entities\AnalyticTypes $model
     *
     * @return array
     */
    public function transform(AnalyticTypes $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'units' => $model->units,
            'is_numeric' => $model->is_numeric,
            'num_decimal_places' => (int)$model->num_decimal_places,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
