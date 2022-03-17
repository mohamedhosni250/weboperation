@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.hrRecruitment.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hr-recruitments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.mobilenumber') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->mobilenumber }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.file_path') }}
                                    </th>
                                    <td>
                                        @if($hrRecruitment->file_path)
                                            <a href="{{ $hrRecruitment->file_path->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.called') }}
                                    </th>
                                    <td>
                                        {{ App\Models\HrRecruitment::CALLED_SELECT[$hrRecruitment->called] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\HrRecruitment::STATUS_SELECT[$hrRecruitment->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.interview_date') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->interview_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.comments') }}
                                    </th>
                                    <td>
                                        {!! $hrRecruitment->comments !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.department') }}
                                    </th>
                                    <td>
                                        {{ $hrRecruitment->department->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hr-recruitments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection