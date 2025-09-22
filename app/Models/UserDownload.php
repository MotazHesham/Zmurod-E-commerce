<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_content_id',
        'download_type',
        'file_path',
        'file_size',
        'download_method',
        'ip_address',
        'user_agent',
        'downloaded_at'
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseContent()
    {
        return $this->belongsTo(CourseContent::class);
    }

    // Helper methods
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return 'غير محدد';
        
        $bytes = (int) $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getDownloadTypeIconAttribute()
    {
        switch ($this->download_type) {
            case 'video':
                return 'fas fa-video';
            case 'audio':
                return 'fas fa-music';
            case 'pdf':
                return 'fas fa-file-pdf';
            case 'document':
                return 'fas fa-file-alt';
            default:
                return 'fas fa-download';
        }
    }
}
