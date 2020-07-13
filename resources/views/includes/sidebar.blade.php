<div class="p-3 bg-dark position-fixed h-100">

    @auth
    <div class="row text-center bg-dark text-white border-0">
        <div class="col">
            @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" class="img-fluid rounded-circle w-50" alt="...">
            @else
            <span class="fad fa-user fa-5x text-info"></span>
            @endif
            <h4 class="card-title my-3">
                {{Auth::user()->name}}
            </h4>
        </div>
    </div>
    <hr>
    <div class="list-group">
        @foreach(Auth::user()->menus as $menu)
        <a href="{{ url("$menu->url") }}" class="list-group-item bg-dark text-white border-0 rounded-lg">
            <span class="fad fa-{{ $menu->icon }} fa-fw ml-2 text-info"></span>
            {{ $menu->title }}
        </a>
        @endforeach
    </div>
    @endauth
</div>