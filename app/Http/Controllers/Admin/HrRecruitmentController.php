<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHrRecruitmentRequest;
use App\Http\Requests\StoreHrRecruitmentRequest;
use App\Http\Requests\UpdateHrRecruitmentRequest;
use App\Models\Department;
use App\Models\HrRecruitment;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HrRecruitmentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('hr_recruitment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrRecruitments = HrRecruitment::with(['department', 'media'])->get();

        $departments = Department::get();

        return view('admin.hrRecruitments.index', compact('departments', 'hrRecruitments'));
    }

    public function create()
    {
        abort_if(Gate::denies('hr_recruitment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hrRecruitments.create', compact('departments'));
    }

    public function store(StoreHrRecruitmentRequest $request)
    {
        $hrRecruitment = HrRecruitment::create($request->all());

        if ($request->input('file_path', false)) {
            $hrRecruitment->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_path'))))->toMediaCollection('file_path');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hrRecruitment->id]);
        }

        return redirect()->route('admin.hr-recruitments.index');
    }

    public function edit(HrRecruitment $hrRecruitment)
    {
        abort_if(Gate::denies('hr_recruitment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hrRecruitment->load('department');

        return view('admin.hrRecruitments.edit', compact('departments', 'hrRecruitment'));
    }

    public function update(UpdateHrRecruitmentRequest $request, HrRecruitment $hrRecruitment)
    {
        $hrRecruitment->update($request->all());

        if ($request->input('file_path', false)) {
            if (!$hrRecruitment->file_path || $request->input('file_path') !== $hrRecruitment->file_path->file_name) {
                if ($hrRecruitment->file_path) {
                    $hrRecruitment->file_path->delete();
                }
                $hrRecruitment->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_path'))))->toMediaCollection('file_path');
            }
        } elseif ($hrRecruitment->file_path) {
            $hrRecruitment->file_path->delete();
        }

        return redirect()->route('admin.hr-recruitments.index');
    }

    public function show(HrRecruitment $hrRecruitment)
    {
        abort_if(Gate::denies('hr_recruitment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrRecruitment->load('department');

        return view('admin.hrRecruitments.show', compact('hrRecruitment'));
    }

    public function destroy(HrRecruitment $hrRecruitment)
    {
        abort_if(Gate::denies('hr_recruitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrRecruitment->delete();

        return back();
    }

    public function massDestroy(MassDestroyHrRecruitmentRequest $request)
    {
        HrRecruitment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hr_recruitment_create') && Gate::denies('hr_recruitment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HrRecruitment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
