<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PropertyAnalytic.
 *
 * @package namespace App\Entities;
 */
class PropertyAnalytic extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id',
        'analytic_type_id',
        'value',
    ];

    protected $casts = [
        'value' => 'float',
    ];


    public function analytic()
    {
        return $this->belongsTo(AnalyticTypes::class, 'analytic_type_id','id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id','id');
    }

}
