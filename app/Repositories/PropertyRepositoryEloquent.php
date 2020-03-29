<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\propertyRepository;
use App\Entities\Property;
use App\Validators\PropertyValidator;

/**
 * Class PropertyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PropertyRepositoryEloquent extends BaseRepository implements PropertyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Property::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PropertyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
