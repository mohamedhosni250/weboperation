<?php

namespace App\Http\Requests;

use App\Models\HrRecruitment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHrRecruitmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hr_recruitment_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'mobilenumber' => [
                'string',
                'required',
            ],
            'interview_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
