@extends('template')

@section('title')
آزمون ها
@endsection
@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header bg-transparent border-0 pb-0">
                <h3 class="card-title d-inline text-info">
                    آزمون ها
                </h3>
                <a href="{{ URL::asset("/admin/exams/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($exams) == 0)
                <h3 class="card-title">آزمونی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="50px"></th>
                                <th scope="col">دوره</th>
                                <th scope="col">استاد</th>
                                <th scope="col">کد</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">ساعت</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($exams as $exam)
                            <tr>
                                <td class="align-middle">
                                    <img class="img-fluid rounded" src="{{ URL::asset($exam->course->image) }}">
                                </td>
                                <th class="align-middle">
                                    <a href="{{ URL::asset("/course/" . str_replace(' ', '-', $exam->course->name)) }}"
                                        class="text-light">
                                        {{$exam->course->name}}
                                    </a>
                                </th>
                                <td class="align-middle fit">{{$exam->course->teacher->name}}</td>
                                <td class="align-middle fit">{{$exam->code}}</td>
                                <td class="align-middle">{{$exam->date}}</td>
                                <td class="align-middle">{{$exam->time}}</td>
                                <td class="align-middle fit">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ URL::asset("/admin/i3class/change_state/1/$exam->id") }}"
                                            class="btn btn-outline-success btn-sm {{ $exam->state == '1' ? 'active' : '' }}">
                                            تازه
                                        </a>
                                        <a href="{{ URL::asset("/admin/i3class/change_state/2/$exam->id") }}"
                                            class="btn btn-outline-success btn-sm {{ $exam->state == '2' ? 'active' : '' }}">
                                            برگزاری
                                        </a>
                                        <a href="{{ URL::asset("/admin/i3class/change_state/3/$exam->id") }}"
                                            class="btn btn-outline-success btn-sm {{ $exam->state == '3' ? 'active' : '' }}">
                                            قدیمی
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/stages") }}"
                                        class="btn-outline-info btn btn-sm">
                                        بخش ها
                                        <span class="fas fa-layer-group fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/questions") }}"
                                        class="btn-outline-light btn btn-sm">
                                        پردازش
                                        <span class="far fa-chart-bar fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/exams/$exam->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fas fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$exam->id}}" class="btn-outline-danger btn btn-sm">
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
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $exams->links("pagination::bootstrap-4") }}
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                برای افزودن آزمون جدید <i class="fas fa-plus-square"></i> را بزنید
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