<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseContent;
use App\Models\UserDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadVideo($courseId, $contentId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $courseContent = CourseContent::where('course_id', $courseId)
            ->where('id', $contentId)
            ->firstOrFail();

        // Check if user is subscribed to the course
        if (!$courseContent->course->isSubscribedBy(Auth::id())) {
            return redirect()->route('frontend.courses.show', $courseId)
                ->with('error', 'يجب الاشتراك في الدورة أولاً');
        }

        // Check if content has a video file
        if (!$courseContent->video_file) {
            return redirect()->back()
                ->with('error', 'لا يوجد ملف فيديو للتحميل');
        }

        // Check if file exists
        $filePath = storage_path('app/public/' . $courseContent->video_file);
        if (!file_exists($filePath)) {
            return redirect()->back()
                ->with('error', 'الملف غير موجود');
        }

        // Record the download
        UserDownload::create([
            'user_id' => Auth::id(),
            'course_content_id' => $contentId,
            'download_type' => 'video',
            'file_path' => $courseContent->video_file,
            'file_size' => filesize($filePath),
            'download_method' => 'direct',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Return file download response
        return Response::download($filePath, $courseContent->title . '.mp4');
    }

    public function downloadAllCourseVideos($courseId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $course = \App\Models\Course::findOrFail($courseId);

        // Check if user is subscribed to the course
        if (!$course->isSubscribedBy(Auth::id())) {
            return redirect()->route('frontend.courses.show', $courseId)
                ->with('error', 'يجب الاشتراك في الدورة أولاً');
        }

        // Get all video contents
        $videoContents = $course->contents()
            ->whereNotNull('video_file')
            ->get();

        if ($videoContents->isEmpty()) {
            return redirect()->back()
                ->with('error', 'لا توجد ملفات فيديو للتحميل');
        }

        // Create a zip file
        $zipFileName = 'course_' . $courseId . '_videos_' . time() . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE) !== TRUE) {
            return redirect()->back()
                ->with('error', 'لا يمكن إنشاء ملف التحميل');
        }

        foreach ($videoContents as $content) {
            $filePath = storage_path('app/public/' . $content->video_file);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $content->title . '.mp4');
                
                // Record the download
                UserDownload::create([
                    'user_id' => Auth::id(),
                    'course_content_id' => $content->id,
                    'download_type' => 'video',
                    'file_path' => $content->video_file,
                    'file_size' => filesize($filePath),
                    'download_method' => 'zip',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
            }
        }

        $zip->close();

        // Return zip file download
        return Response::download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    public function myDownloads()
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.userlogin');
        }

        $downloads = UserDownload::with(['courseContent.course'])
            ->where('user_id', Auth::id())
            ->orderBy('downloaded_at', 'desc')
            ->paginate(20);

        return view('frontend.downloads.index', compact('downloads'));
    }
}
