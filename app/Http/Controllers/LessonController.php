<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Exam;
use App\Stage;
use App\Lesson;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{
    public function GetByStageForAdmin($exam_id, $stage_id)
    {
        $exam = Exam::find($exam_id);
        $stage = Stage::find($stage_id);
		return view('admin.lesson', [
            'exam' => $exam,
            'stage' => $stage,
        ]);
    }
	
	public function GetByStageForClient($exam_id, $stage_number)
	{
		$exam = Exam::find($exam_id);
		$lesson = $exam->stages[$stage_number - 1]->lesson;
		return view("user.lesson")->with([
			'exam' => $exam,
			'lesson' => $lesson,
			'stage_number' => $stage_number,
		]);
	}
	
    public function Start($exam_id, $question_id)
	{
		$exam = Exam::find($id);

		if(!$exam)
		{
			return redirect()->back()->with([
				'message' => 'بخش پیدا نشد',
			]);
		}

        $new_exams = Exam::where('id', '!=', $exam->id)->orderBy('created_at', 'desc')->take(3)->get();

        return view('client.exam', [
			'exam' => $exam,
			'new_exams' => $new_exams,
		]);
	}

	public function AddGet($exam_id, $stage_id)
	{
		$exam = Exam::find($exam_id);
        $stage = Stage::find($stage_id);
		return view('admin.lesson_form', [
			'exam' => $exam,
            'stage' => $stage,
		]);
	}

	public function AddPost(Request $request, $exam_id, $stage_id)
	{
		$this->validate($request,[
			'text' => 'required',
		]);

		$lesson = new Lesson();
		$lesson->text = $request['text'];
		$lesson->stage_id = $stage_id;
		$lesson->save();

		return redirect("/admin/exams/$exam_id/stages/$stage_id/lesson")->with([
			'message' => 'آموزش افزوده شد',
		]);
	}

	public function EditGet($exam_id, $question_id)
	{
		$question = Stage::find($question_id);
		$exam = Stage::find($exam_id);

        if (!$question) {
			return redirect()->route('admin.exam.all.get')->with([
				'message' => 'سوال پیدا نشد',
			]);
		}

		return view('admin.question_form', [
			'question' => $question,
			'exam' => $exam,
		]);
	}

	public function EditPost(Request $request, $exam_id, $question_id)
	{
        $this->validate($request,[
            'question' => 'required',
        ]);

		$question = Stage::find($question_id);
		$question->text = $request['question'];
		$question->update();

		foreach ($question->answers as $answer) {
			$answer->delete();
		}

		foreach ($request['answers'] as $key => $answer_text) {
			$answer = new Answer();
			$answer->text = $answer_text;
			$answer->question_id = $question->id;
			$answer->is_correct = $request['is_correct'] == $key + 1 ? 1 : 0;
			$answer->save();
		}

		return redirect("/admin/exams/$exam_id/questions")->with([
			'message' => 'پرسش ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$exam = Exam::find($id);

		if (!$exam) {
			return redirect()->route('admin.blog.topics.get')->with([
				'message' => 'بخش پیدا نشد',
			]);
		}

		$exam->delete();

		return redirect()->back()->with([
			'message' => 'بخش حذف شد',
		]);
	}
}