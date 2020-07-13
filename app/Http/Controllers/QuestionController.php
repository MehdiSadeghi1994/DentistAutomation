<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Exam;
use App\Stage;
use App\Question;
use App\Answer;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function GetAllByStage($exam_id, $stage_id)
    {
		$stage = Stage::find($stage_id);
		$exam = Exam::find($exam_id);

        return view('admin.questions', [
            'stage' => $stage,
            'exam' => $exam,
        ]);
    }

    public function AllGetForClient()
    {
        $exams = Exam::orderBy('created_at', 'desc')->get();

        foreach ($exams as $exam) {

            $exam->salary = tr_num($exam->salary, 'fa');
        }

        return view('client.exams', [
            'exams' => $exams,
        ]);
	}
	
    public function Start($exam_id, $question_id)
	{
		$exam = Exam::find($id);

		if(!$exam)
		{
			return redirect()->back()->with([
				'message' => 'آزمون پیدا نشد',
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
		$stage = Stage::find($stage_id);
		$exam = Exam::find($exam_id);
		return view('admin.question_form', [
			'exam' => $exam,
			'stage' => $stage,
		]);
	}

	public function AddPost(Request $request, $exam_id, $stage_id)
	{
		$this->validate($request,[
			'question' => 'required',
		]);

		$question = new Question();
		$question->text = $request['question'];
		$question->stage_id = $stage_id;
		$question->save();

		foreach ($request['answers'] as $key => $answer_text) {
			$answer = new Answer();
			$answer->text = $answer_text;
			$answer->question_id = $question->id;
			$answer->is_correct = $request['is_correct'] == $key + 1 ? 1 : 0;
			$answer->save();
		}

		return redirect("/admin/exams/$exam_id/stages/$stage->id/questions")->with([
			'message' => 'آزمون افزوده شد',
		]);
	}

	public function EditGet($exam_id, $stage_id, $question_id)
	{
		$question = Question::find($question_id);
		$stage = Stage::find($stage_id);
		$exam = Question::find($exam_id);

        if (!$question) {
			return redirect()->route('admin.exam.all.get')->with([
				'message' => 'سوال پیدا نشد',
			]);
		}

		return view('admin.question_form', [
			'question' => $question,
			'stage' => $stage,
			'exam' => $exam,
		]);
	}

	public function EditPost(Request $request, $exam_id, $stage_id, $question_id)
	{
        $this->validate($request,[
            'question' => 'required',
        ]);

		$question = Question::find($question_id);
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

		return redirect("/admin/exams/$exam_id/stages/$stage_id/questions")->with([
			'message' => 'پرسش ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$exam = Exam::find($id);

		if (!$exam) {
			return redirect()->route('admin.blog.topics.get')->with([
				'message' => 'آزمون پیدا نشد',
			]);
		}

		$exam->delete();

		return redirect()->back()->with([
			'message' => 'آزمون حذف شد',
		]);
	}
}