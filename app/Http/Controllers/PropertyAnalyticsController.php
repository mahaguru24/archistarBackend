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
    public function __construct(PropertyAnalyticRepository $repository, PropertyAnalyticValidator $validator)
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $propertyAnalytics,
            ]);
        }

        return view('propertyAnalytics.index', compact('propertyAnalytics'));
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

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $propertyAnalytic,
            ]);
        }

        return view('propertyAnalytics.show', compact('propertyAnalytic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propertyAnalytic = $this->repository->find($id);

        return view('propertyAnalytics.edit', compact('propertyAnalytic'));
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

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'PropertyAnalytic deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PropertyAnalytic deleted.');
    }
}
