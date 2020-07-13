@extends('template')

@section('title'){{$group->name}}@endsection

@section('description'){{$group->description}}@endsection

@section('keywords'){{$group->keywords}}@endsection

@section('image'){{ URL::asset($group->image) }}@endsection

@section('content')

    <div class="row">
        @foreach($group->courses as $course)
            <div class="col-12 mb-4">
                <a class="text-decoration-none" href="{{ URL::asset("/course/" . str_replace(' ', '-', $group->name_en) . "/" . str_replace(' ', '-', $course->name)) }}">
                    <div class="card shadow rounded-lg border-0 w-100 bg-dark text-white">
                        <div class="card-body text-justify position-relative">
                            <div class="row position-relative ">
                                <div class="col-2 pr-0">
                                    <div class="card-img mx-auto">
                                        <img src="{{ URL::asset($course->image) }}" class="img-fluid"
                                             alt="{{$course->name}}">
                                    </div>
                                </div>
                                <div class="col-sm-10 pl-0 pr-0">
                                    <h2 class="card-title">
                                        {{$course->name}}
                                    </h2>
                                    <p class="card-text text-wrap">
                                        {!! $course->explanation !!}
                                    </p>
                                    <h4 class="mb-3">
                                        <i class="fas fa-user fa-fw"></i>
                                        مدرس:
                                        {{ $course->teacher->name }}
                                    </h4>
                                </div>
                                <span class="position-absolute text-gold" style="left: 0px; bottom: 0px;">
                            شروع یادگیری
                            <i class="fas fa-arrow-left fa-fw"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
