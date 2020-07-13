@extends('template')

@section('title')
صفحه اصلی
@endsection

@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')

<h1 class="display-4 text-center text-info mt-5 title">
    Iranian College
</h1>

<div class="row my-5 px-lg-5 mx-lg-5 justify-content-center">
    <div class="col-12 px-md-4" style="max-width: 1000px">
        <form class="w-100 position-relative" method="post" action="/search">
            <input class="form-control bg-dark text-info rounded-pill border-0 p-3 shadow-sm" type="search"
                placeholder="جستجو..." aria-label="Search" id="index-search" name="search_item">
            <button type="submit" class="btn text-info bg-transparent rounded-circle position-absolute"
                style="left:0; top:0px; height: 56px; width: 56px; padding-top: 20px">
                <span class="fa fa-search fa-lg"></span>
            </button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>

<div class="row px-lg-5 mx-lg-5 justify-content-center">
    <div class="col-md-3 col-6 px-lg-4 px-md-4 mb-4" style="max-width: 250px">
        <a href="#" class="text-decoration-none">
            <div class="btn-dark rounded-circle btn-circle text-info shadow-sm hover">
                <i class="fad fa-video fa-5x"></i>
            </div>
            <h3 class="text-center text-info mt-3">
                ویدیوهای آموزشی
            </h3>
        </a>
    </div>
    <div class="col-md-3 col-6 px-lg-4 px-md-4 mb-4" style="max-width: 250px">
        <a href="{{ URL::asset("/course") }}" class="text-decoration-none">

            <div class="btn-dark rounded-circle btn-circle text-info shadow-sm hover">
                <i class="fad fa-graduation-cap fa-5x"></i>
            </div>
            <h3 class="text-center text-info mt-3">
                دوره های آموزشی
            </h3>
        </a>
    </div>
    <div class="col-md-3 col-6 px-lg-4 px-md-4 mb-4" style="max-width: 250px">
        <a href="#" class="text-decoration-none">
            <div class="btn-dark rounded-circle btn-circle text-info shadow-sm hover">
                <i class="fad fa-info fa-5x"></i>
            </div>
            <h3 class="text-center text-info mt-3">
                درباره ما
            </h3>
        </a>
    </div>
    <div class="col-md-3 col-6 px-lg-4 px-md-4 mb-4" style="max-width: 250px">
        <a href="{{ url('/blog') }}" class="text-decoration-none">
            <div class="btn-dark rounded-circle btn-circle text-info shadow-sm hover">
                <i class="fad fa-blog fa-5x"></i>
            </div>
            <h3 class="text-center text-info mt-3">
                بلاگ
            </h3>
        </a>
    </div>
</div>

@endsection