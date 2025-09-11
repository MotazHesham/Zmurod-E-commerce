<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Seller extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'sellers';

    protected $with = ['user'];


    protected $appends = [
        'photo',
        'commercial_register_document',
        'freelance_work_document',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'commercial_register_expiry',
    ];

    protected $fillable = [
        'store_name',
        'description',
        'featured_store',
        'user_id',
        'organization_id',
        'commercial_register',
        'bank_id',
        'account_number',
        'iban',
        'document_type',
        'commercial_register_document',
        'commercial_register_expiry',
        'commercial_register_number',
        'tax_number',
        'freelance_work_document',
        'freelance_work_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCommercialRegisterDocumentAttribute()
    {
        $file = $this->getMedia('commercial_register_document')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getFreelanceWorkDocumentAttribute()
    {
        $file = $this->getMedia('freelance_work_document')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function documents()
    {
        return $this->hasMany(SellerDocument::class);
    }

}
