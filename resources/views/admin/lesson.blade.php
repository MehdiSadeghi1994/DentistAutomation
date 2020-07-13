@extends('template')

@section('title')
آموزش
@endsection
@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-info">
                    آموزش
                </h3>
                <a href="{{ URL::asset("/admin/exams/$exam->id/stages/$stage->id/lesson/add") }}"
                    class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                
                @if($stage->lesson)
                
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover small">
                        <thead>
                            <tr>
                                <th scope="col">متن</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <tr>
                                <td class="align-middle w-75">
                                    {!! $stage->lesson->text !!}
                                </td>
                                <td class="align-middle">

                                    <a href="{{ URL::asset("/admin/exams/$exam->id/stages/$stage->id/lesson/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fa fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$stage->id}}" class="btn-outline-danger btn btn-sm">
                                        <span class="fa fa-trash fa-fw"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @else
                <h3 class="card-title">پرسشی وجود ندارد</h3>
                @endif
            </div>
            <div class="card-footer text-muted">
                برای افزودن آموزش جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/quesion/delete") }}' + '/' + id);
    })
</script>
@endsection