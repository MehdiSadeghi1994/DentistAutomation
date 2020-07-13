@extends('template')

@section('title')
{{ isset($course) ? 'ویرایش دوره تخصصی' : 'دوره تخصصی تازه' }}
@endsection

@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-info">
                    {{ isset($course) ? 'ویرایش دوره تخصصی' : 'دوره تخصصی تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/course") }}/{{isset($course) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">نام</label>
                                    <input name="name" id="name" type="text" required autofocus
                                        class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('name') ? Request::old('name') : (isset($course) ? $course->name : '') }}">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>گروه</label>
                                    <select class="form-control" name="group_id">
                                        @foreach($groups as $group)
                                        <option value="{{$group->id}}"
                                            {{Request::old('group_id') && Request::old('group_id') == $group->id ? 'selected' : (isset($course) && $course->group_id == $group->id ? 'selected' : '') }}>
                                            {{$group->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>توضیح کوتاه</label>
                                <textarea name="short_explanation" required
                                    class="form-control {{$errors->has('short_explanation') ? 'is-invalid' : ''}}">{{Request::old('short_explanation') ? Request::old('short_explanation') : (isset($course) ? $course->short_explanation : '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="pb-2">
                                    توضیح
                                </label>
                                <textarea name="explanation" id="editor"
                                    class="form-control">{{Request::old('explanation') ? Request::old('explanation') : (isset($course) ? $course->explanation : '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="pb-2">
                                    سرفصل ها
                                </label>
                                <textarea name="headlines" id="editor1"
                                    class="form-control">{{Request::old('headlines') ? Request::old('headlines') : (isset($course) ? $course->headlines : '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="pb-2">
                                    پیشنیازها
                                </label>
                                <textarea name="prerequisites" id="editor2"
                                    class="form-control">{{Request::old('prerequisites') ? Request::old('prerequisites') : (isset($course) ? $course->prerequisites : '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input name="description" type="text" required
                                    class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('description') ? Request::old('description') : (isset($course) ? $course->description : '') }}">
                            </div>
                            <div class="form-group">
                                <label>Keywords</label>
                                <input name="keywords" type="text" required
                                    class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('keywords') ? Request::old('keywords') : (isset($course) ? $course->keywords : '') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>تصویر</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-block" id="ckf">
                                    انتخاب
                                </button>
                            </div>
                            <div class="form-group">
                                <input id="img-address" class="form-control" type="hidden" name="image" dir="ltr"
                                    value="{{Request::old('image') ? Request::old('image') : (isset($course) ? $course->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($course) ? URL::asset("$course->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($course) ? $course->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection