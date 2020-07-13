@extends('template')

@section('title')
دوره های تخصصی
@endsection
@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
<div class="card-header bg-transparent border-0">
    <h3 class="card-title d-inline text-info">
        دوره های تخصصی
    </h3>
    <a href="{{ URL::asset("/admin/courses/add") }}" class="btn btn-success float-left">
        <span class="fas fa-plus"></span>
    </a>
</div>
<div class="card-body">
    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
    <br>
    @if(count($courses) == 0)
    <h3 class="card-title">دوره ای وجود ندارد</h3>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-dark table-hover small">
            <thead>
                <tr>
                    <th scope="col" width="100px"></th>
                    <th scope="col">نام</th>
                    <th scope="col">توضیح کوتاه</th>
                    <th scope="col">گروه</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($courses as $course)
                <tr>
                    <td>
                        <img class="img-fluid rounded" src="{{ URL::asset("$course->image") }}">
                    </td>
                    <th class="align-middle">
                        <a href="{{ URL::asset("/course/" . str_replace(' ', '-', $course->name)) }}"
                            class="text-info">
                            {{$course->name}}
                        </a>
                    </th>
                    <td class="align-middle">{{$course->short_explanation}}</td>
                    <td class="align-middle">{{$course->group->name_fa}}</td>

                    <td class="align-middle text-left">
                        <a href="{{ URL::asset("/admin/course/edit/$course->id") }}"
                            class="btn-outline-info btn btn-sm">
                            <span class="fas fa-pen fa-fw"></span>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#deleteModal" data-id="{{$course->id}}"
                            class="btn-outline-danger btn btn-sm">
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
<div class="card-footer text-muted">
    برای افزودن دوره جدید <i class="fas fa-plus-square"></i> را بزنید
</div>
</div>
</div>
</div>


<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/course/delete") }}' + '/' + id);
    })
</script>
@endsection