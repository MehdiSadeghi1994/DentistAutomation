<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Topic;
use App\Student;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class StudentController extends Controller
{
	public function SingleGet($student_id, $access = 'client')
	{
		$student = Student::find($student_id);

		if(!$student)
		{
			return redirect()->route($access . 'students.get')->with([
				'message' => 'دوره آموزشی پیدا نشد',
			]);
		}

		return view($access . '.student', [
			'student' => $student,
		]);
	}

	public function AllGet()
	{
		$students = Student::orderBy('created_at','desc')->paginate(5);

		return view('admin.students', [
			'students' => $students,
		]);
	}

	public function AddGet()
	{
		return view('admin.student_form');
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120',
			'family' => 'required|max:120',
			'father_name' => 'required|max:120',
			'national_code' => 'required|max:120',
			'birth_date' => 'required|max:120',
			'email' => 'required|email|max:120',
			'phone_number' => 'required|max:120',
			'home_number' => 'max:120',
			'address' => 'required|max:120',
			'password' => 'required|max:80',
		]);

		$student = new Student();
		$student->name = $request['name'];
		$student->family = $request['family'];
		$student->father_name = $request['father_name'];
		$student->national_code = $request['national_code'];
		$student->birth_date = $request['birth_date'];
		$student->email = $request['email'];
		$student->phone_number = $request['phone_number'];
		$student->home_number = $request['home_number'];
		$student->address = $request['address'];
		$student->password = $request['password'];
		$student->image = $request['image'];
		$student->save();

		return redirect('admin/student')->with([
			'message' => 'دانشجو افزوده شد',
		]);
	}

	public function EditGet($id)
	{
		$student = Student::find($id);

		if (!$student) {
            return redirect('admin/student')->with([
				'message' => 'دانشجو پیدا نشد',
			]);
		}

		return view('admin.student_form', [
			'student' => $student,
		]);
	}

	public function EditPost(Request $request)
	{
        $this->validate($request,[
            'name' => 'required|max:120',
            'family' => 'required|max:120',
            'father_name' => 'required|max:120',
            'national_code' => 'required|max:120',
            'birth_date' => 'required|max:120',
            'email' => 'required|email|max:120',
            'phone_number' => 'required|max:120',
            'home_number' => 'max:120',
            'address' => 'required|max:120',
            'password' => 'required|max:80',
        ]);

        $student = Student::find($request['id']);
        $student->name = $request['name'];
        $student->family = $request['family'];
        $student->father_name = $request['father_name'];
        $student->national_code = $request['national_code'];
        $student->birth_date = $request['birth_date'];
        $student->email = $request['email'];
        $student->phone_number = $request['phone_number'];
        $student->home_number = $request['home_number'];
        $student->address = $request['address'];
        $student->password = $request['password'];
        $student->image = $request['image'];
        $student->update();

        return redirect('admin/student')->with([
			'message' => 'دانشجو ویرایش شد',
		]);
	}

	public function DeleteGet($topic_id)
	{
		$topic = Topic::find($topic_id);

		if (!$topic) {
            return redirect('admin/student')->with([
				'message' => 'دانشجو پیدا نشد',
			]);
		}

		$topic->delete();

		return redirect()->back()->with([
			'message' => 'دانشجو با موفقیت حذف گردید',
		]);
	}
}
