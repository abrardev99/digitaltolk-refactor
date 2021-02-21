<?php


namespace DTApi\Http\Controllers;


use DTApi\Repository\BookingRepository;

class JobController extends Controller
{
    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * JobController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->repository = $bookingRepository;
    }

    public function customerNotCall(Request $request)
    {
        return response($this->repository->customerNotCall($request->all()));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getHistory(Request $request)
    {
        if($user_id = $request->get('user_id'))
            return response($this->repository->getUsersJobsHistory($user_id, $request));
        return null;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function acceptJob(Request $request)
    {
        return response($this->repository->acceptJob($request->all(), $request->__authenticatedUser));
    }

    public function acceptJobWithId(Request $request)
    {
        return response($this->repository->acceptJobWithId($request->get('job_id'), $request->__authenticatedUser));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function cancelJob(Request $request)
    {
        return response($this->repository->cancelJobAjax($request->all(), $request->__authenticatedUser));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function endJob(Request $request)
    {
        return response($this->repository->endJob($request->all()));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getPotentialJobs(Request $request)
    {
        return response($this->repository->getPotentialJobs($request->__authenticatedUser));
    }

    public function reopen(Request $request)
    {
        return response($this->repository->reopen($request->all()));
    }

}