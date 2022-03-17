<?php

namespace App\Http\Requests;

use App\Models\HrRecruitment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHrRecruitmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hr_recruitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hr_recruitments,id',
        ];
    }
}
