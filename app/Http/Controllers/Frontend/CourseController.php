<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubscription;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $course = Course::with(['contents', 'subscriptions' => function($query) {
            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            }
        }])->findOrFail($id);
        
        $isSubscribed = false;
        if (Auth::check()) {
            $isSubscribed = $course->isSubscribedBy(Auth::id());
        }
        
        return view('frontend.courses.show', compact('course', 'isSubscribed'));
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

    public function subscribe(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['redirect' => route('frontend.userlogin')], 401);
        }

        $course = Course::findOrFail($id);
        $userId = Auth::id();

        // Check if already subscribed
        $existingSubscription = CourseSubscription::where('user_id', $userId)
            ->where('course_id', $id)
            ->first();

        if ($existingSubscription) {
            if ($existingSubscription->status === 'active') {
                return response()->json(['error' => 'أنت مشترك بالفعل في هذه الدورة'], 400);
            }
            // Reactivate subscription
            $existingSubscription->update([
                'status' => 'active',
                'subscribed_at' => now(),
            ]);
        } else {
            // Create new subscription
            CourseSubscription::create([
                'user_id' => $userId,
                'course_id' => $id,
                'status' => 'active',
                'amount_paid' => $course->isFree() ? 0 : $course->price,
                'subscribed_at' => now(),
            ]);
        }

        return response()->json(['success' => 'تم الاشتراك في الدورة بنجاح']);
    }

    public function content($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $course = Course::with('contents')->findOrFail($courseId);
        
        // Check if user is subscribed
        if (!$course->isSubscribedBy(Auth::id())) {
            return redirect()->route('frontend.courses.show', $courseId);
        }

        return view('frontend.courses.content', compact('course'));
    }

    public function watch($courseId, $contentId)
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $course = Course::findOrFail($courseId);
        $content = CourseContent::where('course_id', $courseId)
            ->where('id', $contentId)
            ->firstOrFail();

        // Check if user is subscribed
        if (!$course->isSubscribedBy(Auth::id())) {
            return redirect()->route('frontend.courses.show', $courseId);
        }

        // Check if content is free or user is subscribed
        if (!$content->is_free && !$course->isSubscribedBy(Auth::id())) {
            return redirect()->route('frontend.courses.content', $courseId);
        }

        // Get previous and next content for navigation
        $previousContent = CourseContent::where('course_id', $courseId)
            ->where('order', '<', $content->order)
            ->orderBy('order', 'desc')
            ->first();
            
        $nextContent = CourseContent::where('course_id', $courseId)
            ->where('order', '>', $content->order)
            ->orderBy('order', 'asc')
            ->first();

        return view('frontend.courses.watch', compact('course', 'content', 'previousContent', 'nextContent'));
    }
}
