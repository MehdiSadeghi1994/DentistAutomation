<!doctype html>
<html>

<head>
    <title>
        Iranian College |
        @yield('title')
    </title>

    @yield('style')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="application-name" content="iraniancollege">
    <meta name="author" content="Sajjad Aemmi, Hadiseh Firouzabadi, Emad Aemi">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:url" content="@yield('url')" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="iraniancollege" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ url('/images/logo.png') }}" />
    <meta name="robots" content="index, follow" />

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/images/logo.png') }}">
    <meta name="theme-color" content="#17a2b8">
    <meta name="msapplication-navbutton-color" content="#17a2b8">
    <meta name="apple-mobile-web-app-status-bar-style" content="#17a2b8">

    <link rel="apple-touch-icon" href="{{ url('/images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ url('/images/logo.png') }}" />
    <link rel="icon" href="{{ url('/images/favicon.ico') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ url('/images/favicon.ico') }}' />

    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery.md.bootstrap.datetimepicker.style.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/imageresize.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery.gScrollingCarousel.css') }}">

    <script src="{{ url('/js/jquery-3.4.1.js') }}"></script>
    {{-- <script src="{{ url('/js/jquery-ui.js') }}"></script> --}}
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.js') }}"></script>
    <script src="{{ url('/js/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ url('/js/jquery.gScrollingCarousel.js') }}"></script>

    <script src="{{ url('/js/ckeditor.js') }}"></script>
    @include('ckfinder::setup')

</head>

<body class="bg-black">
    <div class="row">
        @auth
        <aside class="p-0" id="sidebar">
            @include('includes.sidebar')
        </aside>
        @endauth
        <main class="col p-0">
            @include('includes.header')
            <div class="container-fluid mt-4" style="margin-bottom: 54px;">
                @if(Session::has('message'))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                            {{Session::get('message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($errors) > 0)
                <div class="row">
                    <div class="col-md-12">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- breadcrumb -->
                @if(!Request::is('/'))
                <div class="row mb-4">
                    <div class="col">
                        <nav aria-label="breadcrumb" dir="ltr">
                            <ol class="breadcrumb small bg-dark mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{URL::asset('/')}}" class="text-white text-decoration-none">
                                        Iranian College
                                    </a>
                                </li>
                                <?php $segments = ''; ?>
                                @foreach(Request::segments() as $segment)
                                <?php $segments .= '/' . $segment; ?>
                                <li class="breadcrumb-item">
                                    <a href="{{ url($segments) }}" class="text-white text-decoration-none">
                                        {{ str_replace('-', ' ', $segment) }}
                                    </a>
                                </li>
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                </div>
                @endif
                @yield('content')
            </div>
            @include('includes.footer')
        </main>
    </div>
    <script src="{{ url('js/script.js') }}"></script>

    <script type="text/javascript">
        $('#date').MdPersianDateTimePicker({
            targetTextSelector: '#inputDate',
            dateFormat: 'yyyy-MM-dd',
        });
    </script>
    <script>
        function init_ckeditor(element) {

            ClassicEditor.create(element, {
                    ckfinder: {
                        uploadUrl: '{{-- route('
                        ckfinder_connector ') --}}?command=QuickUpload&type=Images&responseType=json',
                        options: {
                            resourceType: 'Images'
                        }
                        // Open the file manager in the pop-up window.
                        // openerMethod: 'popup'
                    },

                    mediaEmbed: {
                        previewsInData: true,
                        extraProviders: [{
                            name: 'aparat',
                            url: [/^(?:m\.)?aparat\.com\/watch\?v=([\w-]+)/,
                                /^(?:m\.)?aparat\.com\/v\/([\w-]+)/,
                                /^aparat\.com\/embed\/([\w-]+)/
                            ],

                            html: t => {
                                return '<div style="position: relative; height: 0; padding-bottom: 56.2493%;">' +
                                    `<iframe src="https://www.aparat.com/video/video/embed/videohash/${t[1]}/vt/frame" ` +
                                    'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>'
                            }
                        }],
                    }
                })
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error(error.stack);
                });
        }

        $(document).ready(function () {

            var allEditors = document.querySelectorAll('textarea');
            for (var i = 0; i < allEditors.length; i++) {
                init_ckeditor(allEditors[i]);
            }
        });
    </script>
</body>

</html>