<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HrRecruitment extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const CALLED_SELECT = [
        'not_yet'   => 'Not Yet',
        'yes'       => 'Yes',
        'no_answer' => 'No Answer',
    ];

    public const STATUS_SELECT = [
        'processing' => 'Processing',
        'accepted'   => 'Accepted',
        'rejected'   => 'Rejected',
    ];

    public $table = 'hr_recruitments';

    protected $appends = [
        'file_path',
    ];

    protected $dates = [
        'interview_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'mobilenumber',
        'email',
        'called',
        'status',
        'interview_date',
        'comments',
        'department_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getFilePathAttribute()
    {
        return $this->getMedia('file_path')->last();
    }

    public function getInterviewDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setInterviewDateAttribute($value)
    {
        $this->attributes['interview_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
