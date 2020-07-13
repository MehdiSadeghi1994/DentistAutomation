@extends('client.template')

@section('title')تقویم آموزشی@endsection

@section('content')

    <h2 class="text-danger text-center my-4">
        تقویم آموزشی
    </h2>

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist" style="margin: 0 -10px;">
                @foreach($i3classes_all as $index => $i3classes)
                    <li class="nav-item">
                        <a class="nav-link btn btn-white btn-sm {{$index == 0 ? 'active':''}}" id="pills-{{ $i3classes["name"] }}-tab"
                           data-toggle="pill" href="#pills-{{ $i3classes["name"] }}" role="tab"
                           aria-controls="pills-{{ $i3classes["name"] }}" aria-selected="true" style="margin: 0 10px;">
                            {{ $i3classes["title"] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($i3classes_all as $index => $i3classes)
                    <div class="tab-pane fade {{$index == 0 ? 'show active':''}}" id="pills-{{ $i3classes["name"] }}"
                         role="tabpanel" aria-labelledby="pills-{{ $i3classes["name"] }}-tab">
                        <div class="row">
                            @foreach($i3classes["value"] as $i3class)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                                    @include('client.course_card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
