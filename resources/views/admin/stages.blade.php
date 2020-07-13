@extends('template')

@section('title')
بخش ها
@endsection
@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header bg-transparent border-0 pb-0">
                <h3 class="card-title d-inline text-info">
                    بخش ها
                </h3>
                <a href="{{ URL::asset("/admin/exams/$exam->id/stages/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if($exam->stages->count() == 0)
                <h3 class="card-title">بخشی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="50px">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($exam->stages as $index => $stage)
                            <tr>
                                <th class="align-middle text-info" scope="row">
                                    {{$index + 1}}
                                </th>
                                <td class="align-middle">
                                    {{$stage->title}}
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/stages/$stage->id/lesson") }}"
                                        class="btn-outline-light btn btn-sm">
                                        آموزش 
                                        <span class="fas fa-book-open fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/stages/$stage->id/questions") }}"
                                        class="btn-outline-info btn btn-sm">
                                        پرسش ها
                                        <span class="fas fa-question fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/stages/$stage->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fas fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$stage->id}}" class="btn-outline-danger btn btn-sm">
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
                برای افزودن بخش جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/exam/delete") }}' + '/' + id);
    })
</script>
@endsection