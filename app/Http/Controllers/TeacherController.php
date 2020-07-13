<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Teacher;
use App\Degree;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function AllGetForAdmin()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();

        return view('admin.teachers', [
            'teachers' => $teachers,
        ]);
    }

    public function AllGetForClient()
    {
        $teachers = Teacher::where('type', '=', '0')->orderBy('name', 'asc')->get();
        $teacher_assistants = Teacher::where('type', '=', '1')->orderBy('name', 'asc')->get();

        $teachers_all = array(
            array('title' => 'مدرس ها', 'name' => 'teachers', 'value' => $teachers),
            array('title' => 'کمک مدرس ها', 'name' => 'teacher_assistants', 'value' => $teacher_assistants),
        );

        return view('client.teachers', [
            'teachers_all' => $teachers_all,
        ]);
    }

    public function SingleGet($name, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        $i3classes = I3class::where('teacher_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.teacher', [
            'teacher' => $teacher,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        return view('admin.teacher_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
            'description' => 'required',
        ]);

        $teacher = new Teacher();
        $teacher->name = $request['name'];
        $teacher->birth_date = $request['birth_date'];
        $teacher->explanation = $request['explanation'];
        $teacher->phone_number = $request['phone_number'];
        $teacher->email = $request['email'];
        $teacher->password = $request['password'];
        $teacher->linkedin = $request['linkedin'];
        $teacher->description = $request['description'];
        $teacher->keywords = $request['keywords'];
        $teacher->image = $request['image'];
        $teacher->type = $request['type'];
        $teacher->save();

        return redirect('/admin/teacher')->with([
            'message' => 'استاد افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect('/admin/teacher')->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        return view('admin.teacher_form', [
            'teacher' => $teacher,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
            'description' => 'required'
        ]);

        $teacher = Teacher::find($request['id']);

        $teacher->name = $request['name'];
        $teacher->birth_date = $request['birth_date'];
        $teacher->explanation = $request['explanation'];
        $teacher->phone_number = $request['phone_number'];
        $teacher->email = $request['email'];
        $teacher->password = $request['password'];
        $teacher->linkedin = $request['linkedin'];
        $teacher->description = $request['description'];
        $teacher->keywords = $request['keywords'];
        $teacher->image = $request['image'];
        $teacher->type = $request['type'];
        $teacher->update();

        return redirect('/admin/teacher')->with([
            'message' => 'استاد ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $teacher = Teacher::find($topic_id);

        if (!$teacher) {
            return redirect('/admin/teacher')->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        $teacher->delete();

        return redirect()->back()->with([
            'message' => 'استاد حذف شد',
        ]);
    }
}
