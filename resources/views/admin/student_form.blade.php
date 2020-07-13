@extends('admin.template')

@section('title')
    {{ isset($student) ? 'ویرایش دانشجو' : 'دانشجوی تازه' }}
@endsection

@section('content')

    <div class="card-header bg-transparent border-0">
        <h3 class="card-title d-inline text-light">
            {{ isset($student) ? 'ویرایش دانشجو' : 'دانشجوی تازه' }}
        </h3>
        <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
    </div>
    <div class="card-body">
        <form method="post"
              action="{{ URL::asset("/admin/student") }}/{{ isset($student) ? 'edit' : 'add' }}"
              enctype="multipart/form-data" id="form">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>نام</label>
                            <input name="name" type="text" placeholder="Name" required autofocus
                                   class="form-control rounded-lg {{$errors->has('name') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('name') ? Request::old('name') : (isset($student) ? $student->name : '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>نام خانوادگی</label>
                            <input name="family" type="text" placeholder="Family" required
                                   class="form-control rounded-lg {{$errors->has('family') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('family') ? Request::old('family') : (isset($student) ? $student->family : '') }}">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>شماره ملی</label>
                            <input name="national_code" type="text" placeholder="National Code" required
                                   class="form-control rounded-lg {{$errors->has('national_code') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('national_code') ? Request::old('national_code') : (isset($student) ? $student->national_code : '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>شماره همراه</label>
                            <input name="phone_number" type="text" placeholder="Phone Number" required
                                   class="form-control rounded-lg {{$errors->has('phone_number') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('phone_number') ? Request::old('phone_number') : (isset($student) ? $student->phone_number : '') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ایمیل</label>
                            <input name="email" type="email" placeholder="Email" required
                                   class="form-control rounded-lg {{$errors->has('email') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('email') ? Request::old('email') : (isset($student) ? $student->email : '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>کلمه عبور</label>
                            <input name="password" type="text" placeholder="Password" required
                                   class="form-control rounded-lg {{$errors->has('password') ? 'is-invalid' : ''}}"
                                   value="{{Request::old('password') ? Request::old('password') : (isset($student) ? $student->password : '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>تصویر</label>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" id="ckf">
                            انتخاب
                        </button>
                    </div>
                    <input id="img-address" class="form-control" type="hidden" name="image"
                           value="{{Request::old('image') ? Request::old('image') : (isset($student) ? $student->image : '') }}">
                    <img id="img-preview" class="img-fluid rounded-lg"
                         src="{{ isset($student) ? URL::asset("$student->image") : '' }}">
                </div>
            </div>
            <input name="id" type="hidden" value="{{ isset($student) ? $student->id : '' }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
        </form>
    </div>

@endsection
