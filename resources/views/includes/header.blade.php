<nav class="navbar navbar-expand-md bg-dark navbar-dark position-sticky shadow" dir="ltr" style="top: 0; z-index: 4">

    <a class="navbar-brand mr-auto ml-0 text-white" href="{{ url("/") }}">
        <img src="{{ url("/images/logo.svg") }}" style="height: 30px" alt="Iranian College logo">
        Iranian College
    </a>
    <div class="custom-control custom-switch mx-5 pr-0">
        <input type="checkbox" class="custom-control-input" id="light-dark-switch">
        <label class="custom-control-label" for="light-dark-switch">
            <span class="fad fa-adjust fa-lg text-white"></span>
        </label>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" dir="rtl" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @auth
            <li class="nav-item">
                <button class="btn btn-link text-white" id="btn-toogle-sidebar">
                    <span class="fad fa-bars fa-lg"></span>
                </button>
            </li>
            <li class="nav-item">
                <a class="btn btn-link text-white position-relative" href="{{ URL::asset("/admin/message") }}"
                    data-toggle="tooltip" data-placement="bottom" title="پیام ها">
                    @if($new_messages_count != '۰')
                    <b class="badge badge-pill badge-danger position-absolute" style="top: -5px; right: -10px">
                        {{ $new_messages_count }}
                    </b>
                    @endif
                    <span class="fas fa-envelope fa-lg"></span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link px-2 rounded-lg text-white" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->avatar )
                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle ml-1 avatar" alt="...">
                    @else
                    <span class="fad fa-user text-info ml-1"></span>
                    @endif
                    {{Auth::user()->name }}
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-white" href="/user/profile">
                        <span class="fas fa-user-circle"></span>
                        پروفایل
                    </a>
                    <a class="dropdown-item text-white" href="/logout">
                        <span class="fas fa-sign-out-alt"></span>
                        خروج
                    </a>
                </div>
            </li>
            @endauth

            @guest
            <li class="nav-item">
                <a class="nav-link rounded-lg text-info" href="#" data-toggle="modal" data-target="#loginModal">
                    <span class="fad fa-sign-in-alt fa-lg"></span>
                    ورود
                </a>
            </li>
            @endguest

            <li class="nav-item">
                <a class="nav-link rounded-lg text-white" href="{{ URL::asset('/course') }}">دوره های آموزشی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-lg text-white" href="{{ URL::asset('/contact-us') }}">تماس با ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-lg text-white" href="{{ URL::asset('/about-us') }}">درباره ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-lg text-white" href="{{ URL::asset('/blog') }}">بلاگ</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-dark">
                <h4 class="modal-title">
                    ورود
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url("/signin") }}" id="loginForm">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fad fa-at fa-fw"></i></div>
                        </div>
                        <input name="email" type="email" class="form-control" placeholder="ایمیل" required>
                    </div>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fad fa-lock fa-fw"></i></div>
                        </div>
                        <input name="password" type="password" class="form-control" placeholder="گذرواژه" required>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" name="remember_me" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">
                            مرا به خاطر بسپار
                        </label>
                    </div>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="recaptcha" id="recaptcha" type="hidden">
                    <button type="submit" class="btn btn-info btn-block rounded-lg" form="loginForm">ورود</button>

                </form>
            </div>
            <div class="modal-footer border-dark">
                <div class="w-100">
                    <a class="btn btn-outline-info btn-block rounded-lg" href="{{ URL::asset("/sign-up") }}">
                        ثبت نام
                    </a>

                    <a href="{{ url('/auth/google') }}" class="btn btn-light btn-block rounded-lg">
                        <img src="{{ url('images/logo/google.svg') }}" class="img-fluid ml-1" style="height: 20px">
                        ورود با حساب گوگل
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>