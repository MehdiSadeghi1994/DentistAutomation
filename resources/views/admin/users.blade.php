@extends('template')

@section('title')
کاربران
@endsection
@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">

            <div class="card-header bg-transparent border-0 pb-0">
                <h3 class="card-title d-inline text-light">
                    کاربران
                </h3>
                <a href="{{ URL::asset("/admin/user/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($users) == 0)
                <h3 class="card-title">دانشجویی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">کد ملی</th>
                                <th scope="col">نام کاربری</th>
                                <th scope="col">شماره همراه</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <img class="img-fluid rounded-circle"
                                        src="{{ URL::asset("/images/user/$user->image") }}">
                                </td>
                                <th class="align-middle">{{$user->name}}</th>
                                <td class="align-middle">{{$user->family}}</td>
                                <td class="align-middle">{{$user->national_code}}</td>
                                <td class="align-middle">{{$user->username}}</td>
                                <td class="align-middle">{{$user->phone_number}}</td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/users/$user->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fas fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$user->id}}" class="btn-outline-danger btn btn-sm">
                                        <span class="fas fa-trash fa-fw"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="card-footer">
                برای افزودن دانشجوی جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/user/delete") }}' + '/' + id);
    })
</script>
@endsection