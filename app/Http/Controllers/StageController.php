<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Exam;
use App\Stage;
use App\Answer;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StageController extends Controller
{
    public function GetAllByExamForAdmin($exam_id)
    {
        $exam = Exam::find($exam_id);
        return view('admin.stages', [
            'exam' => $exam,
        ]);
    }

	public function GetAllByExamForClient($exam_id)
    {
        $exam = Exam::find($exam_id);
        return view('user.stages', [
            'exam' => $exam,
        ]);
	}
	
	public function GetByNumberForClient($exam_id, $stage_number)
	{
		Session::put('question_number', 1);
		$exam = Exam::find($exam_id);

        $stage = $exam->stages[$stage_number - 1];

		if($stage->lesson)
		{
			return redirect("/user/exams/$exam_id/stages/$stage_number/lesson");
		}
		else if($stage->questions->count() > 0)
		{
			return redirect("/user/exams/$exam_id/stages/$stage_number/question");
		}
		else
		{
			return back();
		}
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

	public function AddGet($exam_id)
	{
		$exam = Exam::find($exam_id);
		return view('admin.stage_form', [
			'exam' => $exam
		]);
	}

	public function AddPost(Request $request, $exam_id)
	{
		$this->validate($request,[
			'title' => 'required',
		]);

		$stage = new Stage();
		$stage->title = $request['title'];
		$stage->exam_id = $exam_id;
		$stage->save();

		return redirect("/admin/exams/$exam_id/stages")->with([
			'message' => 'بخش افزوده شد',
		]);
	}

	public function EditGet($exam_id, $stage_id)
	{
		$stage = Stage::find($stage_id);
		$exam = Exam::find($exam_id);

        if (!$stage) {
			return back()->with([
				'message' => 'بخش پیدا نشد',
			]);
		}

		return view('admin.stage_form', [
			'stage' => $stage,
			'exam' => $exam,
		]);
	}

	public function EditPost(Request $request, $exam_id, $stage_id)
	{
        $this->validate($request,[
            'title' => 'required',
        ]);

		$stage = Stage::find($stage_id);
		$stage->title = $request['title'];
		$stage->update();

		return redirect("/admin/exams/$exam_id/stages")->with([
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