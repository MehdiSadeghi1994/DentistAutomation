<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Course;
use App\Group;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function AllGetForAdmin()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();

        return view('admin.courses', [
            'courses' => $courses,
        ]);
    }

    public function AllGetForClient()
    {
        $courses = Course::select('courses.*')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('created_at', 'desc')->get();

        return view('client.courses', [
            'courses' => $courses,
        ]);
    }

    public function SingleGet($name)
    {
        $name = str_replace('-', ' ', $name);

        $course = Course::where('name', $name)->first();

        if (!$course) {
            return redirect()->back()->with([
                'message' => 'دوره آموزشی پیدا نشد',
            ]);
        }

        $id = $course->id;

        $i3classes = I3class::where('course_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.course', [
            'course' => $course,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        $groups = Group::orderBy('name_en', 'asc')->get();

        return view('admin.course_form', [
            'groups' => $groups,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'explanation' => 'required',
            'description' => 'required|max:256',
        ]);

        $course = new Course();
        $course->name = $request['name'];
        $course->short_explanation = $request['short_explanation'];
        $course->explanation = $request['explanation'];
        $course->headlines = $request['headlines'];
        $course->prerequisites = $request['prerequisites'];
        $course->group_id = $request['group_id'];
        $course->description = $request['description'];
        $course->keywords = $request['keywords'];
        $course->image = $request['image'];
        $course->save();

        return redirect('/admin/course')->with([
            'message' => 'دوره آموزشی افزوده شد',
        ]);
    }

    public function EditGet($topic_id)
    {
        $course = Course::find($topic_id);
        $groups = Group::orderBy('name', 'asc')->get();

        if (!$course) {
            return redirect()->route('admin.course.all.get')->with([
                'message' => 'دوره آموزشی پیدا نشد',
            ]);
        }

        return view('admin.course_form', [
            'course' => $course,
            'groups' => $groups,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'explanation' => 'required',
            'description' => 'required|max:256',
            'keywords' => 'required'
        ]);

        $course = Course::find($request['id']);
        $course->name = $request['name'];
        $course->short_explanation = $request['short_explanation'];
        $course->explanation = $request['explanation'];
        $course->headlines = $request['headlines'];
        $course->prerequisites = $request['prerequisites'];
        $course->group_id = $request['group_id'];
        $course->description = $request['description'];
        $course->keywords = $request['keywords'];
        $course->image = $request['image'];
        $course->update();

        return redirect('/admin/course')->with([
            'message' => 'دوره آموزشی ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'دوره آموزشی پیدا نشد',
            ]);
        }

        $course->delete();

        return redirect()->back()->with([
            'message' => 'دوره آموزشی حذف شد',
        ]);
    }
}
