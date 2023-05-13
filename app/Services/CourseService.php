<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{

    public function handle($course, $request)
    {
        $course->name = $request->name;
        $course->description = $request->description;
        $course->author = $request->author;
        $course->intro_video = $request->intro_video;
        $course->price = (int) $request->input('price',0);
        $course->old_price = (int) $request->input('old_price',0);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = rand(1,99) . time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path(Course::IMAGE_PATH), $imageName);
            $course->image = $imageName;
        }
    }

    public function save($course,$request)
    {
        $this->handle($course, $request);
        return $course->save();

    }

}
