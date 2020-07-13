<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\I3class;
use App\User;
use App\Category;
use App\Video;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index()
    {
        return view('client.index');
    }

    function groups()
    {
        $groups = Group::where('parent_id', '=', '0')->get();
        return view('client.groups', ['groups' => $groups]);
    }

    function courses($name)
    {
        $name = str_replace('-', ' ', $name);

        $group = Group::where('name_en', $name)->first();

        if (!$group) {
            return redirect()->back()->with([
                'message' => 'دوره آموزشی پیدا نشد',
            ]);
        }

        foreach ($group->courses as $course) {
            $course->explanation = strip_tags($this->shortenText($course->explanation, 64));
            $this->fixClassInformation($course);
        }

        return view('client.courses', [
            'group' => $group
        ]);
    }

    function course($group_name, $course_name)
    {
        $course_name = str_replace('-', ' ', $course_name);

        $course = Course::query()->where('name', $course_name)->first();

        return view('client.course', [
            'course' => $course
        ]);
    }

    function aboutUs()
    {
        return view('client.about-us');
    }
    function contactUs()
    {
        return view('client.about-us');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/')->with([
            'message'=>'از حساب کاربری خارج شدید'
            ]);
    }
}
