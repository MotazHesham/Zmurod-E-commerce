@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">إدارة محتوى الدورة: {{ $course->name }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> العودة للدورات
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Add Content Form -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>إضافة محتوى جديد</h4>
                    </div>
                    <div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');
        $uploadMaxBytes = $uploadMax ? (int)$uploadMax * (strpos($uploadMax, 'M') !== false ? 1024*1024 : 1) : 0;
        $postMaxBytes = $postMax ? (int)$postMax * (strpos($postMax, 'M') !== false ? 1024*1024 : 1) : 0;
    @endphp

    @if($uploadMaxBytes < 500*1024*1024 || $postMaxBytes < 500*1024*1024)
        <div class="alert alert-warning">
            <strong>تحذير:</strong> إعدادات PHP الحالية قد تمنع رفع الملفات الكبيرة.
            <br>
            <strong>الحد الحالي:</strong> upload_max_filesize = {{ $uploadMax }}, post_max_size = {{ $postMax }}
            <br>
            <strong>المطلوب:</strong> 500MB على الأقل
            <br>
            <small>يرجى تحديث ملف php.ini أو .htaccess لحل هذه المشكلة</small>
        </div>
    @endif
                        
                        <form action="{{ route('admin.courses.content.store', $course) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان المحتوى</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order">ترتيب المحتوى</label>
                                        <input type="number" name="order" id="order" class="form-control" min="0" value="{{ $course->contents->count() + 1 }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">وصف المحتوى</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video_url">رابط الفيديو</label>
                                        <input type="url" name="video_url" id="video_url" class="form-control" placeholder="YouTube, Zoom, Vimeo, أو أي رابط فيديو آخر" onchange="detectVideoType(this)">
                                        <small class="text-muted">يدعم: YouTube, Zoom, Vimeo, أو أي رابط فيديو آخر</small>
                                        <div id="video-type-info" class="mt-2" style="display: none;">
                                            <div class="alert alert-info">
                                                <strong>نوع الفيديو:</strong> <span id="detected-type"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video_file">أو رفع ملف فيديو</label>
                                        <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*" onchange="validateVideoFile(this)">
                                        <small class="text-muted">الحد الأقصى: 500MB | الأنواع المسموحة: MP4, AVI, MOV, WMV, WEBM, MKV, FLV, 3GP, MPG, MPEG, OGV</small>
                                        <div id="file-info" class="mt-2" style="display: none;">
                                            <div class="alert alert-info">
                                                <strong>معلومات الملف:</strong>
                                                <div id="file-details"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">مدة الفيديو (بالدقائق)</label>
                                        <input type="number" name="duration" id="duration" class="form-control" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check mt-4">
                                            <input type="checkbox" name="is_free" id="is_free" class="form-check-input">
                                            <label for="is_free" class="form-check-label">محتوى مجاني</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> إضافة المحتوى
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content List -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>محتوى الدورة ({{ $course->contents->count() }} عنصر)</h4>
                    </div>
                    <div class="card-body">
                        @if($course->contents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>العنوان</th>
                                            <th>النوع</th>
                                            <th>المدة</th>
                                            <th>الترتيب</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($course->contents->sortBy('order') as $content)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $content->title }}</strong>
                                                    @if($content->description)
                                                        <br><small class="text-muted">{{ Str::limit($content->description, 50) }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($content->video_url)
                                                        <span class="badge badge-info">رابط خارجي</span>
                                                    @elseif($content->video_file)
                                                        <span class="badge badge-success">ملف محلي</span>
                                                    @else
                                                        <span class="badge badge-secondary">بدون فيديو</span>
                                                    @endif
                                                    @if($content->is_free)
                                                        <br><span class="badge badge-warning">مجاني</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($content->duration)
                                                        {{ $content->formatted_duration }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $content->order }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $content->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.courses.content.destroy', [$course, $content]) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle"></i>
                                لا يوجد محتوى لهذه الدورة بعد.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($course->contents as $content)
<div class="modal fade" id="editModal{{ $content->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل المحتوى</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.courses.content.update', [$course, $content]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if($content->video_url)
                        <div class="alert alert-info">
                            <strong>النوع الحالي:</strong> 
                            <i class="{{ $content->video_icon }}"></i> {{ $content->video_platform_name }}
                        </div>
                    @elseif($content->video_file)
                        <div class="alert alert-success">
                            <strong>النوع الحالي:</strong> 
                            <i class="fas fa-file-video"></i> ملف فيديو محلي
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title{{ $content->id }}">عنوان المحتوى</label>
                                <input type="text" name="title" id="title{{ $content->id }}" class="form-control" value="{{ $content->title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order{{ $content->id }}">ترتيب المحتوى</label>
                                <input type="number" name="order" id="order{{ $content->id }}" class="form-control" min="0" value="{{ $content->order }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description{{ $content->id }}">وصف المحتوى</label>
                        <textarea name="description" id="description{{ $content->id }}" class="form-control" rows="3">{{ $content->description }}</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_url{{ $content->id }}">رابط الفيديو</label>
                                <input type="url" name="video_url" id="video_url{{ $content->id }}" class="form-control" value="{{ $content->video_url }}" onchange="detectVideoType(this)" placeholder="YouTube, Zoom, Vimeo, أو أي رابط فيديو آخر">
                                <small class="text-muted">يدعم: YouTube, Zoom, Vimeo, أو أي رابط فيديو آخر</small>
                                <div id="video-type-info{{ $content->id }}" class="mt-2" style="display: none;">
                                    <div class="alert alert-info">
                                        <strong>نوع الفيديو:</strong> <span id="detected-type{{ $content->id }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_file{{ $content->id }}">أو رفع ملف فيديو جديد</label>
                                <input type="file" name="video_file" id="video_file{{ $content->id }}" class="form-control" accept="video/*" onchange="validateVideoFile(this)">
                                <small class="text-muted">الحد الأقصى: 500MB | الأنواع المسموحة: MP4, AVI, MOV, WMV, WEBM, MKV, FLV, 3GP, MPG, MPEG, OGV</small>
                                @if($content->video_file)
                                    <small class="text-muted d-block">الملف الحالي: {{ basename($content->video_file) }}</small>
                                @endif
                                <div id="file-info{{ $content->id }}" class="mt-2" style="display: none;">
                                    <div class="alert alert-info">
                                        <strong>معلومات الملف:</strong>
                                        <div id="file-details{{ $content->id }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration{{ $content->id }}">مدة الفيديو (بالدقائق)</label>
                                <input type="number" name="duration" id="duration{{ $content->id }}" class="form-control" min="1" value="{{ $content->duration }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check mt-4">
                                    <input type="checkbox" name="is_free" id="is_free{{ $content->id }}" class="form-check-input" {{ $content->is_free ? 'checked' : '' }}>
                                    <label for="is_free{{ $content->id }}" class="form-check-label">محتوى مجاني</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
function validateVideoFile(input) {
    const file = input.files[0];
    const inputId = input.id;
    const fileInfo = document.getElementById('file-info' + (inputId.includes('{{') ? '' : inputId.replace('video_file', '')));
    const fileDetails = document.getElementById('file-details' + (inputId.includes('{{') ? '' : inputId.replace('video_file', '')));
    
    if (file) {
        const maxSize = 500 * 1024 * 1024; // 500MB in bytes
        const allowedTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv', 'video/webm', 'video/mkv', 'video/flv', 'video/3gp', 'video/mpg', 'video/mpeg', 'video/ogg'];
        
        let isValid = true;
        let errorMessage = '';
        
        // Check file size
        if (file.size > maxSize) {
            isValid = false;
            errorMessage += 'حجم الملف كبير جداً. الحد الأقصى 500MB<br>';
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            isValid = false;
            errorMessage += 'نوع الملف غير مدعوم. الأنواع المسموحة: MP4, AVI, MOV, WMV, WEBM, MKV, FLV, 3GP, MPG, MPEG, OGV<br>';
        }
        
        // Show file info
        if (fileDetails) {
            fileDetails.innerHTML = `
                <strong>الاسم:</strong> ${file.name}<br>
                <strong>الحجم:</strong> ${(file.size / (1024 * 1024)).toFixed(2)} MB<br>
                <strong>النوع:</strong> ${file.type}
            `;
            
            if (isValid) {
                fileDetails.innerHTML += '<br><span class="text-success">✓ الملف صالح للرفع</span>';
                fileInfo.className = 'mt-2 alert alert-success';
            } else {
                fileDetails.innerHTML += '<br><span class="text-danger">✗ ' + errorMessage + '</span>';
                fileInfo.className = 'mt-2 alert alert-danger';
            }
        }
        
        if (fileInfo) {
            fileInfo.style.display = 'block';
        }
    } else {
        if (fileInfo) {
            fileInfo.style.display = 'none';
        }
    }
}

function detectVideoType(input) {
    const url = input.value;
    const inputId = input.id;
    const typeInfo = document.getElementById('video-type-info' + (inputId.includes('{{') ? '' : inputId.replace('video_url', '')));
    const detectedType = document.getElementById('detected-type' + (inputId.includes('{{') ? '' : inputId.replace('video_url', '')));
    
    if (url) {
        let platform = 'غير معروف';
        let icon = 'fas fa-play';
        let color = 'text-muted';
        
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            platform = 'YouTube';
            icon = 'fab fa-youtube';
            color = 'text-danger';
        } else if (url.includes('zoom.us')) {
            platform = 'Zoom';
            icon = 'fas fa-video';
            color = 'text-primary';
        } else if (url.includes('vimeo.com')) {
            platform = 'Vimeo';
            icon = 'fab fa-vimeo';
            color = 'text-info';
        } else if (url.includes('drive.google.com')) {
            platform = 'Google Drive';
            icon = 'fab fa-google-drive';
            color = 'text-success';
        } else if (url.includes('dropbox.com')) {
            platform = 'Dropbox';
            icon = 'fab fa-dropbox';
            color = 'text-primary';
        } else if (url.includes('onedrive.live.com') || url.includes('1drv.ms')) {
            platform = 'OneDrive';
            icon = 'fab fa-microsoft';
            color = 'text-primary';
        } else {
            platform = 'رابط فيديو آخر';
            icon = 'fas fa-link';
            color = 'text-secondary';
        }
        
        if (detectedType) {
            detectedType.innerHTML = `<i class="${icon} ${color}"></i> ${platform}`;
        }
        if (typeInfo) {
            typeInfo.style.display = 'block';
        }
    } else {
        if (typeInfo) {
            typeInfo.style.display = 'none';
        }
    }
}
</script>
@endsection
