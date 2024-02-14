<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
class Login extends BaseController
{
    public function index()
    {
        $session= session();
        if($session->has('logged_in')==true)
        {
           return redirect()->to(site_url("admin/dashboard")); 
        }
        else
        {
            return view('loginuser');
        }
    }

    public function adminlogin()
    {
        $user= new Usermodel();
        $data=array
            (
            'Email'=>$this->request->getPost('email'),  
            'Password'=>($this->request->getPost('password'))
            );
        $result = $user->login($data);
        if($result==true) 
        {   
            $session= session();
            $newdata = 
            [
                'username'  => $result['username'],
                'logged_in'=> true,
            ];
            $session->set($newdata);
            return redirect()->to(site_url("admin/dashboard"));
        } 
        else 
        {   
            return redirect()->route("admin")->with("response", "INVALID DETAILS !");     
        }
    }
}
