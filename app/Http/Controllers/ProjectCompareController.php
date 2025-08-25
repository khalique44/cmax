<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectCompareController extends Controller
{
    public function add($id)
    {
        $compare = session()->get('compare', []);

        if (!in_array($id, $compare)) {
            if (count($compare) >= 3) {
                return back()->with('error', 'You can only compare up to 3 projects.');
            }
            $compare[] = $id;
            session()->put('compare', $compare);
        }

        return back()->with('success', 'Project added to comparison.');
    }

    public function remove($id)
    {
        $compare = session()->get('compare', []);
        $compare = array_diff($compare, [$id]);
        session()->put('compare', $compare);

        return back()->with('success', 'Project removed from comparison.');
    }

    public function index()
    {
        $compare = session()->get('compare', []);
        dd($compare);
        $projects = Project::whereIn('id', $compare)->get();

        return view('projects.compare', compact('projects'));
    }


    public function ajaxAdd(Request $request)
	{
	    $id = $request->id;
	    $compare = session()->get('compare', []);

	    if (!in_array($id, $compare)) {
	        if (count($compare) >= 3) {
	            return response()->json(['status' => 'error', 'message' => 'You can only compare up to 3 projects.']);
	        }
	        $compare[] = $id;
	        session()->put('compare', $compare);
	        dd($compare);
	    }

	    $projects = Project::whereIn('id', $compare)->get(['id', 'project_title']);
	    return response()->json(['status' => 'success', 'projects' => $projects]);
	}

	public function ajaxRemove(Request $request)
	{
	    $id = $request->id;
	    $compare = session()->get('compare', []);
	    $compare = array_diff($compare, [$id]);
	    session()->put('compare', $compare);

	    $projects = Project::whereIn('id', $compare)->get(['id', 'title']);
	    return response()->json(['status' => 'success', 'projects' => $projects]);
	}

	public function ajaxClear()
	{
	    session()->forget('compare');
	    return response()->json(['status' => 'success', 'projects' => []]);
	}

}

