@extends('template')

@section('title')
{{ isset($stage) ? 'ویرایش بخش' : 'بخش تازه' }}
@endsection

@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-info">
                    {{ isset($stage) ? 'ویرایش بخش' : 'بخش تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body text-white">
                <form method="post" id="form"
                    action="{{ URL::asset("/admin/exams/$exam->id/stages") }}/{{ isset($stage) ? "$stage->id/edit" : 'add' }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>عنوان </label>
                                <input name="title" type="text" placeholder="Title" min="0" required autofocus
                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('title') ? Request::old('title') : (isset($stage) ? $stage->title : '') }}">
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