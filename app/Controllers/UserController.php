<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\UserPaymentModel;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $dbCourse;
    protected $dbLesson;
    protected $dbPay;
    protected $dbAuth;

    public function __construct()
    {
        $this->dbCourse = new CourseModel();
        $this->dbLesson = new LessonModel();
        $this->dbPay = new userPaymentModel();
        $this->dbAuth = new AuthModel();
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
        $getLesson = $this->dbLesson->where('course_id', $courseId)->findAll();
        $query = $this->request->getGet('lesson');
        if($query){
            $lesson = $this->dbLesson->where('id', $query)->first();
            if($lesson){
                return view('watch', ['course'=>$getcourse, 'getLesson'=>$getLesson,  'lesson'=>$lesson, 'link'=>$link]);
            }
        }
        return view('watch', ['course'=>$getcourse, 'getLesson'=>$getLesson, 'link'=>$link]);
    }
    public function buyCourse( $id)
    {
   
        $course = $this->dbCourse->where('id', $id)->first();
        $client = service('curlrequest');
        $userEmail = session()->get('email');
        $courseAmount = $course['price'];
        $paystackSecretKey = 'sk_test_f4400c1f3229dcff5b6fa7efd1dad062f90dc1d4';
        $paystackUrl = "https://api.paystack.co/transaction/initialize";
        $userId = $this->dbAuth->where('email', $userEmail)->first();
        $ref =   uniqid() . '_' . time();
        $data = [
            'email' => $userEmail,
            'amount' => $courseAmount * 100,
            'reference' => $ref,
            'metadata'=>[
                'pay_id' => $course['id'],
                'name' => $course['title'],
                'description' => $course['description']
            ],
            'callback_url' => base_url('user/payment/callback') 
        ];
        $initData = [
            'user_id'=> $userId['id'],
            'status' => 'pending',
            'course_id' => $course['id'],
            'ref'=> $ref,
            'amount' => $course['price'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $initalPay = $this->dbPay->newPayment($initData);
        if($initalPay){
        $response = $client->post($paystackUrl, [
            'http_errors' => false, 
            'headers' => [
                'Authorization' => 'Bearer ' . $paystackSecretKey,
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache' 
            ],
            'json' => $data
        ]);
        $responseBody = json_decode($response->getBody(), true);

        if (isset($responseBody['status']) && $responseBody['status'] === true) {
            return redirect()->to($responseBody['data']['authorization_url']);
        } 
    }
            return redirect()->back()->with('error', 'Payment initialization failed.');
        
    }

    public function callBack()
    {
      $trxref = $this->request->getGet('reference');
      $client = service('curlrequest');
      $paystackSecretKey = 'sk_test_f4400c1f3229dcff5b6fa7efd1dad062f90dc1d4';
      $paystackUrl = "https://api.paystack.co/transaction/verify/" .$trxref;
      $response = $client->get($paystackUrl, [
          'http_errors' => false, 
          'headers' => [
              'Authorization' => 'Bearer '. $paystackSecretKey,
          ]
      ]
    );
    $responseBody = json_decode($response->getBody(), true);

    if (isset($responseBody['status']) && $responseBody['status'] === true) {
        if ($responseBody['data']['status'] === 'success') {
            $payId = $responseBody['data']['metadata']['pay_id'];
            $verifyPrice = $this->dbCourse->where('id', $payId)->first();
    
            $reference = $responseBody['data']['reference'];
    
            if ($verifyPrice && $verifyPrice['price'] == $responseBody['data']['amount'] / 100) {
                if (isset($reference)) {
                    if($responseBody['data']['status'] =='success'){
                    $updateS = ['status' => 'success'];
                    $dbPay = $this->dbPay->where('ref', $reference)->set($updateS)->update();
                    return redirect()->to('/user')->with('success', 'Payment Successful');
                    if (!$dbPay) {
                        return redirect()->to('/user')->with('error', 'Payment failed');
                    }
                }
                $updateF = ['status'=> 'failed'];
                 $this->dbPay->where('ref', $reference)->set($updateF)->update();
                return redirect()->to('/user')->with('error', 'payment Failed');

                } 
                return redirect()->to('/user')->with('error', 'Reference not found');
            }
            
            return redirect()->to('/user')->with('error', 'Price mismatch or payment invalid');
        }
        return redirect()->to('/user')->with('error', 'Payment status not successful');
    } 
    return redirect()->to('/user')->with('error', 'Payment status non-verify');
    


}
    
}
