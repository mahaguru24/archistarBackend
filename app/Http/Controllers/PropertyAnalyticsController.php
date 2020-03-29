<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PropertyAnalyticCreateRequest;
use App\Http\Requests\PropertyAnalyticUpdateRequest;
use App\Repositories\PropertyAnalyticRepository;
use App\Validators\PropertyAnalyticValidator;
use function GuzzleHttp\Promise\all;

/**
 * Class PropertyAnalyticsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PropertyAnalyticsController extends Controller
{
    /**
     * @var PropertyAnalyticRepository
     */
    protected $repository;

    /**
     * @var PropertyAnalyticValidator
     */
    protected $validator;

    /**
     * PropertyAnalyticsController constructor.
     *
     * @param PropertyAnalyticRepository $repository
     * @param PropertyAnalyticValidator $validator
     */
    public function __construct(
        PropertyAnalyticRepository $repository,
        PropertyAnalyticValidator $validator
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $propertyAnalytics = $this->repository->all();

        return response()->json([
            'data' => $propertyAnalytics,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyAnalyticCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PropertyAnalyticCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $propertyAnalytic = $this->repository->create($request->all());

            $response = [
                'message' => 'PropertyAnalytic created.',
                'data'    => $propertyAnalytic->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propertyAnalytic = $this->repository->find($id);


        return response()->json([
            'data' => $propertyAnalytic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PropertyAnalyticUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PropertyAnalyticUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $propertyAnalytic = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PropertyAnalytic updated.',
                'data'    => $propertyAnalytic->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'PropertyAnalytic deleted.',
            'deleted' => $deleted,
        ]);
    }

    public function analytics ($column, $value) {
        $summary = $this->repository
            ->with('property')
            ->with('analytic')
            ->whereHas('property', function ($query) use ($column, $value) {
                $query->where($column, $value);
            })
            ->all();
        $stats = [
            'min' => $summary->min('value'),
            'max' => $summary->max('value'),
            'average' => $summary->average('value'),
//            'percentagePropertyWithValue' =>
        ];

        return response()->json([
            $stats
        ]);
    }
}
