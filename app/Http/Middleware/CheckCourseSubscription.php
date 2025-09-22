<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use RealRashid\SweetAlert\Facades\Alert;

class CheckCourseSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $courseId = $request->route('courseId') ?? $request->route('id');
        
        if ($courseId) {
            $course = Course::find($courseId);
            
            if (!$course) {
                Alert::error('خطأ', 'الدورة غير موجودة');
                return redirect()->route('frontend.courses.index');
            }

            if (!$course->isSubscribedBy(Auth::id())) {
                Alert::error('خطأ', 'يجب الاشتراك في الدورة أولاً');
                return redirect()->route('frontend.courses.show', $courseId);
            }
        }

        return $next($request);
    }
}
