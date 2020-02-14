<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLevel;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('course_levels', 'course_levels.course_sublevels')->get();
        return view('admin.levels.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest();
        $this->validateCourseID();

        $level = new CourseLevel;
        $level->title = $request['title'];
        $level->course_id = $request['course_id'];
        $level->save();

        return redirect()->route('admin.levels.index')->with([
            'status' => 'success',
            'message' => "Add $level->title Successfull"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($id);

        $level = CourseLevel::find($id);
        $level->title = $request['title'];
        $level->save();

        return redirect()->route('admin.levels.index')->with([
            'status' => 'success',
            'message' => "Update $level->title Successfull"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = CourseLevel::find($id);
        $level->delete();

        return redirect()->route('admin.levels.index')->with([
            'status' => 'success',
            'message' => "Delete $level->title Successfull"
        ]);
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:3|max:50',
        ]);
    }

    public function validateCourseID()
    {
        return request()->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
    }

}
