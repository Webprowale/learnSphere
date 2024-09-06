<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('Register');
    }

    public function login(){
        return view('Login');
    }
    public function confirm_login(){
     helper(['form','url']);
     $model = new AuthModel();
     $data =[
        'username' => $this->request->getPost('username'),
       'password' =>  $this->request->getPost('password'),
     ];
     $user = $model->where('username', $data['username'])->first();
     if(!$user){
         return view('login',['usererror' => 'Invalid username']);
     }else{
        $pass = password_verify($data['password'],$user['password']);
        if($pass){
            $session = session();
            $session->set('user_id', $user['id']);
            $session->set('username', $user['username']);
            $session->set('role',$user['role']);
            return redirect()->to(site_url('dashboard'));
        }else{
            return view('login',['passerror' => 'Invalid password']);
        }
     }
    }

    public function register(){
        helper(['form', 'url']);
        $this->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|valid_email',
            'password' =>  'required|min_length[8]',
        ]);

        if($this->validator->run()){
            $model = new AuthModel();
            $data = [
                'fullname' => $this->request->getPost('fullname'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => 'student'
            ];

            if($model->where('username', $data['username'])->first()){
                return view('register',['userror' =>'Username already in use']);
            }
            if($model->where('email',$data['email'])->first()){
                return view('register',['emailerror' =>'Email already in use']);
            }

            $model->insert($data);
            return redirect()->to(site_url('login'));
        }else{
            return view('register', ['errors' => $this->validator->getErrors()]);
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('login'));
    }
}
