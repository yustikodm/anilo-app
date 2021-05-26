<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Score::select('*'))
                ->addColumn('action', 'score-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('scores', [
            'students' => Student::all(),
            'subjects' => Subject::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $id = $request->id;

        $score = Score::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'subject_id' => $request->subject_id,
                'student_id' => $request->student_id,
                'score' => $request->score,
            ]);

        return Response()->json($score);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $score = Score::where($where)->first();

        return Response()->json($score);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $score = Score::where('id', $request->id)->delete();

        return Response()->json($score);
    }
}
