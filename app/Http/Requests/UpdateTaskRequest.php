<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'status' => [
                'required',
            ],
            'month' => [
                'string',
                'required',
            ],
        ];
    }
}
