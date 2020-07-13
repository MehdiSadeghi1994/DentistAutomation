<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Exam;
use App\Question;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function AllGet($exam_id, $question_id)
    {
		$exam = Exam::find($exam_id);
		$question = Question::find($question_id);

        return view('admin.answers', [
            'exam' => $exam,
            'question' => $question,
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
		$groups = Group::orderBy('name','asc')->get();

		return view('admin.exam_form', [
			'groups' => $groups,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:120',
			'explanation' => 'required',
		]);

		$exam = new Exam();
		$exam->title = $request['title'];
		$exam->explanation = $request['explanation'];
		$exam->company_name_en = $request['company_name_en'];
		$exam->company_name_fa = $request['company_name_fa'];
		$exam->location = $request['location'];
		$exam->image = $request['image'];
		$exam->save();

		return redirect('/admin/exam')->with([
			'message' => 'آزمون افزوده شد',
		]);
	}

	public function EditGet($id)
	{
		$exam = Exam::find($id);
        $groups = Group::orderBy('name','asc')->get();

        if (!$exam) {
			return redirect()->route('admin.exam.all.get')->with([
				'message' => 'آزمون پیدا نشد',
			]);
		}

		return view('admin.exam_form', [
			'exam' => $exam,
            'groups' => $groups,
		]);
	}

	public function EditPost(Request $request)
	{
        $this->validate($request,[
            'title' => 'required|max:120',
            'explanation' => 'required',
        ]);

		$exam = Exam::find($request['id']);
        $exam->title = $request['title'];
        $exam->explanation = $request['explanation'];
        $exam->group_id = $request['group_id'];
        $exam->company_name_en = $request['company_name_en'];
        $exam->company_name_fa = $request['company_name_fa'];
        $exam->salary = $request['salary'];
        $exam->location = $request['location'];
        $exam->image = $request['image'];
        $exam->work_time = $request['work_time'];
		$exam->update();

		return redirect('/admin/exam')->with([
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
}
