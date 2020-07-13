@extends('template')

@section('title')
{{ isset($stage) ? 'ویرایش آموزش' : 'آموزش تازه' }}
@endsection

@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-info">
                    {{ isset($lesson) ? 'ویرایش آموزش' : 'آموزش تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" id="form"
                    action="{{ URL::asset("/admin/exams/$exam->id/stages/$stage->id/lesson") }}/{{ isset($lesson) ? "edit" : 'add' }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class=" text-white">متن </label>
                                <textarea name="text" id="editor"
                            class="form-control">{{Request::old('text') ? Request::old('text') : (isset($text) ? $lesson->text : '') }}</textarea>
                       </div>
                            <input name="id" type="hidden" value="{{ isset($exam) ? $exam->id : '' }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection