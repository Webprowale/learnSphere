<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $dbCourse;
    protected $dbLesson;

    public function __construct()
    {
        $this->dbCourse = new CourseModel();
        $this->dbLesson = new LessonModel();
    }
    public function index()
    {
        $courses = $this->dbCourse->findAll();
        return view('user', ['course'=> $courses]);
    }
    public function searchCourse()
    {
        if ($this->request->isAJAX()) {
            $query = $this->request->getGet('query');
            $courses = $this->dbCourse->like('title', $query)
                                      ->orLike('description', $query)
                                      ->orLike('category', $query)
                                      ->findAll();
    
            $html = ''; 
            if (!empty($courses)) {
                $html .= '<div class="container mb-5 mt-3">
                            <div class="text-center">
                                <h6 class="section-title bg-white text-center text-primary px-3">Search Courses</h6>
                            </div>
                            <div class="row g-4 align-items-center">';
    
                foreach ($courses as $course) {
                    $html .= '<div class="col-lg-4 col-md-6 shadow">
                                <div class="course-item bg-light">
                                    <div class="position-relative overflow-hidden">
                                        <img class="img-fluid" src="' . esc($course['image']) . '" alt="Course Image">
                                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                            <a href="/user/buy/' . esc($course['id']) . '" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Buy Now</a>
                                        </div>
                                    </div>
                                    <div class="text-center p-4 pb-0">
                                        <h3 class="mb-0">' . (!empty($course['price']) ? '$' . esc($course['price']) : 'Free') . '</h3>
                                        <div class="mb-3">
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small>(123)</small>
                                        </div>
                                        <h5 class="mb-4">' . esc($course['title']) . '</h5>
                                    </div>
                                </div>
                              </div>';
                }
    
                $html .= '</div></div>';
            }
            return $this->response->setJSON(['html' => $html]);
        }
    
        
        return redirect()->to('/user');
    }
    public function watchCourse($courseId)
    {
        $link = 'user/watch/'.$courseId;
        $getcourse = $this->dbCourse->where('id', $courseId)->findAll();
        if (!$getcourse) {
            return redirect()->back()->with('error', 'Course not found');
        }
        $query = $this->request->getGet('lesson');
        if($query){
            $lesson = $this->dbLesson->where('id', $query)->first();
            if($lesson){
                return view('watch', ['course'=>$getcourse, 'lesson'=>$lesson, 'link'=>$link]);
            }
        }
        return view('watch', ['course'=>$getcourse, 'link'=>$link]);
    }

}
