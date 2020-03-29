<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PropertyAnalytic;

/**
 * Class PropertyAnalyticTransformer.
 *
 * @package namespace App\Transformers;
 */
class PropertyAnalyticTransformer extends TransformerAbstract
{
    /**
     * Transform the PropertyAnalytic entity.
     *
     * @param \App\Entities\PropertyAnalytic $model
     *
     * @return array
     */
    public function transform(PropertyAnalytic $model)
    {
        return [
            'id'         => (int) $model->id,

            'property_id' => (int)$model->property_id,
            'analytic_type_id' => (int)$model->analytic_type_id,
            'value' => $model->value,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
