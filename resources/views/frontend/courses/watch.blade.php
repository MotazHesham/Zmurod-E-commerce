@extends('layouts.frontend')
@section('content')
    <!-- Course Watch Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <!-- AdBlock Warning -->
            <div id="adblock-warning" class="alert alert-warning alert-dismissible fade show" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>تنبيه:</strong> يبدو أن لديك امتداد حجب الإعلانات مفعل. قد يمنع هذا عرض الفيديوهات. 
                يرجى إيقاف امتداد حجب الإعلانات مؤقتاً أو إضافة هذا الموقع إلى القائمة البيضاء.
            </div>
            
            <div class="row">
                <div class="col-lg-8 col-xl-9 col-md-12">
                    <!-- Navigation Buttons -->
                    <div class="video-navigation mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($previousContent)
                                    <a href="{{ route('frontend.courses.watch', [$course->id, $previousContent->id]) }}" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-chevron-right"></i> السابق
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary" disabled>
                                        <i class="fas fa-chevron-right"></i> السابق
                                    </button>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <h4 class="mb-0">{{ $content->title }}</h4>
                                <small class="text-muted">{{ $course->title }}</small>
                            </div>
                            
                            <div>
                                @if($nextContent)
                                    <a href="{{ route('frontend.courses.watch', [$course->id, $nextContent->id]) }}" 
                                       class="btn btn-primary">
                                        التالي <i class="fas fa-chevron-left"></i>
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        التالي <i class="fas fa-chevron-left"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Video Player -->
                    <div class="video-player-container mb-4">
                        <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            @if($content->video_url)
                                @php
                                    // Detect video platform
                                    $isYouTube = strpos($content->video_url, 'youtube.com') !== false || strpos($content->video_url, 'youtu.be') !== false;
                                    $isZoom = strpos($content->video_url, 'zoom.us') !== false;
                                    $isVimeo = strpos($content->video_url, 'vimeo.com') !== false;
                                    
                                    // Extract video ID for YouTube
                                    $videoId = '';
                                    if ($isYouTube) {
                                        if (strpos($content->video_url, 'youtube.com/embed/') !== false) {
                                            $videoId = substr($content->video_url, strpos($content->video_url, 'youtube.com/embed/') + 19);
                                            $videoId = explode('?', $videoId)[0];
                                        } elseif (strpos($content->video_url, 'youtu.be/') !== false) {
                                            $videoId = substr($content->video_url, strpos($content->video_url, 'youtu.be/') + 9);
                                            $videoId = explode('?', $videoId)[0];
                                        } elseif (strpos($content->video_url, 'youtube.com/watch') !== false) {
                                            parse_str(parse_url($content->video_url, PHP_URL_QUERY), $params);
                                            $videoId = $params['v'] ?? '';
                                        }
                                    }
                                @endphp
                                
                                @if($isYouTube && $videoId)
                                    <!-- YouTube Video with enhanced iframe support -->
                                    <div id="youtube-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                        <!-- Option 1: Enhanced iframe with better parameters -->
                                        <iframe id="youtube-iframe" 
                                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&showinfo=0&controls=1&autoplay=0&mute=0&loop=0&fs=1&iv_load_policy=3&cc_load_policy=0&disablekb=0&start=0&end=0&wmode=opaque&theme=dark&playsinline=1&cc_lang_pref=ar&hl=ar" 
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                                frameborder="0" 
                                                allowfullscreen
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"
                                                referrerpolicy="no-referrer-when-downgrade"
                                                loading="eager">
                                        </iframe>
                                        
                                        <!-- Alternative: Direct YouTube link as backup -->
                                        <div id="youtube-direct-link" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: none; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px;">
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-white p-4">
                                                <i class="fab fa-youtube fa-4x mb-3"></i>
                                                <h4 class="mb-3">لا يمكن عرض الفيديو مباشرة</h4>
                                                <p class="text-center mb-4">يرجى النقر على الزر أدناه لمشاهدة الفيديو على YouTube</p>
                                                <a href="https://www.youtube.com/watch?v={{ $videoId }}" 
                                                   target="_blank" 
                                                   class="btn btn-danger btn-lg">
                                                    <i class="fab fa-youtube"></i> شاهد على YouTube
                                                </a>
                                                <button onclick="retryIframe()" class="btn btn-outline-light btn-lg mt-3">
                                                    <i class="fas fa-redo"></i> جرب مرة أخرى
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Option 2: Fallback for blocked iframe -->
                                        <div id="youtube-fallback" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: none; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                                <i class="fab fa-youtube fa-3x text-danger mb-3"></i>
                                                <h5 class="text-muted mb-3">لا يمكن عرض الفيديو مباشرة</h5>
                                                <div class="alert alert-warning mb-4" style="max-width: 500px;">
                                                    <small>
                                                        <strong>نصيحة:</strong> إذا كنت تستخدم امتداد حجب الإعلانات (AdBlock, uBlock Origin, إلخ)، 
                                                        يرجى إيقافه مؤقتاً لهذا الموقع أو إضافة الموقع إلى القائمة البيضاء.
                                                    </small>
                                                </div>
                                                <p class="text-muted text-center mb-4">يرجى النقر على أحد الخيارات أدناه لمشاهدة الفيديو</p>
                                                <div class="d-flex gap-3 flex-wrap justify-content-center">
                                                    <a href="https://www.youtube.com/watch?v={{ $videoId }}" 
                                                       target="_blank" 
                                                       class="btn btn-danger btn-lg">
                                                        <i class="fab fa-youtube"></i> شاهد على YouTube
                                                    </a>
                                                    <button onclick="tryAlternativePlayer()" class="btn btn-outline-primary btn-lg">
                                                        <i class="fas fa-play"></i> جرب مشغل بديل
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Option 3: Alternative player -->
                                        <div id="alternative-player" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: none;">
                                            <div class="d-flex align-items-center justify-content-center h-100" style="background: #000;">
                                                <div class="text-center text-white">
                                                    <h4>جاري تحميل الفيديو...</h4>
                                                    <div class="spinner-border text-light" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($isZoom)
                                    <!-- Zoom Video -->
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                                        <div class="text-center p-4">
                                            <i class="fas fa-video fa-3x text-primary mb-3"></i>
                                            <h5 class="text-muted mb-3">فيديو Zoom</h5>
                                            <p class="text-muted mb-4">اضغط على الرابط أدناه لمشاهدة الفيديو على Zoom</p>
                                            <a href="{{ $content->video_url }}" 
                                               target="_blank" 
                                               class="btn btn-primary btn-lg">
                                                <i class="fas fa-video"></i> شاهد على Zoom
                                            </a>
                                        </div>
                                    </div>
                                @elseif($isVimeo)
                                    <!-- Vimeo Video -->
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                                        <div class="text-center p-4">
                                            <i class="fab fa-vimeo fa-3x text-info mb-3"></i>
                                            <h5 class="text-muted mb-3">فيديو Vimeo</h5>
                                            <p class="text-muted mb-4">اضغط على الرابط أدناه لمشاهدة الفيديو على Vimeo</p>
                                            <a href="{{ $content->video_url }}" 
                                               target="_blank" 
                                               class="btn btn-info btn-lg">
                                                <i class="fab fa-vimeo"></i> شاهد على Vimeo
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <!-- Other Video Platforms -->
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                                        <div class="text-center p-4">
                                            <i class="fas fa-link fa-3x text-secondary mb-3"></i>
                                            <h5 class="text-muted mb-3">فيديو خارجي</h5>
                                            <p class="text-muted mb-4">اضغط على الرابط أدناه لمشاهدة الفيديو</p>
                                            <a href="{{ $content->video_url }}" 
                                               target="_blank" 
                                               class="btn btn-secondary btn-lg">
                                                <i class="fas fa-external-link-alt"></i> شاهد الفيديو
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @elseif($content->video_file)
                                <video controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" preload="metadata">
                                    <source src="{{ Storage::url($content->video_file) }}" type="video/mp4">
                                    <source src="{{ Storage::url($content->video_file) }}" type="video/webm">
                                    <source src="{{ Storage::url($content->video_file) }}" type="video/avi">
                                    <p class="text-center mt-3">متصفحك لا يدعم تشغيل الفيديو. <a href="{{ Storage::url($content->video_file) }}" download>اضغط هنا لتحميل الفيديو</a></p>
                                </video>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" 
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                    <div class="text-center">
                                        <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">لا يوجد فيديو متاح</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Video Info -->
                    <div class="video-info mb-4">
                        <h3>{{ $content->title }}</h3>
                        @if($content->description)
                            <p class="text-muted">{{ $content->description }}</p>
                        @endif
                        <div class="d-flex align-items-center">
                            @if($content->duration)
                                <span class="badge bg-info me-2">
                                    <i class="fas fa-clock"></i> {{ $content->formatted_duration }}
                                </span>
                            @endif
                            @if($content->is_free)
                                <span class="badge bg-success">
                                    <i class="fas fa-gift"></i> مجاني
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="video-navigation">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <a href="{{ route('frontend.courses.content', $course->id) }}" 
                                   class="btn btn-outline-info">
                                    <i class="fas fa-list"></i> قائمة المحتويات
                                </a>
                                <a href="{{ route('frontend.courses.show', $course->id) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-right"></i> تفاصيل الدورة
                                </a>
                                @if($content->video_file)
                                    <a href="{{ route('frontend.courses.download.video', [$course->id, $content->id]) }}" 
                                       class="btn btn-success">
                                        <i class="fas fa-download"></i> تحميل الفيديو
                                    </a>
                                @endif
                                <a href="{{ route('frontend.courses.download.all', $course->id) }}" 
                                   class="btn btn-warning">
                                    <i class="fas fa-download"></i> تحميل كل الفيديوهات
                                </a>
                                <a href="{{ route('frontend.downloads.index') }}" 
                                   class="btn btn-outline-dark">
                                    <i class="fas fa-list"></i> تحميلاتي
                                </a>
                            </div>
                            
                            <div class="d-flex gap-2">
                                @if($previousContent)
                                    <a href="{{ route('frontend.courses.watch', [$course->id, $previousContent->id]) }}" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-chevron-right"></i> 
                                        <span class="d-none d-md-inline">{{ $previousContent->title }}</span>
                                        <span class="d-md-none">السابق</span>
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary" disabled>
                                        <i class="fas fa-chevron-right"></i> 
                                        <span class="d-none d-md-inline">لا يوجد محتوى سابق</span>
                                        <span class="d-md-none">السابق</span>
                                    </button>
                                @endif
                                
                                @if($nextContent)
                                    <a href="{{ route('frontend.courses.watch', [$course->id, $nextContent->id]) }}" 
                                       class="btn btn-primary">
                                        <span class="d-none d-md-inline">{{ $nextContent->title }}</span>
                                        <span class="d-md-none">التالي</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        <span class="d-none d-md-inline">لا يوجد محتوى تالي</span>
                                        <span class="d-md-none">التالي</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mt-3">
                            @php
                                $contents = $course->contents->sortBy('order');
                                $currentIndex = $contents->search(function($item) use ($content) {
                                    return $item->id === $content->id;
                                });
                                $progress = $contents->count() > 0 ? (($currentIndex + 1) / $contents->count()) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" 
                                     style="width: {{ $progress }}%" 
                                     aria-valuenow="{{ $progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block text-center">
                                {{ $currentIndex + 1 }} من {{ $contents->count() }} محتوى
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3 col-md-12 mt-md-50px mt-lm-50px">
                    <div class="blog-sidebar mr-20px">
                        <!-- Course Contents List -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">محتوى الدورة</h3>
                            <div class="course-contents-list">
                                @foreach($course->contents->sortBy('order') as $index => $item)
                                    <div class="content-item {{ $item->id === $content->id ? 'active' : '' }}">
                                        <a href="{{ route('frontend.courses.watch', [$course->id, $item->id]) }}" 
                                           class="d-flex align-items-center text-decoration-none">
                                            <span class="content-number me-2 {{ $item->id === $content->id ? 'active' : '' }}">{{ $index + 1 }}</span>
                                            <div class="content-details">
                                                <h6 class="mb-1">{{ $item->title }}</h6>
                                                @if($item->duration)
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock"></i> {{ $item->formatted_duration }}
                                                    </small>
                                                @endif
                                                @if($item->video_url)
                                                    <small class="text-muted d-block">
                                                        <i class="{{ $item->video_icon }}"></i> {{ $item->video_platform_name }}
                                                    </small>
                                                @elseif($item->video_file)
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-file-video text-success"></i> ملف محلي
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="ms-auto d-flex align-items-center">
                                                @if($item->is_free)
                                                    <span class="badge bg-success me-2">مجاني</span>
                                                @endif
                                                @if($item->id === $content->id)
                                                    <i class="fas fa-play-circle text-primary"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Quick Navigation -->
                            <div class="mt-3">
                                <div class="d-grid gap-2">
                                    @if($previousContent)
                                        <a href="{{ route('frontend.courses.watch', [$course->id, $previousContent->id]) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-chevron-right"></i> السابق: {{ Str::limit($previousContent->title, 30) }}
                                        </a>
                                    @endif
                                    
                                    @if($nextContent)
                                        <a href="{{ route('frontend.courses.watch', [$course->id, $nextContent->id]) }}" 
                                           class="btn btn-primary btn-sm">
                                            التالي: {{ Str::limit($nextContent->title, 30) }} <i class="fas fa-chevron-left"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="sidebar-widget text-center mt-4">
                            <h3 class="sidebar-title">معلومات الدورة</h3>
                            <div class="course-info">
                                <h5>{{ $course->name }}</h5>
                                <p class="text-muted">{{ $course->trainer }}</p>
                                <div class="d-flex justify-content-between">
                                    <span>السعر:</span>
                                    <strong>{{ $course->price }} ر.س</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>المدة:</span>
                                    <strong>{{ $course->courses_hours }} ساعة</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>الشهادة:</span>
                                    <strong>{{ App\Models\Course::TYPE_SELECT[$course->type] }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Course Watch Area End -->

    <style>
        .content-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }
        
        .content-item:hover {
            background-color: #f8f9fa;
        }
        
        .content-item.active {
            background-color: #e3f2fd;
            border-left: 3px solid #2196f3;
        }
        
        .content-item.active a {
            color: #2196f3;
        }
        
        .content-number {
            background-color: #6c757d;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        
        .content-item.active .content-number {
            background-color: #2196f3;
        }
        
        .video-wrapper {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- YouTube API - Loaded dynamically to avoid CSP issues -->
    <script>
        // Load YouTube API dynamically
        function loadYouTubeAPI() {
            if (typeof window.YT === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://www.youtube.com/iframe_api';
                script.async = true;
                document.head.appendChild(script);
            }
        }
        
        // Load API when page loads
        document.addEventListener('DOMContentLoaded', loadYouTubeAPI);
    </script>
    
    <script>
        // YouTube API ready
        function onYouTubeIframeAPIReady() {
            console.log('YouTube API ready');
        }

        // Check if iframe is blocked and show fallback
        function checkVideoLoad() {
            setTimeout(function() {
                const iframe = document.getElementById('youtube-iframe');
                const fallback = document.getElementById('youtube-fallback');
                const directLink = document.getElementById('youtube-direct-link');
                
                if (iframe && fallback) {
                    // Check if iframe is visible and has content
                    const iframeRect = iframe.getBoundingClientRect();
                    const isVisible = iframeRect.width > 0 && iframeRect.height > 0;
                    
                    if (!isVisible) {
                        console.log('Iframe not visible, showing direct link');
                        showDirectLink();
                        return;
                    }
                    
                    // Check if iframe loaded successfully
                    if (iframe.contentWindow) {
                        try {
                            // Try to access iframe content
                            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                            if (iframeDoc && iframeDoc.location.href && !iframeDoc.location.href.includes('chrome-error')) {
                                console.log('YouTube iframe loaded successfully');
                                return; // Video loaded successfully
                            }
                        } catch (e) {
                            console.log('Cannot access iframe content, checking alternative methods');
                        }
                    }
                    
                    // Additional check - if iframe is still not working after 2 seconds
                    setTimeout(function() {
                        if (iframe.style.display !== 'none' && fallback.style.display === 'none' && directLink.style.display === 'none') {
                            console.log('Iframe still not working after timeout, showing direct link');
                            showDirectLink();
                        }
                    }, 2000);
                }
            }, 1000); // Wait 1 second for iframe to load
        }
        
        function showDirectLink() {
            const iframe = document.getElementById('youtube-iframe');
            const directLink = document.getElementById('youtube-direct-link');
            
            if (iframe && directLink) {
                iframe.style.display = 'none';
                directLink.style.display = 'block';
            }
        }
        
        function retryIframe() {
            const iframe = document.getElementById('youtube-iframe');
            const directLink = document.getElementById('youtube-direct-link');
            
            if (iframe && directLink) {
                // Hide direct link
                directLink.style.display = 'none';
                
                // Show iframe
                iframe.style.display = 'block';
                
                // Reload iframe with fresh URL
                const currentSrc = iframe.src;
                iframe.src = '';
                setTimeout(function() {
                    iframe.src = currentSrc + '&t=' + Date.now();
                    checkVideoLoad();
                }, 100);
            }
        }

        function showVideoFallback() {
            const iframe = document.getElementById('youtube-iframe');
            const fallback = document.getElementById('youtube-fallback');
            
            if (iframe && fallback) {
                iframe.style.display = 'none';
                fallback.style.display = 'block';
            }
        }

        function tryAlternativePlayer() {
            const fallback = document.getElementById('youtube-fallback');
            const alternative = document.getElementById('alternative-player');
            
            if (fallback && alternative) {
                fallback.style.display = 'none';
                alternative.style.display = 'block';
                
                // Try to load video with different parameters
                setTimeout(function() {
                    const iframe = document.getElementById('youtube-iframe');
                    if (iframe) {
                        // Try different YouTube embed parameters
                        const videoId = iframe.src.match(/embed\/([^?]+)/)?.[1];
                        if (videoId) {
                            const newSrc = `https://www.youtube.com/embed/${videoId}?rel=0&modestbranding=1&showinfo=0&controls=1&autoplay=0&mute=0&loop=0&playlist=${videoId}&enablejsapi=1&origin=${window.location.origin}&fs=1&iv_load_policy=3&cc_load_policy=0&disablekb=0&start=0&end=0&wmode=opaque&theme=dark`;
                            iframe.src = newSrc;
                            iframe.style.display = 'block';
                            alternative.style.display = 'none';
                            
                            // Check if this attempt works
                            setTimeout(function() {
                                if (iframe.contentWindow) {
                                    try {
                                        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                                        if (!iframeDoc || iframeDoc.location.href.includes('chrome-error')) {
                                            showVideoFallback();
                                        }
                                    } catch (e) {
                                        showVideoFallback();
                                    }
                                }
                            }, 3000);
                        }
                    }
                }, 2000);
            }
        }

        // Check for AdBlock
        function checkAdBlock() {
            // Create a test element that AdBlock typically blocks
            const testElement = document.createElement('div');
            testElement.innerHTML = '&nbsp;';
            testElement.className = 'adsbox';
            testElement.style.cssText = 'position:absolute;left:-999px;top:-999px;';
            document.body.appendChild(testElement);
            
            setTimeout(function() {
                if (testElement.offsetHeight === 0) {
                    document.getElementById('adblock-warning').style.display = 'block';
                }
                document.body.removeChild(testElement);
            }, 100);
        }

        // Test if iframe is supported
        function testIframeSupport() {
            const testIframe = document.createElement('iframe');
            testIframe.style.display = 'none';
            testIframe.src = 'about:blank';
            document.body.appendChild(testIframe);
            
            setTimeout(function() {
                try {
                    const testDoc = testIframe.contentDocument || testIframe.contentWindow.document;
                    if (testDoc) {
                        console.log('Iframe support detected');
                        checkVideoLoad();
                    } else {
                        console.log('Iframe not supported, showing direct link');
                        showDirectLink();
                    }
                } catch (e) {
                    console.log('Iframe blocked by browser, showing direct link');
                    showDirectLink();
                }
                document.body.removeChild(testIframe);
            }, 100);
        }

        // Run checks when page loads
        document.addEventListener('DOMContentLoaded', function() {
            checkAdBlock();
            testIframeSupport();
        });

        // Also check on iframe load error
        window.addEventListener('error', function(e) {
            if (e.target.tagName === 'IFRAME') {
                showVideoFallback();
            }
        });

        // Check for iframe load events
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.getElementById('youtube-iframe');
            if (iframe) {
                let iframeLoaded = false;
                
                iframe.addEventListener('load', function() {
                    console.log('Iframe load event triggered');
                    iframeLoaded = true;
                    
                    // Additional check after load
                    setTimeout(function() {
                        if (!iframeLoaded) {
                            showVideoFallback();
                        }
                    }, 2000);
                });
                
                iframe.addEventListener('error', function() {
                    console.log('Iframe error event triggered');
                    showVideoFallback();
                });
                
                // Check if iframe is actually displaying content
                setTimeout(function() {
                    if (!iframeLoaded) {
                        console.log('Iframe did not load within timeout, showing fallback');
                        showVideoFallback();
                    }
                }, 8000);
            }
        });
    </script>

    <style>
        .video-navigation {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .video-navigation .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .content-item.active {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            border-radius: 5px;
        }
        
        .content-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        
        .content-number.active {
            background: #2196f3;
            color: white;
        }
        
        .progress {
            border-radius: 10px;
            background: #e9ecef;
        }
        
        .progress-bar {
            border-radius: 10px;
            transition: width 0.3s ease;
        }
        
        .sidebar-widget {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .course-contents-list .content-item {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .course-contents-list .content-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }
        
        .course-contents-list .content-item.active:hover {
            background: #e3f2fd;
        }
    </style>
@endsection
