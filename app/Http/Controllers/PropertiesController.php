<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PropertyCreateRequest;
use App\Http\Requests\PropertyUpdateRequest;
use App\Repositories\PropertyRepository;
use App\Validators\PropertyValidator;

/**
 * Class PropertiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class PropertiesController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $repository;

    /**
     * @var PropertyValidator
     */
    protected $validator;

    /**
     * PropertiesController constructor.
     *
     * @param PropertyRepository $repository
     * @param PropertyValidator $validator
     */
    public function __construct(PropertyRepository $repository, PropertyValidator $validator)
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
        $properties = $this->repository->all();

        return response()->json([
            'data' => $properties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PropertyCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $property = $this->repository->create($request->all());

            $response = [
                'message' => 'Property created.',
                'data'    => $property->toArray(),
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
        $property = $this->repository->find($id);


        return response()->json([
            'data' => $property,
        ]);
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
        $property = $this->repository->find($id);

        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PropertyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PropertyUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $property = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Property updated.',
                'data'    => $property->toArray(),
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
            'message' => 'Property deleted.',
            'deleted' => $deleted,
        ]);
    }
}
