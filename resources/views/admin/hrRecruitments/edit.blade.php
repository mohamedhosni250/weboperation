@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.hrRecruitment.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.hr-recruitments.update", [$hrRecruitment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.hrRecruitment.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $hrRecruitment->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('mobilenumber') ? 'has-error' : '' }}">
                            <label class="required" for="mobilenumber">{{ trans('cruds.hrRecruitment.fields.mobilenumber') }}</label>
                            <input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="{{ old('mobilenumber', $hrRecruitment->mobilenumber) }}" required>
                            @if($errors->has('mobilenumber'))
                                <span class="help-block" role="alert">{{ $errors->first('mobilenumber') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.mobilenumber_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.hrRecruitment.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $hrRecruitment->email) }}">
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('file_path') ? 'has-error' : '' }}">
                            <label for="file_path">{{ trans('cruds.hrRecruitment.fields.file_path') }}</label>
                            <div class="needsclick dropzone" id="file_path-dropzone">
                            </div>
                            @if($errors->has('file_path'))
                                <span class="help-block" role="alert">{{ $errors->first('file_path') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.file_path_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('called') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.hrRecruitment.fields.called') }}</label>
                            <select class="form-control" name="called" id="called">
                                <option value disabled {{ old('called', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\HrRecruitment::CALLED_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('called', $hrRecruitment->called) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('called'))
                                <span class="help-block" role="alert">{{ $errors->first('called') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.called_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.hrRecruitment.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\HrRecruitment::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $hrRecruitment->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('interview_date') ? 'has-error' : '' }}">
                            <label for="interview_date">{{ trans('cruds.hrRecruitment.fields.interview_date') }}</label>
                            <input class="form-control datetime" type="text" name="interview_date" id="interview_date" value="{{ old('interview_date', $hrRecruitment->interview_date) }}">
                            @if($errors->has('interview_date'))
                                <span class="help-block" role="alert">{{ $errors->first('interview_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.interview_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                            <label for="comments">{{ trans('cruds.hrRecruitment.fields.comments') }}</label>
                            <textarea class="form-control ckeditor" name="comments" id="comments">{!! old('comments', $hrRecruitment->comments) !!}</textarea>
                            @if($errors->has('comments'))
                                <span class="help-block" role="alert">{{ $errors->first('comments') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.comments_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                            <label for="department_id">{{ trans('cruds.hrRecruitment.fields.department') }}</label>
                            <select class="form-control select2" name="department_id" id="department_id">
                                @foreach($departments as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $hrRecruitment->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('department'))
                                <span class="help-block" role="alert">{{ $errors->first('department') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hrRecruitment.fields.department_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.filePathDropzone = {
    url: '{{ route('admin.hr-recruitments.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file_path"]').remove()
      $('form').append('<input type="hidden" name="file_path" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_path"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($hrRecruitment) && $hrRecruitment->file_path)
      var file = {!! json_encode($hrRecruitment->file_path) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_path" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.hr-recruitments.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $hrRecruitment->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection