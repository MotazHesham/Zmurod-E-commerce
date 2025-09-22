<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_url',
        'video_file',
        'duration',
        'order',
        'is_free',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'duration' => 'integer',
        'order' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function downloads()
    {
        return $this->hasMany(UserDownload::class);
    }

    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) return null;
        
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . $minutes . 'm';
        }
        
        return $minutes . 'm';
    }

    public function getVideoTypeAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Auto-detect video type from URL
        if ($this->video_url) {
            if (strpos($this->video_url, 'youtube.com') !== false || strpos($this->video_url, 'youtu.be') !== false) {
                return 'youtube';
            } elseif (strpos($this->video_url, 'zoom.us') !== false) {
                return 'zoom';
            } elseif (strpos($this->video_url, 'vimeo.com') !== false) {
                return 'vimeo';
            } else {
                return 'other';
            }
        }

        return 'file';
    }

    public function getVideoIconAttribute()
    {
        switch ($this->video_type) {
            case 'youtube':
                return 'fab fa-youtube text-danger';
            case 'zoom':
                return 'fas fa-video text-primary';
            case 'vimeo':
                return 'fab fa-vimeo text-info';
            case 'file':
                return 'fas fa-file-video text-success';
            default:
                return 'fas fa-play text-muted';
        }
    }

    public function getVideoPlatformNameAttribute()
    {
        switch ($this->video_type) {
            case 'youtube':
                return 'YouTube';
            case 'zoom':
                return 'Zoom';
            case 'vimeo':
                return 'Vimeo';
            case 'file':
                return 'ملف محلي';
            default:
                return 'فيديو';
        }
    }
}
