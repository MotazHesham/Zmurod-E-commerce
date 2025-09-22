<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CourseContent;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
    use MediaUploadingTrait;

    function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $user = Course::find($request->id);
        $user->$column_name = $request->approved;
        $user->save();
        return 1;
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Course::query()->select(sprintf('%s.*', (new Course)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_show';
                $editGate      = 'course_edit';
                $deleteGate    = 'course_delete';
                $crudRoutePart = 'courses';

                $actions = view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ))->render();

                // Add content management button
                $actions .= '<a class="btn btn-xs btn-success" href="' . route('admin.courses.content', $row->id) . '">
                    <i class="fas fa-video"></i> إدارة المحتوى
                </a>';

                return $actions;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('trainer', function ($row) {
                return $row->trainer ? $row->trainer : '';
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            
            $table->editColumn('approved', function ($row) {
                return  '<label class="c-switch c-switch-pill c-switch-success">
                            <input onchange="update_statuses(this,\'approved\')" value="' . $row->id . '" 
                                type="checkbox" class="c-switch-input" ' . ($row->approved ? "checked" : null) . '>
                            <span class="c-switch-slider"></span>
                        </label>';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Course::TYPE_SELECT[$row->type] : '';
            });


            $table->rawColumns(['actions', 'placeholder', 'photo', 'approved']);

            return $table->make(true);
        }

        return view('admin.courses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());

        if ($request->input('photo', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }
        alert()->success(trans('flash.store.title'), trans('flash.store.body'));
        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());

        if ($request->input('photo', false)) {
            if (!$course->photo || $request->input('photo') !== $course->photo->file_name) {
                if ($course->photo) {
                    $course->photo->delete();
                }
                $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($course->photo) {
            $course->photo->delete();
        }
        alert()->success(trans('flash.update.title'), trans('flash.update.body'));
        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();
        alert()->success(trans('flash.destroy.title'), trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        $courses = Course::find(request('ids'));

        foreach ($courses as $course) {
            $course->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function content(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $course->load('contents');
        return view('admin.courses.content', compact('course'));
    }

    public function storeContent(Request $request, Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Check PHP upload settings
        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');
        \Log::info('PHP Upload Settings:', [
            'upload_max_filesize' => $uploadMax,
            'post_max_size' => $postMax,
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit')
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,webm,mkv,flv,3gp,mpg,mpeg,ogv|max:512000', // 500MB max
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer|min:0',
            'is_free' => 'boolean',
        ]);

        $data = $request->all();
        $data['course_id'] = $course->id;
        $data['is_free'] = $request->has('is_free');

        if ($request->hasFile('video_file')) {
            try {
                $file = $request->file('video_file');
                
                // Check if file upload was successful
                if (!$file->isValid()) {
                    $errorMessages = [
                        1 => 'الملف أكبر من الحد المسموح به في php.ini',
                        2 => 'الملف أكبر من الحد المسموح به في HTML form',
                        3 => 'تم رفع الملف جزئياً فقط',
                        4 => 'لم يتم رفع أي ملف',
                        6 => 'مجلد مؤقت مفقود',
                        7 => 'فشل في كتابة الملف على القرص',
                        8 => 'تم إيقاف الرفع بواسطة إضافة PHP'
                    ];
                    
                    $errorMessage = $errorMessages[$file->getError()] ?? 'خطأ غير معروف في رفع الملف';
                    alert()->error('فشل رفع الملف: ' . $errorMessage);
                    return redirect()->back()->withInput();
                }
                
                $data['video_file'] = $file->store('course-videos', 'public');
                
                // Debug: Log file info
                \Log::info('Video file uploaded:', [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'stored_path' => $data['video_file']
                ]);
            } catch (\Exception $e) {
                \Log::error('Video upload failed:', [
                    'error' => $e->getMessage(),
                    'file' => $file->getClientOriginalName() ?? 'unknown'
                ]);
                alert()->error('فشل رفع الملف: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }

        CourseContent::create($data);

        alert()->success('تم إضافة المحتوى بنجاح');
        return redirect()->route('admin.courses.content', $course);
    }

    public function updateContent(Request $request, Course $course, CourseContent $content)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Check PHP upload settings
        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');
        \Log::info('PHP Upload Settings (Update):', [
            'upload_max_filesize' => $uploadMax,
            'post_max_size' => $postMax,
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit')
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,webm,mkv,flv,3gp,mpg,mpeg,ogv|max:512000', // 500MB max
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_free'] = $request->has('is_free');

        if ($request->hasFile('video_file')) {
            try {
                $file = $request->file('video_file');
                
                // Check if file upload was successful
                if (!$file->isValid()) {
                    $errorMessages = [
                        1 => 'الملف أكبر من الحد المسموح به في php.ini',
                        2 => 'الملف أكبر من الحد المسموح به في HTML form',
                        3 => 'تم رفع الملف جزئياً فقط',
                        4 => 'لم يتم رفع أي ملف',
                        6 => 'مجلد مؤقت مفقود',
                        7 => 'فشل في كتابة الملف على القرص',
                        8 => 'تم إيقاف الرفع بواسطة إضافة PHP'
                    ];
                    
                    $errorMessage = $errorMessages[$file->getError()] ?? 'خطأ غير معروف في رفع الملف';
                    alert()->error('فشل رفع الملف: ' . $errorMessage);
                    return redirect()->back()->withInput();
                }
                
                // Delete old file if exists
                if ($content->video_file) {
                    \Storage::disk('public')->delete($content->video_file);
                }
                
                $data['video_file'] = $file->store('course-videos', 'public');
                
                // Clear video_url if uploading file
                $data['video_url'] = null;
                
                // Debug: Log file info
                \Log::info('Video file updated:', [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'stored_path' => $data['video_file']
                ]);
            } catch (\Exception $e) {
                \Log::error('Video upload failed:', [
                    'error' => $e->getMessage(),
                    'file' => $file->getClientOriginalName() ?? 'unknown'
                ]);
                alert()->error('فشل رفع الملف: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }

        $content->update($data);

        alert()->success('تم تحديث المحتوى بنجاح');
        return redirect()->route('admin.courses.content', $course);
    }

    public function destroyContent(Course $course, CourseContent $content)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Delete video file if exists
        if ($content->video_file) {
            \Storage::disk('public')->delete($content->video_file);
        }

        $content->delete();

        alert()->success('تم حذف المحتوى بنجاح');
        return redirect()->route('admin.courses.content', $course);
    }
}
