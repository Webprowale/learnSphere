<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function confirm_login(){
     helper(['form','url']);
     $model = new AuthModel();
     $data =[
        'email' => $this->request->getPost('email'),
       'password' =>  $this->request->getPost('password'),
     ];
     $user = $model->where('email', $data['email'])->first();
     if(!$user){
         return view('Login',['usererror' => 'Invalid email']);
     }else{
        $pass = password_verify($data['password'],$user['password']);
        if($pass){
            $session = session();
            $session->set('user_id', $user['id']);
            $session->set('email', $user['email']);
            $session->set('firstname', $user['firstname']);
            $session->set('lastname', $user['lastname']);
            $session->set('role',$user['role']);
            return redirect()->to(site_url('user'));
        }else{
            return view('Login',['passerror' => 'Invalid password']);
        }
     }
    }

    public function register(){
        helper(['form', 'url']);
        $this->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|valid_email',
            'password' =>  'required|min_length[8]',
        ]);

        if($this->validator->run()){
            $model = new AuthModel();
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => 'user'
            ];
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
