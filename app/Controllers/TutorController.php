<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\QuizModel;
use App\Models\TutorModel;
use CodeIgniter\HTTP\ResponseInterface;

class TutorController extends BaseController
{
    public function index()
    {
        return view('tutor/create-course');
    }
    public function create_course()
    {
        $db = new CourseModel();
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
            $dbTutor = new TutorModel();
            $tutor = $dbTutor->where('auth_id', session()->get('tutor_id'))->first();
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'image' => $imagePath,
                'price' => $this->request->getPost('price'),
                'category' => $this->request->getPost('category'),
                'tutor_id' => $tutor['id']
            ];
            $db->insert($data);
            return view('tutor/create-course', ['message' => 'Course created successfully']);
        } else {
            return view('tutor/create-course', ['errors' => $this->validator->getErrors()]);
        }
    }
    public function course()
    {
        $db = new CourseModel();
        $courses = $db->where('tutor_id', session()->get('tutor'))->findAll();
        return view('tutor/course', ['courses' => $courses]);
    }
    public function edit_course($id){
        $db = new CourseModel();
        $course = $db->where('id', $id)->first();
        return view('tutor/update-course', ['course' => $course]);
    }

    public function update_course($id)
    {
        $db = new CourseModel();
        $this->validate([
            'title' => 'permit_empty|string',
            'description' => 'permit_empty|string',
            'image' => 'permit_empty|uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
            'category' => 'permit_empty|string',
            'price' => 'permit_empty|numeric'
        ]);
        $course = $db->where('id', $id)->first();
        if ($this->validator->run()) {
            $data = [];
            if ($this->request->getPost('title')) {
                $data['title'] = $this->request->getPost('title');
            }
            if ($this->request->getPost('description')) {
                $data['description'] = $this->request->getPost('description');
            }
            if ($this->request->getPost('tags')) {
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
                $db->update($id, $data);
                return view('tutor/update-course', ['message' => 'Course updated successfully', 'course' => $course]);
            } else {
                return view('tutor/update-course', ['errors' => 'No data to update', 'course' => $course]);
            }
        } else {
            return view('tutor/update-course', ['errors' => $this->validator->getErrors(), 'course' => $course]);
        }
    }

    public function delete_course($id)
    {
        $db = new CourseModel();
        $db->delete($id);
        return redirect()->to(site_url('control'));
    }

    public function search_course(): string
    {
        $db = new CourseModel();
        $searchTerm = $this->request->getGet('search_term');
        $courses = $db->like('title', $searchTerm, 'both', null, true)
            ->orLike('description', $searchTerm, 'both', null, true)
            ->findAll();
        return view('search_course', ['json_data' => json_encode($courses)]);
    }

    public function create_quiz($lesson_id)
    {
        $db = new QuizModel();
        $this->validate([
            'questions' => 'required|json',
            'type' => 'required|string',
            'min_score' => 'required|integer',
            'time_limit' => 'required|integer',
            'attempt_allowed' => 'required|integer'
        ]);

        if ($this->validator->run()) {
            $questions = $this->request->getPost('questions');
            $serializedQuestions = serialize($questions);
            $data = [
                'lesson_id' => $lesson_id,
                'questions' => $serializedQuestions,
                'type' => $this->request->getPost('type'),
                'min_score' => $this->request->getPost('min_score'),
                'time_limit' => $this->request->getPost('time_limit'),
                'attempt_allowed' => $this->request->getPost('attempt_allowed')
            ];
            $db->insert($data);
            return view('create_quiz', ['message' => 'Quiz created successfully', 'lesson_id' => $lesson_id]);
        } else {
            return view('create_quiz', ['errors' => $this->validator->getErrors(), 'lesson_id' => $lesson_id]);
        }
    }
    public function fetch_quiz_by_lesson($lesson_id)
    {
        $quizModel = new QuizModel();

        $quiz = $quizModel->where('lesson_id', $lesson_id)->first();

        if ($quiz) {
            $questions = unserialize($quiz['questions']);
            return view('view_quiz', [
                'lesson_id' => $lesson_id,
                'type' => $quiz['type'],
                'min_score' => $quiz['min_score'],
                'time_limit' => $quiz['time_limit'],
                'attempt_allowed' => $quiz['attempt_allowed'],
                'questions' => $questions
            ]);
        } else {
            return view('view_quiz', ['errors' => 'Quiz not found for this lesson']);
        }
    }

    public function update_quiz($lesson_id)
    {
        $quizModel = new QuizModel();
        $quiz = $quizModel->where('lesson_id', $lesson_id)->first();

        if (!$quiz) {
            return view('update_quiz', ['errors' => 'Quiz not found for this lesson']);
        }
        $rules = [];
        $data = [];
        if ($this->request->getPost('questions')) {
            $rules['questions'] = 'required|json';
            $data['questions'] = serialize($this->request->getPost('questions'));
        }
        if ($this->request->getPost('type')) {
            $rules['type'] = 'required|string';
            $data['type'] = $this->request->getPost('type');
        }
        if ($this->request->getPost('min_score')) {
            $rules['min_score'] = 'required|integer';
            $data['min_score'] = $this->request->getPost('min_score');
        }
        if ($this->request->getPost('time_limit')) {
            $rules['time_limit'] = 'required|integer';
            $data['time_limit'] = $this->request->getPost('time_limit');
        }
        if ($this->request->getPost('attempt_allowed')) {
            $rules['attempt_allowed'] = 'required|integer';
            $data['attempt_allowed'] = $this->request->getPost('attempt_allowed');
        }
        if (!empty($rules) && $this->validate($rules)) {
            $quizModel->update($quiz['id'], $data);
            return view('update_quiz', ['message' => 'Quiz updated successfully', 'lesson_id' => $lesson_id]);
        } else {
            return view('update_quiz', [
                'errors' => $this->validator->getErrors(),
                'lesson_id' => $lesson_id
            ]);
        }
    }

    public function delete_quiz($lesson_id)
    {
        $quizModel = new QuizModel();
        $quiz = $quizModel->where('lesson_id', $lesson_id)->first();

        if (!$quiz) {
            return view('delete_quiz', ['errors' => 'Quiz not found for this lesson']);
        }

        $quizModel->delete($quiz['id']);
        return view('delete_quiz', ['message' => 'Quiz deleted successfully', 'lesson_id' => $lesson_id]);
    }

    public function lesson()
    {
        $db = new CourseModel();
        $courses = $db->where('tutor_id',  session()->get('tutor'))->findAll();
        return view('tutor/create-lesson', ['select' => $courses]);
    }
    public function create_lesson()
    {
        $db = new LessonModel();
        $this->validate([
            'title' => 'required|string|max_length[255]',
            'video' => 'uploaded[video]|max_size[video,307200]',
            'course_id' => 'required|integer'
        ]);

        if ($this->validator->run()) {
            $videoFile = $this->request->getFile('video');
            if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
                $newName = $videoFile->getRandomName();
                $videoFile->move(ROOTPATH . 'public/uploads/videos', $newName);
                $data['video'] = '/uploads/videos/' . $newName;
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'video' => $data['video'],
                'course_id' => $this->request->getPost('course_id')
            ];
            $db->insert($data);
            $db = new CourseModel();
            $dbTutor = new TutorModel();
            $tutor = $dbTutor->where('auth_id', session()->get('tutor_id'))->first();
            $courses = $db->where('tutor_id', $tutor['id'])->findAll();
            return view('tutor/create-lesson', ['message' => 'Lesson created successfully', 'select' => $courses]);
        } else {
            $db = new CourseModel();
            $dbTutor = new TutorModel();
            $tutor = $dbTutor->where('auth_id', session()->get('tutor_id'))->first();
            $courses = $db->where('tutor_id', $tutor['id'])->findAll();
            return view('tutor/create-lesson', ['errors' => $this->validator->getErrors(), 'select' => $courses]);
        }
    }
    public function all_lesson(){

        $lessonModel = new LessonModel();
        $lessons = $lessonModel->select('lesson.*, course.title AS course_title')
                                ->join('course', 'course.id = lesson.course_id')
                                ->where('course.tutor_id', session()->get('tutor'))
                                ->findAll();
        return view('tutor/lesson', ['lessons' => $lessons]);
        
    }

    public function get_lessons_with_quizzes($course_id)
    {
        $lessonModel = new LessonModel();
        $lessons = $lessonModel->select('lessons.*, quiz.questions, quiz.type, quiz.min_score, quiz.time_limit, quiz.attempt_allowed')
            ->join('quiz', 'quiz.id = lessons.quiz_id', 'left')
            ->where('lessons.course_id', $course_id)
            ->findAll();

        return view('lessons_with_quizzes', ['lessons' => $lessons]);
    }

    public function edit_lesson($id){
        $lessonModel = new LessonModel();
        $db = new CourseModel();
        $courses = $db->where('tutor_id',  session()->get('tutor'))->findAll();
        $lesson = $lessonModel->find($id);
        return view('tutor/update-lesson', ['lesson' => $lesson,'select' => $courses]);
    }

    public function update_lesson($lesson_id) {
        $lessonModel = new LessonModel();
        $lesson = $lessonModel->find($lesson_id);
        $db = new CourseModel();
        $courses = $db->where('tutor_id',  session()->get('tutor'))->findAll();
        if (!$lesson) {
            return view('update_lesson', ['errors' => 'Lesson not found','lesson' => $lesson,'select' => $courses]);
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
        if ($this->request->getPost('video') !== null) {
            $rules['video'] = 'uploaded[video]|max_size[video,307200]';
            $videoFile = $this->request->getFile('video');
            if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
                $newName = $videoFile->getRandomName();
                $videoFile->move(ROOTPATH . 'public/uploads/videos', $newName);
                $data['video'] = '/uploads/videos/' . $newName;
            }
        }
        if (!$this->validate($rules)) {
            return view('tutor/update-lesson', ['errors' => $this->validator->getErrors(),'lesson' => $lesson,'select' => $courses]);
        }
        $lessonModel->update($lesson_id, $data);

        return view('tutor/update-lesson', ['message' => 'Lesson updated successfully', 'lesson' => $lesson,'select' => $courses]);
    }

}
