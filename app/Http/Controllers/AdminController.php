<?php

namespace App\Http\Controllers;

use App\Video;
use App\Course;
use App\Level;
use App\Teacher;
use App\User;
use App\Education;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function getLogin()
    {
        return view('admin.login');
    }

    function login(Request $data)
    {
        $this->validate($data , [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $data['email'] , 'password' => $data['password'] , 'role' => 1]))
        {
            return redirect()->back();
        }
        else{
            return redirect('/admin');
        }
    }

    function addAdmin(Request $data)
    {
        $this->validate($data, [
            'email' => 'required|unique:admins',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $admin = new Admin();
        $admin->email = $data['email'];
        $admin->password = bcrypt($data['password']);
        $admin->save();
        return view('admin.login');
    }

    function Index()
    {
        return view('admin.index');
    }

    function getAddAdmin()
    {
        return view('admin.add-admin');
    }



    function courses()
    {
        $courses = Course::all();
        return view('admin.courses' , ['courses' => $courses]);
    }

    function getAdd_course()
    {
        $teachers = Teacher::all();
        $categories = Category::all();
        $levels = Level::all();
        return view('admin.add-course' ,['teachers' => $teachers , 'categories' => $categories , 'levels' => $levels]);
    }

    function add_course(Request $data)
    {
        $this->validate($data, [
            'title' => 'required',
            'teacher' => 'required',
            'level' => 'required',
            'category' => 'required',
            'announcement' => 'required',
            'headlines' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'filepath' => 'required',
        ]);

        $course = new Course();
        $course->title = $data['title'];
        $course->teacher_id = $data['teacher'];
        $course->level_id = $data['level'];
        $course->category_id = $data['category'];
        $course->announcement = $data['announcement'];
        $course->headlines = $data['headlines'];
        $course->description = $data['description'];
        $course->keywords = $data['keywords'];
        $course->avatar_address = $data['filepath'];
        $course->save();
        return redirect('/admin/courses');
    }

    function edit_course($course_id)
    {
        $teachers = Teacher::all();
        $categories = Category::all();
        $levels = Level::all();
        $course = Course::find($course_id);
        return view('admin.add-course' , ['course' => $course , 'teachers' => $teachers , 'categories' => $categories , 'levels' => $levels]);
    }

    function course_edited(Request $data)
    {
        $this->validate($data, [
            'title' => 'required',
            'teacher' => 'required',
            'level' => 'required',
            'category' => 'required',
            'announcement' => 'required',
            'headlines' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'filepath' => 'required',
        ]);

        $course = Course::find($data['course_id']);
        $course->title = $data['title'];
        $course->teacher_id = $data['teacher'];
        $course->level_id = $data['level'];
        $course->category_id = $data['category'];
        $course->announcement = $data['announcement'];
        $course->headlines = $data['headlines'];
        $course->description = $data['description'];
        $course->keywords = $data['keywords'];
        $course->avatar_address = $data['filepath'];
        $course->update();
        return redirect('/admin/courses');
    }

    function delete_course($course_id)
    {
        $course = Course::find($course_id);
        $course->delete();
        return redirect('admin/courses');
    }



    function teachers()
    {
        $teachers = Teacher::all();
        return view('admin.teachers' , ['teachers' => $teachers]);
    }

    function getAdd_teacher()
    {
        $educations = Education::all();
        return view('admin.add-teacher' , ['educations' => $educations]);
    }

    function add_teacher(Request $data)
    {
        $this->validate($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'education' => 'required',
            'university' => 'required',
            'about' => 'required',
            'filepath' => 'required',
        ]);

        $teacher = new Teacher();
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->email_address = $data['email_address'];
        $teacher->phone_number = $data['phone_number'];
        $teacher->education_id = $data['education'];
        $teacher->university = $data['university'];
        $teacher->about = $data['about'];
        $teacher->avatar_address = $data['filepath'];
        $teacher->save();
        return redirect('/admin/teachers');
    }

    function edit_teacher($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        $educations = Education::all();
        return view('admin.add-teacher' , ['teacher' => $teacher , 'educations' => $educations]);
    }

    function teacher_edited(Request $data)
    {
        $this->validate($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'education' => 'required',
            'university' => 'required',
            'about' => 'required',
            'filepath' => 'required',
        ]);

        $teacher = Teacher::find($data['teacher_id']);
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->email_address = $data['email_address'];
        $teacher->phone_number = $data['phone_number'];
        $teacher->education_id = $data['education'];
        $teacher->university = $data['university'];
        $teacher->about = $data['about'];
        $teacher->avatar_address = $data['filepath'];
        $teacher->update();
        return redirect('/admin/teachers');
    }

    function delete_teacher($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        $teacher->delete();
        return redirect('admin/teachers');
    }



    function categories()
    {
        $categories = Category::all();
        return view('admin.categories' , ['categories' => $categories]);
    }

    function add_category(Request $data)
    {
        $this->validate($data, [
            'category' => 'required',
        ]);

        $category = new Category();
        $category->name = $data['category'];
        $category->save();
        return redirect('/admin/categories');
    }

    function videos()
    {
        $videos = Video::all();
        return view('admin.videos' , ['videos' => $videos]);
    }

    function getAdd_video()
    {
        $courses = Course::orderBy('created_at')->get();
        return view('admin.add-video' , [ 'courses' => $courses]);
    }

    function add_video(Request $data)
    {
        $this->validate($data, [
            'filepath' => 'required',
            'course_id' => 'required',
        ]);

        $video = new Video();
        $video->video_address = $data['filepath'];
        $video->title = $data['title'];
        $video->course_id = $data['course_id'];
        $video->price = $data['price'] ? $data['price'] : 0;
        $video->save();
        return redirect('/admin/videos');
    }

    function edit_video($video_id)
    {
        $video = Video::find($video_id);
        $courses = Course::orderBy('created_at')->get();
        return view('admin.add-video' , ['video' => $video , 'courses' => $courses]);
    }

    function video_edited(Request $data)
    {
        $this->validate($data, [
            'title' => 'required',
            'filepath' => 'required',
            'course_id' => 'required',
        ]);

        $video = Video::find($data['video_id']);
        $video->video_address = $data['filepath'];
        $video->title = $data['title'];
        $video->course_id = $data['course_id'];
        $video->update();
        return redirect('/admin/videos');
    }

    function delete_video($video_id)
    {
        $video = Video::find($video_id);
        $video->delete();
        return redirect('admin/videos');
    }

    function users()
    {
        $users = User::all();
        return view('admin.users' , ['users' => $users]);
    }

    function user($user_id)
    {
        $user = User::find($user_id);
        return view('admin.user' , ['user' => $user]);
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
