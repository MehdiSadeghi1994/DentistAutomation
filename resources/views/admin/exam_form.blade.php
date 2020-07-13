@extends('template')

@section('title')
{{ isset($exam) ? 'ویرایش آزمون' : 'آزمون تازه' }}
@endsection

@section('content')
<div class="card-header bg-transparent border-0">
    <h3 class="card-title d-inline text-info">
        {{ isset($exam) ? 'ویرایش آزمون' : 'آزمون تازه' }}
    </h3>
    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
</div>
<div class="card-body text-white">
    <form method="post" action="{{ URL::asset("/admin/exams") }}/{{ isset($exam) ? 'edit' : 'add' }}" id="form">
        <div class="row">
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>کد </label>
                        <input name="code" type="number" placeholder="Code" min="0" required autofocus
                            class="form-control {{$errors->has('capacity') ? 'is-invalid' : ''}}"
                            value="{{Request::old('code') ? Request::old('code') : (isset($exam) ? $exam->code : '9000') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">دوره تخصصی</label>
                        <select class="form-control" name="course_id">
                            @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                {{Request::old('course_id') && Request::old('course_id') == $course->id ? 'selected' : (isset($exam) && $exam->course_id == $course->id ? 'selected' : '')  }}>
                                {{$course->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>تاریخ شروع</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text cursor-pointer" id="date">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" id="inputDate" name="date" required aria-label="date" aria-describedby="date"
                                class="form-control {{$errors->has('date') ? 'is-invalid' : ''}}"
                                value="{{Request::old('date') ? Request::old('date') : (isset($exam) ? $exam->date : '') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>ساعت شروع</label>
                        <input type="time" name="time" required class="form-control {{$errors->has('time') ? 'is-invalid' : ''}}"
                            value="{{Request::old('time') ? Request::old('time') : (isset($exam) ? $exam->time : '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>جزییات</label>
                    <input name="details" type="text" placeholder="Details"
                        class="form-control {{$errors->has('details') ? 'is-invalid' : ''}}"
                        value="{{Request::old('details') ? Request::old('details') : (isset($exam) ? $exam->details : '') }}">
                </div>
                <input name="id" type="hidden" value="{{ isset($exam) ? $exam->id : '' }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
            </div>
        </div>
    </form>
</div>

@endsection