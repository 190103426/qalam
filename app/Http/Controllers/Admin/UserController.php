<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserAccessCourseGiveRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\Course;
use App\Models\User;
use App\Models\UserAccessCourse;
use App\Models\UserAccessLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $fullName = $request->full_name;
        $email = $request->email;
        $phone = $request->phone;

        $users = User::when($fullName, fn($query) => $query->where('full_name', 'like', "%$fullName%"))
            ->when($email, fn($query) => $query->where('email', 'like', "%$email%"))
            ->when($phone, fn($query) => $query->where('phone', 'like', "%$phone%"))
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function changeRole($id)
    {
        if ($id == auth()->user()->id) {
            return redirect()->back()->withErrors([
                'user' => 'Өзіңізді өзгерте алмайсыз'
            ]);
        }
        $user = User::findOrFail($id);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.users.index')->withSuccess(__('message.success.created'));
    }

    public function userAccessCourses($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::with(['accessCourses' => function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        }])->get();
        return view('admin.users.access-courses', compact('user', 'courses'));

    }

    public function userAccessCoursesGive($id, UserAccessCourseGiveRequest $request)
    {
        $courseId = $request->course_id;
        $daysCount = $request->days_count;
        $user = User::findOrFail($id);
        $course = Course::with('modules.lessons')->findOrFail($courseId);

        $module = $course->modules->first();
        if (empty($module)) {
            return redirect()->back()->withErrors(['msg' => 'Бұл курста ешқандай модуль енгізілмеген! Модуль енгізіңіз!']);
        }
        if (empty($module->lessons->first())) {
            return redirect()->back()->withErrors(['msg' => 'Бұл модульде ешқандай сабақ енгізілмеген! Сабақ енгізіңіз!']);
        }
        DB::beginTransaction();
        $userAccessCourse = UserAccessCourse::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->latest()
            ->firstOrNew();
        $userAccessCourse->course_id = $course->id;
        $userAccessCourse->user_id = $user->id;
        $userAccessCourse->to_date = now()->addDays($daysCount);
        $userAccessCourse->days_count = $daysCount;
        $userAccessCourse->save();

        UserAccessLesson::firstOrCreate([
            'user_id' => $user->id,
            'lesson_id' => $course->modules->first()->lessons->first()->id,
            'module_id' => $course->modules->first()->id,
            'course_id' => $course->id,
        ]);
        DB::commit();

        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function userAccessCoursesDelete($id, $accessId)
    {
        $userAccessCourse = UserAccessCourse::where('user_id', $id)->findOrFail($accessId);
        $userAccessCourse->delete();
//        $course_id = $request->course_id;
        return redirect()->back()->withSuccess(__('message.success.deleted'));

    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function destroy($id)
    {
        if ($id == auth()->user()->id) {
            return redirect()->back()->withErrors([
                'user' => 'Өзіңізді жоя алмайсыз'
            ]);
        }
        $user = User::findOrFail($id);

        //delete dostup
        $user->accessCourses()->delete();
        $user->comments()->delete();
        $user->delete();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
