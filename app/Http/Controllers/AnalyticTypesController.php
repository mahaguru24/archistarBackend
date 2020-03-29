<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AnalyticTypesCreateRequest;
use App\Http\Requests\AnalyticTypesUpdateRequest;
use App\Repositories\AnalyticTypesRepository;
use App\Validators\AnalyticTypesValidator;

/**
 * Class AnalyticTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AnalyticTypesController extends Controller
{
    /**
     * @var AnalyticTypesRepository
     */
    protected $repository;

    /**
     * @var AnalyticTypesValidator
     */
    protected $validator;

    /**
     * AnalyticTypesController constructor.
     *
     * @param AnalyticTypesRepository $repository
     * @param AnalyticTypesValidator $validator
     */
    public function __construct(AnalyticTypesRepository $repository, AnalyticTypesValidator $validator)
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
        $analyticTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $analyticTypes,
            ]);
        }

        return view('analyticTypes.index', compact('analyticTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnalyticTypesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AnalyticTypesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $analyticType = $this->repository->create($request->all());

            $response = [
                'message' => 'AnalyticTypes created.',
                'data'    => $analyticType->toArray(),
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
        $analyticType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $analyticType,
            ]);
        }

        return view('analyticTypes.show', compact('analyticType'));
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
        $analyticType = $this->repository->find($id);

        return view('analyticTypes.edit', compact('analyticType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnalyticTypesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AnalyticTypesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $analyticType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AnalyticTypes updated.',
                'data'    => $analyticType->toArray(),
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
                'message' => 'AnalyticTypes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AnalyticTypes deleted.');
    }
}
