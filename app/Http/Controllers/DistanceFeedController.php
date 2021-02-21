<?php


namespace DTApi\Http\Controllers;


class DistanceFeedController extends Controller
{
//    invokable controller for single action only method name was distanceFeed()
    public function __invoke(Request $request)
    {
//        request has filled method which check if value exist and not empty
        $distance = $request->filled('distance') ? $request->distance : '';

        $time = $request->filled('time') ? $request->time : '';

        $jobid = $request->filled('jobid') ? $request->jobid : '';

        $session = $request->filled('session_time') ? $request->session_time : '';

        $manually_handled = $request->manually_handled == 'true' ? 'yes' : 'no';

        $by_admin = $request->by_admin == 'true' ? 'yes' : 'no';

        $admincomment = $request->filled('admincomment') ? $request->admincomment : '';

        $flagged = 'no';
        if ($request->flagged == 'true') {
            if(!$request->filled('admincomment')) return "Please, add comment";
            $flagged = 'yes';
        }

        if ($time || $distance)
            Distance::where('job_id', '=', $jobid)->update(array('distance' => $distance, 'time' => $time));

        if ($admincomment || $session || $flagged || $manually_handled || $by_admin)
            Job::where('id', '=', $jobid)->update(array('admin_comments' => $admincomment, 'flagged' => $flagged, 'session_time' => $session, 'manually_handled' => $manually_handled, 'by_admin' => $by_admin));

        return response('Record updated!');
    }
}