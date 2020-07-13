<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Exam;
use App\Course;
use App\Answer;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    public function AllGetForAdmin()
    {
        $exams = Exam::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.exams', [
            'exams' => $exams,
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

    public function SingleGet($id)
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

	public function AddGet()
	{
		$courses = Course::orderBy('name','asc')->get();

		return view('admin.exam_form', [
			'courses' => $courses,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'code' => 'required'
		]);

		$exam = new Exam();
		$exam->code = $request['code'];
		$exam->course_id = $request['course_id'];
		$exam->date = $request['date'];
		$exam->time = $request['time'];
		$exam->details = $request['details'];
		$exam->save();

		return redirect('/admin/exams')->with([
			'message' => 'آزمون افزوده شد',
		]);
	}

	public function EditGet($id)
	{
		$exam = Exam::find($id);
        $courses = Course::orderBy('name','asc')->get();

        if (!$exam) {
			return redirect()->route('admin.exam.all.get')->with([
				'message' => 'آزمون پیدا نشد',
			]);
		}

		return view('admin.exam_form', [
			'exam' => $exam,
            'courses' => $courses,
		]);
	}

	public function EditPost(Request $request)
	{
        $this->validate($request,[
			'code' => 'required'
        ]);

		$exam = Exam::find($request['id']);
		$exam->code = $request['code'];
		$exam->course_id = $request['course_id'];
		$exam->date = $request['date'];
		$exam->time = $request['time'];
		$exam->details = $request['details'];
		$exam->update();

		return redirect('/admin/exams')->with([
			'message' => 'آزمون ویرایش شد',
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

	function Start($exam_id)
    {
        Session::put('question_number', 1);
        return redirect("/user/exams/$exam_id/stages");
    }

    function QuestionGet($exam_id, $stage_number)
    {
        if(!Session::has('question_number'))
        {
            return back();
        }

        $question_number = Session::get('question_number');

        $exam = Exam::find($exam_id);
		$stage = $exam->stages[$stage_number - 1];
		
		if($stage->questions->count() > 0)
		{
			$question = $stage->questions[$question_number - 1];
	
			return view('user.question',[
				'exam' => $exam,
				'stage' => $stage,
				'stage_number' => $stage_number,
				'question' => $question
			]);
		}
		else
		{
			return redirect("/user/exams/$exam_id/stages");
		}
    }

    function QuestionPost(Request $request, $exam_id, $stage_number)
    {
        if(Session::has('question_number'))
        {
            Session::put('question_number', Session::get('question_number') + 1);
        }
        else
        {
            return back();
        }

		$answer = Answer::find($request['answer']);

		Auth::user()->answers()->attach($answer);

        $exam = Exam::find($exam_id);
		
        if(Session::get('question_number') > $exam->stages[$stage_number - 1]->questions->count())
        {
			$last_exam_stage_number = Auth::user()->exams->find($exam->id)->pivot->stage_number;

			if($last_exam_stage_number == $stage_number)
			{
				Auth::user()->exams()->updateExistingPivot($exam->id, ['stage_number' => $last_exam_stage_number + 1]);
			}
			return redirect("/user/exams/$exam_id/stages/");
        }
        else
        {
            return redirect("/user/exams/$exam_id/stages/$stage_number/question");
        }
    }
}
