<?php

namespace DTApi\Http\Controllers;

use DTApi\Models\Job;
use DTApi\Http\Requests;
use DTApi\Models\Distance;
use Illuminate\Http\Request;
use DTApi\Repository\BookingRepository;

/**
 * Class BookingController
 * @package DTApi\Http\Controllers
 */
class BookingController extends Controller
{

    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->repository = $bookingRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
//        early return
        if($user_id = $request->get('user_id'))
            return response($this->repository->getUsersJobs($user_id));

//        we can make Gate with same logic to partially check authorization with more clean and expressive way
        if (Gate::any(['super-admin', 'admin']))
            return response($this->repository->getAll($request));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
       return response($this->repository->with('translatorJobRel.user')->find($id));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return response($this->repository->store($request->__authenticatedUser, $request->all()));
    }

    /**s
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        return response($this->repository->updateJob($id, $request->except(['_token', 'submit']),
            $request->__authenticatedUser));
    }

}
