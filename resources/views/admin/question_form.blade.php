@extends('template')

@section('title')
{{ isset($question) ? 'ویرایش پرسش' : 'پرسش تازه' }}
@endsection

@section('content')
<div class="row pb-4">
    <div class="col">
        <div class="card shadow rounded-lg border-0 bg-dark">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-info">
                    {{ isset($question) ? 'ویرایش پرسش' : 'پرسش تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post"
                    action="{{ URL::asset("/admin/exams/$exam->id/stages/$stage->id/questions") }}/{{ isset($question) ? "$question->id/edit" : 'add' }}"
                    id="form">
                    <div class="form-group">
                        <label class="text-white">
                            متن پرسش
                        </label>
                        <textarea name="question" id="editor"
                            class="form-control">{{Request::old('question') ? Request::old('question') : (isset($question) ? $question->text : '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-white">تعداد گزینه ها</label>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success" id="btn-add-answer">
                                <span class="fas fa-plus"></span>
                            </button>
                            <button type="button" class="btn btn-white" id="count-answers">
                                {{ isset($question) ? $question->answers->count() : 4 }}
                            </button>
                            <button type="button" class="btn btn-danger" id="btn-remove-answer">
                                <span class="fas fa-minus"></span>
                            </button>
                        </div>
                    </div>
                    <div class="form-row" id="answers">
                        @for($i = 1; $i <= (isset($question) ? $question->answers->count() : 4); $i++)
                            <div class="form-group col-md-6 answer">
                                <label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Radio{{ $i }}" name="is_correct"
                                            class="custom-control-input" value="{{ $i }}"
                                            {{ isset($question) && $question->answers[$i - 1]->is_correct == 1 ? "checked" : "" }}>
                                        <label class="custom-control-label text-white" for="Radio{{ $i }}">گزینه
                                            {{ $i }}</label>
                                    </div>
                                </label>
                                <textarea name="answers[]" id="editor"
                                    class="form-control">{{Request::old('answer[]') ? Request::old('answers[]') : (isset($question) ? $question->answers[$i - 1]->text : '') }}</textarea>
                            </div>
                            @endfor
                    </div>
                    <div class="form-group mb-0">
                        <label class="text-white">جزییات</label>
                        <input name="details" type="text" placeholder="Details"
                            class="form-control {{$errors->has('details') ? 'is-invalid' : ''}}"
                            value="{{Request::old('details') ? Request::old('details') : (isset($question) ? $question->details : '') }}">
                    </div>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#btn-add-answer').click(function () {
            var count_answers = parseInt($("#count-answers").html());
            count_answers++;
            $("#count-answers").html(count_answers);

            var answer = $(
                '<div class="form-group col-md-6 answer"><label><div class="custom-control custom-radio"><input type="radio" name="is_correct" class="custom-control-input"><label class="custom-control-label text-white"></label></div></label><textarea name="answers[]" id="editor" class="form-control"></textarea></div>'
                );
            answer.find(".custom-control-input").attr("id", "Radio" + count_answers);
            answer.find(".custom-control-input").attr("value", count_answers);
            answer.find(".custom-control-label").attr("for", "Radio" + count_answers);
            answer.find(".custom-control-label").html("گزینه " + count_answers);
            answer.attr("id", "answer" + count_answers);

            $("#answers").append(answer);

            init_ckeditor($("#answer" + count_answers).find("textarea")[0]);
        })

        $('#btn-remove-answer').click(function () {
            var count_answers = parseInt($("#count-answers").html());

            if (count_answers > 2) {
                count_answers--;
                $("#count-answers").html(count_answers);
                $("#answers").children().last().remove();
            }
        })
    })
</script>

@endsection