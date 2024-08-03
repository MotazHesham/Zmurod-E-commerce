<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{

    public function index()
    {
        //courses
        $courses = Course::paginate(4);
        return view('frontend.courses.index', compact('courses'));
    }


    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('frontend.courses.show')->with('course', $course);
    }
    public function search(Request $request)
    {
        $keyword = $request->filter;

        $courses = Course::query()->where('name', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->paginate(4);

        // Check if there are no courses found
        if ($courses->isEmpty()) {
            Alert::toast('No courses available have this Keyword', 'warning')->position('center');
            return redirect()->route('frontend.courses.index'); // Redirect to the courses index page or any other page as needed
        }

        return view('frontend.courses.index', ['courses' => $courses]);
    }
}
