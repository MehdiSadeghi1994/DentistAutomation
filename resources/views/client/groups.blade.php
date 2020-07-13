@extends('template')

@section('title')
دوره های آموزشی
@endsection

@section('content')

<h2 class="text-info text-center my-4">
    دوره های آموزشی
</h2>


<div class="row">
    <div class="col-12">
        <h3 class="text-white">
            دسته بندی موضوعی
        </h3>
        <hr class="bg-info">
    </div>
</div>
<div class="row">
    @foreach($groups as $group)
    @if(count($group->childs) != 0)
    <div class="col-lg-2 col-sm-4 col-6 mb-4">
        <a href="#{{ $group->name_en }}" class="text-decoration-none">
            <div class="card shadow-sm rounded-lg text-center h-100 bg-dark text-info border-0 hover">
                <div class="card-body">
                    <i class="fad fa-{{ $group->fontawesome }} fa-4x"></i>
                    <h4 class="card-title mt-4 mb-0">
                        {{$group->name_fa}}
                    </h4>
                </div>
            </div>
        </a>
    </div>
    @endif
    @endforeach
</div>

@foreach($groups as $group)
@if(count($group->childs) != 0)

<div class="row">
    <div class="col-12">
        <h3 id="{{ $group->name_en }}" class="text-white" style="padding-top: 80px">
            <i class="fa fa-{{ $group->fontawesome }} fa-fw ml-2"></i>
            {{ $group->name_fa }}
        </h3>
        <hr class="bg-info">
    </div>
</div>
<div class="row">
    @foreach($group->childs as $child)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
        <a href="{{ URL::asset("/course/" . str_replace(' ', '-', $child->name_en)) }}"
            class="text-dark text-decoration-none">
            <div class="card shadow-sm rounded-lg text-center h-100 bg-dark text-white border-0 hover">
                <div class="card-body">
                    <img src="{{ URL::asset($child->image) }}" class="card-img-top" alt="{{$child->name}}">
                </div>
                <div class="card-footer">
                    <h4 class="card-title">
                        {{$child->name_fa}}
                    </h4>
                    <p class="card-text text-wrap small">
                        {{ $child->short_explanation }}
                    </p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

@endforeach

@endsection