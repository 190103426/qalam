<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Тәпсір тағылымы',
                'author' => 'Асқар Әкімханов',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed eleifend tristique, tortor mauris molestie elit, et lacinia ipsum quam nec dui. Quisque nec mauris sit amet elit iaculis pretium sit amet quis magna. Aenean velit odio, elementum in tempus ut, vehicula eu diam. Pellentesque rhoncus aliquam mattis. Ut vulputate eros sed felis sodales nec vulputate justo hendrerit. Vivamus varius pretium ligula, a aliquam odio euismod sit amet. Quisque laoreet sem sit amet orci ullamcorper at ultricies metus viverra. Pellentesque arcu mauris, malesuada quis ornare accumsan, blandit sed diam.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed eleifend tristique, tortor mauris molestie elit, et lacinia ipsum quam nec dui. Quisque nec mauris sit amet elit iaculis pretium sit amet quis magna. Aenean velit odio, elementum in tempus ut, vehicula eu diam. Pellentesque rhoncus aliquam mattis. Ut vulputate eros sed felis sodales nec vulputate justo hendrerit. Vivamus varius pretium ligula, a aliquam odio euismod sit amet. Quisque laoreet sem sit amet orci ullamcorper at ultricies metus viverra. Pellentesque arcu mauris, malesuada quis ornare accumsan, blandit sed diam.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed eleifend tristique, tortor mauris molestie elit, et lacinia ipsum quam nec dui. Quisque nec mauris sit amet elit iaculis pretium sit amet quis magna. Aenean velit odio, elementum in tempus ut, vehicula eu diam. Pellentesque rhoncus aliquam mattis. Ut vulputate eros sed felis sodales nec vulputate justo hendrerit. Vivamus varius pretium ligula, a aliquam odio euismod sit amet. Quisque laoreet sem sit amet orci ullamcorper at ultricies metus viverra. Pellentesque arcu mauris, malesuada quis ornare accumsan, blandit sed diam.',
                'price' => 150000,
                'old_price' => 200000,
            ],

        ];
        $module = [
            'name' => 'Арифмтетика',
        ];
        $lesson = [
            'name' => 'Алғашқы сабақтың әдемі тақырыбы',
            'description' => 'Курс образовательного геймдизайна - для тех, кто ищет азарта в обучении и обучения в игре. Как разрабатывать и проводить игры на уроках и занятиях с детьми Курс образовательного геймдизайна - для тех, кто ищет азарта в обучении и обучения в игре. Как разрабатывать и проводить игры на уроках и занятиях с детьми. Курс образовательного геймдизайна - для тех, кто ищет азарта в обучении и обучения в игре.',
            'file_1' => 'SMM мамандығына кіріспе сабағының 15 беттік чек-листі.zip',
            'file_2' => 'SMM мамандығына кіріспе сабағының 15 беттік чек-листі.zip',
            'video_1' => 'https://www.youtube.com/watch?v=mckSJcSTiCU',
        ];

        foreach ($courses as $course) {
            $course = Course::create($course);
            $course->modules()->create(
                $module
            );
            $course->load('modules');
            foreach ($course->modules as $module) {
                $lesson['course_id'] = $course->id;
                $module->lessons()->create($lesson);
            }
        }
    }
}
