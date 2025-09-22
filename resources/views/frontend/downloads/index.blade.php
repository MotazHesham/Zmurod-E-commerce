@extends('layouts.frontend')
@section('content')
    <!-- Downloads Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-header text-center">
                        <h1 class="page-title">تحميلاتي</h1>
                        <p class="page-description">جميع الفيديوهات التي قمت بتحميلها</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if($downloads->count() > 0)
                        <div class="downloads-list">
                            @foreach($downloads as $download)
                                <div class="download-item">
                                    <div class="row align-items-center">
                                        <div class="col-md-1">
                                            <div class="download-icon">
                                                <i class="{{ $download->download_type_icon }} fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="download-info">
                                                <h5 class="download-title">{{ $download->courseContent->title }}</h5>
                                                <p class="download-course">{{ $download->courseContent->course->title }}</p>
                                                <div class="download-meta">
                                                    <span class="badge bg-info me-2">
                                                        <i class="fas fa-calendar"></i> {{ $download->downloaded_at->format('Y-m-d H:i') }}
                                                    </span>
                                                    <span class="badge bg-secondary me-2">
                                                        <i class="fas fa-hdd"></i> {{ $download->formatted_file_size }}
                                                    </span>
                                                    <span class="badge bg-{{ $download->download_method == 'zip' ? 'warning' : 'success' }}">
                                                        <i class="fas fa-{{ $download->download_method == 'zip' ? 'archive' : 'download' }}"></i> 
                                                        {{ $download->download_method == 'zip' ? 'تحميل مجمع' : 'تحميل مباشر' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="download-actions">
                                                @if($download->courseContent->video_file)
                                                    <a href="{{ route('frontend.courses.download.video', [$download->courseContent->course_id, $download->courseContent->id]) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-redo"></i> إعادة التحميل
                                                    </a>
                                                @endif
                                                <a href="{{ route('frontend.courses.watch', [$download->courseContent->course_id, $download->courseContent->id]) }}" 
                                                   class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-play"></i> مشاهدة
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="download-status">
                                                @if($download->courseContent->video_file && file_exists(storage_path('app/public/' . $download->courseContent->video_file)))
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check"></i> متاح
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times"></i> غير متاح
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper mt-4">
                            {{ $downloads->links() }}
                        </div>
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-download fa-4x text-muted mb-3"></i>
                            <h4>لا توجد تحميلات</h4>
                            <p class="text-muted">لم تقم بتحميل أي فيديوهات بعد</p>
                            <a href="{{ route('frontend.courses.index') }}" class="btn btn-primary">
                                <i class="fas fa-search"></i> تصفح الدورات
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-header {
            margin-bottom: 40px;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .page-description {
            font-size: 1.1rem;
            color: #666;
        }
        
        .downloads-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .download-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .download-item:last-child {
            border-bottom: none;
        }
        
        .download-item:hover {
            background: #f8f9fa;
        }
        
        .download-icon {
            text-align: center;
        }
        
        .download-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        
        .download-course {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .download-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        .download-actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .download-status {
            text-align: center;
        }
        
        .empty-state {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 60px 20px;
        }
        
        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }
        
        @media (max-width: 768px) {
            .download-item .row > div {
                margin-bottom: 15px;
            }
            
            .download-actions {
                justify-content: center;
            }
            
            .download-status {
                text-align: center;
            }
        }
    </style>
@endsection
