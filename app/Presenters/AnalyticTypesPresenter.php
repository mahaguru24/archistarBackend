<?php

namespace App\Presenters;

use App\Transformers\AnalyticTypesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnalyticTypesPresenter.
 *
 * @package namespace App\Presenters;
 */
class AnalyticTypesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnalyticTypesTransformer();
    }
}
