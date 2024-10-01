<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\TutorModel;

class TutorController extends BaseController
{
    protected $dbTutor;
    protected $dbCourse;
    protected $dbLesson;

    public function __construct()
    {
        $this->dbTutor = new TutorModel();
        $this->dbCourse = new CourseModel();
        $this->dbLesson = new LessonModel();
    }

    public function index()
    {
        return view('tutor/create-course');
    }

    public function createCourse()
    {
        $validation = $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
            'category' => 'required|string',
            'price' => 'required|numeric'
        ]);

        if ($validation) {
            $image = $this->request->getFile('image');
            $imagePath = null;

            if ($image && $image->isValid() && !$image->hasMoved()) {
                $newName = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads', $newName);
                $imagePath = 'uploads/' . $newName;
            }

            $tutor = $this->dbTutor->where('auth_id', session()->get('tutor_id'))->first();
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'image' => $imagePath,
                'price' => $this->request->getPost('price'),
                'category' => $this->request->getPost('category'),
                'tutor_id' => $tutor['id']
            ];

            $this->dbCourse->insert($data);
            return view('tutor/create-course', ['message' => 'Course created successfully']);
        }

        return view('tutor/create-course', ['errors' => $this->validator->getErrors()]);
    }

    public function course()
    {
        $courses = $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll();
        return view('tutor/course', ['courses' => $courses]);
    }

    public function editCourse($courseId)
    {
        $course = $this->dbCourse->where('id', $courseId)->first();
        return view('tutor/update-course', ['course' => $course]);
    }

    public function updateCourse($courseId)
    {
        $validation = $this->validate([
            'title' => 'permit_empty|string',
            'description' => 'permit_empty|string',
            'image' => 'permit_empty|uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
            'category' => 'permit_empty|string',
            'price' => 'permit_empty|numeric'
        ]);

        $course = $this->dbCourse->where('id', $courseId)->first();

        if ($validation) {
            $data = [];
            if ($this->request->getPost('title')) {
                $data['title'] = $this->request->getPost('title');
            }
            if ($this->request->getPost('description')) {
                $data['description'] = $this->request->getPost('description');
            }
            if ($this->request->getPost('price')) {
                $data['price'] = $this->request->getPost('price');
            }
            if ($this->request->getPost('category')) {
                $data['category'] = $this->request->getPost('category');
            }

            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $newName = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads', $newName);
                $data['image'] = 'uploads/' . $newName;
            }

            if (!empty($data)) {
                $this->dbCourse->update($courseId, $data);
                return view('tutor/update-course', ['message' => 'Course updated successfully', 'course' => $course]);
            } 
                return view('tutor/update-course', ['errors' => 'No data to update', 'course' => $course]);
            
        }

        return view('tutor/update-course', ['errors' => $this->validator->getErrors(), 'course' => $course]);
    }

    public function deleteCourse($courseId)
    {
        $this->dbCourse->delete($courseId);
        return redirect()->to(site_url('control'));
    }

    public function lesson()
    {
        $courses = $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll();
        return view('tutor/create-lesson', ['select' => $courses]);
    }

    public function createLesson()
    {
        $validation = $this->validate([
            'title' => 'required|string|max_length[255]',
            'video' => 'uploaded[video]|max_size[video,307200]',
            'course_id' => 'required|integer'
        ]);

        if ($validation) {
            $videoFile = $this->request->getFile('video');
            if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
                $newName = $videoFile->getRandomName();
                $videoFile->move(ROOTPATH . 'public/uploads/videos', $newName);
                $videoPath = '/uploads/videos/' . $newName;
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'video' => $videoPath,
                'course_id' => $this->request->getPost('course_id')
            ];

            $this->dbLesson->insert($data);
            return view('tutor/create-lesson', ['message' => 'Lesson created successfully', 'select' => $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll()]);
        }

        return view('tutor/create-lesson', ['errors' => $this->validator->getErrors(), 'select' => $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll()]);
    }

    public function allLesson()
    {
        $lessons = $this->dbLesson->select('lesson.*, course.title AS course_title')
            ->join('course', 'course.id = lesson.course_id')
            ->where('course.tutor_id', session()->get('tutor'))
            ->findAll();
        return view('tutor/lesson', ['lessons' => $lessons]);
    }

    public function editLesson($lessonId)
    {
        $lesson = $this->dbLesson->find($lessonId);
        $courses = $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll();
        return view('tutor/update-lesson', ['lesson' => $lesson, 'select' => $courses]);
    }

    public function updateLesson($lessonId)
    {
        $lesson = $this->dbLesson->find($lessonId);
        $courses = $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll();

        if (!$lesson) {
            return view('tutor/update-lesson', ['errors' => 'Lesson not found', 'lesson' => $lesson, 'select' => $courses]);
        }

        $rules = [];
        $data = [];

        if ($this->request->getPost('title') !== null) {
            $rules['title'] = 'string|max_length[255]';
            $data['title'] = $this->request->getPost('title');
        }
        if ($this->request->getPost('course_id') !== null) {
            $rules['course_id'] = 'numeric';
            $data['course_id'] = $this->request->getPost('course_id');
        }
        if ($this->request->getFile('video') !== null) {
            $rules['video'] = 'uploaded[video]|max_size[video,307200]';
            $videoFile = $this->request->getFile('video');
            if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
                $newName = $videoFile->getRandomName();
                $videoFile->move(ROOTPATH . 'public/uploads/videos', $newName);
                $data['video'] = '/uploads/videos/' . $newName;
            }
        }

        if (!$this->validate($rules)) {
            return view('tutor/update-lesson', ['errors' => $this->validator->getErrors(), 'lesson' => $lesson, 'select' => $courses]);
        }

        if (!empty($data)) {
            $this->dbLesson->update($lessonId, $data);
            return view('tutor/update-lesson', ['message' => 'Lesson updated successfully', 'lesson' => $lesson, 'select' => $courses]);
        }

        return view('tutor/update-lesson', ['errors' => 'No changes made', 'lesson' => $lesson, 'select' => $courses]);
    }

    public function deleteLesson($lessonId)
    {
        $this->dbLesson->delete($lessonId);
        return redirect()->to(site_url('control'));
    }

    public function quiz()
    {
        $courses = $this->dbCourse->where('tutor_id', session()->get('tutor'))->findAll();
        return view('tutor/create-quiz', ['select' => $courses]);
    }
}
