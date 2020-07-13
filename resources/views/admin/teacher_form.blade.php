@extends('admin.template')

@section('title')
    {{ isset($teacher) ? 'ویرایش استاد' : 'استاد تازه' }}
@endsection

@section('content')
    <div class="card shadow rounded-lg border-0 pt-2">
        <div class="card-header bg-transparent border-0">
            <h3 class="card-title d-inline text-danger">
                {{ isset($teacher) ? 'ویرایش استاد' : 'استاد تازه' }}
            </h3>
            <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
        </div>
        <div class="card-body">
            <form method="post" action="{{ URL::asset("/admin/teacher") }}/{{ isset($teacher) ? 'edit' : 'add' }}"
                  enctype="multipart/form-data" id="form">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>نام</label>
                                <input name="name" type="text" placeholder="Name" required autofocus
                                       class="form-control rounded-lg {{$errors->has('name') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('name') ? Request::old('name') : (isset($teacher) ? $teacher->name : '') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="d-block">مرتبه علمی</label>
                                <div class="btn-group btn-group-toggle special" data-toggle="buttons">
                                    <label
                                        class="btn btn-info {{isset($teacher) ? ($teacher->type == 0 ? 'active' : '') : 'active' }}">
                                        <input type="radio" name="type" value="0" id="option1"
                                               autocomplete="off" {{isset($teacher) ? ($teacher->type == 0 ? 'checked' : '') : 'checked' }}>
                                        مدرس
                                    </label>
                                    <label
                                        class="btn btn-info {{isset($teacher) && $teacher->type == 1 ? 'active' : ''}}">
                                        <input type="radio" name="type" value="1" id="option2"
                                               autocomplete="off" {{isset($teacher) && $teacher->type == 1 ? 'checked' : ''}}>
                                        کمک مدرس
                                    </label>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاریخ تولد</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text cursor-pointer" id="date">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                    </div>
                                    <input type="text" id="inputDate" name="birth_date" required
                                           class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}"
                                           aria-label="date" aria-describedby="date"
                                           value="{{Request::old('birth_date') ? Request::old('birth_date') : (isset($teacher) ? $teacher->birth_date : '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>توضیح</label>
                            <textarea name="explanation"
                                      id="editor">{{Request::old('explanation') ? Request::old('explanation') : (isset($teacher) ? $teacher->explanation : '') }}</textarea>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label>ایمیل</label>
                                <input name="email" type="email" placeholder="Email" required
                                       class="form-control rounded-lg {{$errors->has('email') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('email') ? Request::old('email') : (isset($teacher) ? $teacher->email : '') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>کلمه عبور</label>
                                <input name="password" type="text" placeholder="Password" required
                                       class="form-control rounded-lg {{$errors->has('password') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('password') ? Request::old('password') : (isset($teacher) ? $teacher->password : '') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>شماره همراه</label>
                                <input name="phone_number" type="text" placeholder="Phone" required
                                       class="form-control rounded-lg {{$errors->has('phone_number') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('phone_number') ? Request::old('phone_number') : (isset($teacher) ? $teacher->phone_number : '') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>لینکدین</label>
                                <input name="linkedin" type="text" placeholder="Linkedin" required
                                       class="form-control rounded-lg {{$errors->has('linkedin') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('linkedin') ? Request::old('linkedin') : (isset($teacher) ? $teacher->linkedin : '') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="description">توصیف</label>
                                <input name="description" type="text" required placeholder="Description"
                                       class="form-control {{$errors->has('description') ? 'is-invalid"' : ''}}"
                                       value="{{Request::old('description') ? Request::old('description') : (isset($teacher) ? $teacher->description : '') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="keywords">کلمات کلیدی</label>
                                <input name="keywords" type="text" required placeholder="Keywords"
                                       class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('keywords') ? Request::old('keywords') : (isset($teacher) ? $teacher->keywords : '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>تصویر</label>
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-block" id="ckf">
                                انتخاب
                            </button>
                        </div>
                        <input id="img-address" class="form-control" type="hidden" name="image"
                               value="{{Request::old('image') ? Request::old('image') : (isset($teacher) ? $teacher->image : '') }}">
                        <img id="img-preview" class="img-fluid rounded-lg"
                             src="{{ isset($teacher) ? URL::asset("$teacher->image") : '' }}">
                    </div>
                </div>
                <input name="id" type="hidden" value="{{ isset($teacher) ? $teacher->id : '' }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>

@endsection
