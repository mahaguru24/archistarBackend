<?php

namespace App\Presenters;

use App\Transformers\PropertyAnalyticTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PropertyAnalyticPresenter.
 *
 * @package namespace App\Presenters;
 */
class PropertyAnalyticPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PropertyAnalyticTransformer();
    }
}
