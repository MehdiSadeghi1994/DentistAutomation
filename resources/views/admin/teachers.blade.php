@extends('template')

@section('title')
اساتید
@endsection
@section('content')
<div class="card-header bg-transparent border-0">
    <h3 class="card-title d-inline text-danger">
        اساتید
    </h3>
    <a href="{{ URL::asset("/admin/teacher/add") }}" class="btn btn-success float-left">
        <span class="fas fa-plus"></span>
    </a>
</div>
<div class="card-body">
    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
    <br>
    @if(count($teachers) == 0)
    <h3 class="card-title">دوره ای وجود ندارد</h3>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-dark table-hover small">
            <thead>
                <tr>
                    <th scope="col" width="10%"></th>
                    <th scope="col">نام</th>
                    <th scope="col">تاریخ تولد</th>
                    <th scope="col">شماره همراه</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($teachers as $teacher)
                <tr>
                    <td>
                        <img class="img-fluid rounded-circle" src="{{ URL::asset("$teacher->image") }}">
                    </td>
                    <th class="align-middle" scope="row">
                        <a href="{{ URL::asset("/teacher/" . str_replace(' ', '-', $teacher->name) . "/" . $teacher->id) }}"
                            class="text-danger">
                            {{$teacher->name}}
                        </a>
                    </th>
                    <th class="align-middle">{{$teacher->birth_date}}</th>
                    <td class="align-middle">{{$teacher->phone_number}}</td>
                    <td class="align-middle">{{$teacher->email}}</td>
                    <td class="align-middle fit">
                        <a href="{{ URL::asset("/admin/teacher/edit/$teacher->id") }}"
                            class="btn-outline-info btn btn-sm">
                            <span class="fa fa-pen fa-fw"></span>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#deleteModal" data-id="{{$teacher->id}}"
                            class="btn-outline-danger btn btn-sm">
                            <span class="fa fa-trash fa-fw"></span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
<div class="card-footer text-muted">
    برای افزودن استاد جدید <i class="fas fa-plus-square"></i> را بزنید
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/teacher/delete") }}' + '/' + id);
    })
</script>
@endsection