@extends('admin.admin-template')

@section('title')
    دوره ها
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark pb-4" style="box-shadow: 5px 5px 15px black">
        <ul class="list-group">
            <li class="list-group-item border-0 bg-transparent text-center text-dark">
                <div class="col-12 text-light px-0">
                    <h4 class="text-gold d-inline-block border-gold border-left border-right px-3">لیست ویدئو های سایت</h4>
                    <a class="btn btn-outline-gold btn-sm float-left text-decoration-none rounded-lg px-1"
                       href="/admin/add_video">افزودن ویدئو</a>
                </div>

            </li>
            @foreach($videos as $video)

                <li class="list-group-item bg-transparent border-gold border-top-0 border-left-0 border-right-0 text-light">{{ $video->title }}
                    <a href="/admin/edit_video/{{ $video->id }}" class="btn btn-outline-gold float-left btn-sm">
                        <span class="fas fa-pen fa-fw float-left"></span>
                    </a>
                    <button type="button" class="btn btn-outline-gold float-left btn-sm mx-1" data-toggle="modal"
                            data-target="#exampleModal" data-id="{{ $video->id }}">
                        <span class="fas fa-times float-left fa-fw"></span>
                    </button>
                </li>

            @endforeach
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-dark">
                            آیا از حذف اطمینان دارید؟
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                            <a href="#" class="btn btn-danger" id="btn-delete">بله حذف شود</a>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
    <script>
        $(document).ready(function () {
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                var btn_delete = $(this).find('.modal-footer #btn-delete');
                btn_delete.attr("href", '/admin/delete_video/' + id);
            })
        })
    </script>
@endsection
