@extends('layouts.frontend')
@section('content')
    <!-- Course Content Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 col-md-12">
                    <div class="course-content-header mb-4">
                        <h2>{{ $course->name }}</h2>
                        <p class="text-muted">{{ $course->description }}</p>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-2">{{ $course->trainer }}</span>
                            <span class="badge bg-info">{{ $course->courses_hours }} ساعة تدريبية</span>
                        </div>
                    </div>

                    <div class="course-contents">
                        <h4>محتوى الدورة</h4>
                        <div class="list-group">
                            @forelse($course->contents as $index => $content)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-secondary me-3">{{ $index + 1 }}</span>
                                        <div>
                                            <h6 class="mb-1">{{ $content->title }}</h6>
                                            @if($content->description)
                                                <small class="text-muted">{{ $content->description }}</small>
                                            @endif
                                        @if($content->duration)
                                            <small class="text-muted d-block">
                                                <i class="fas fa-clock"></i> {{ $content->formatted_duration }}
                                            </small>
                                        @endif
                                        @if($content->video_url)
                                            <small class="text-muted d-block">
                                                <i class="{{ $content->video_icon }}"></i> {{ $content->video_platform_name }}
                                            </small>
                                        @elseif($content->video_file)
                                            <small class="text-muted d-block">
                                                <i class="fas fa-file-video text-success"></i> ملف فيديو محلي
                                            </small>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if($content->is_free)
                                            <span class="badge bg-success me-2">مجاني</span>
                                        @endif
                                        <a href="{{ route('frontend.courses.watch', [$course->id, $content->id]) }}" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-play"></i> شاهد
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    لا يوجد محتوى متاح لهذه الدورة حالياً.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3 col-md-12 mt-md-50px mt-lm-50px">
                    <div class="blog-sidebar mr-20px">
                        <!-- Course Info Widget -->
                        <div class="sidebar-widget text-center mb-4">
                            <h3 class="sidebar-title">معلومات الدورة</h3>
                            <div class="instructor_pricing_widget csv2">
                                <h2>بواسطة - {{ $course->trainer }}</h2>
                                <h3 class="new-price">{{ $course->price }}ر.س</h3>
                                <h5 class="subtitle text-right">يشمل</h5>
                                <ul class="price_quere_list text-right">
                                    <li><a href="#">{{ $course->courses_hours }} ساعة تدريبية</a></li>
                                    <li><a href="#">الفيدوهات المسجلة</a></li>
                                    <li><a href="#">إتاحة طوال الوقت</a></li>
                                    <li><a href="#">تابع الدورة من أي لابتوب أو موبايل</a></li>
                                </ul>
                                <h5>الشهادة: {{ App\Models\Course::TYPE_SELECT[$course->type] }}</h5>
                            </div>
                        </div>

                        <!-- Progress Widget -->
                        <div class="sidebar-widget text-center">
                            <h3 class="sidebar-title">تقدمك في الدورة</h3>
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <p class="text-muted">لم تبدأ بعد</p>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Course Content Area End -->
@endsection
