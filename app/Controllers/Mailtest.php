<?php

namespace App\Controllers;
use App\Models\EmployeeModel;
use App\Controllers\BaseController;

class Mailtest extends BaseController
{
    public function __construct()
    {
        helper(['url','form']);
    }

    //Function to load default landing page
    public function index()
    {
        return view("mailform");
    }

    //Function to send mail using SMTP
    public function sendmail()
    {
        if($this->isonline())
        {
            $model= new EmployeeModel();
            $from="singhvinayethics527@gmail.com";
            $subject="Verify Code to reset password";
            $name="user";
            $mail="vinaysinghworkspace@gmail.com ";
            $result=$model->checkmail($mail);
            if($result==false)
            {
                echo "Not exists";
            }
            else
            {   
                $token=rand();
                $current = date('Y-m-d h:i:sa');
                $validtill = date('Y-m-d h:i:sa', strtotime($current. ' +15 minutes'));
                $data=array(
                    "verification_code"=>$token,
                    "updated_at"=>$current,
                    "valid_till"=>$validtill,
                );
                $update=$model->updatedata($data,$result['ID']);
                if($update==true)
                {
                    $template = view("mailbody", ["token"=>$token,"id"=>$result['ID']]);
                    $email = \Config\Services::email();
                    $email->setTo($mail);
                    $email->setSubject($subject);
                    $email->setMessage($template);
                    $email->setFrom($from,$name);
                    if($email->send())
                    {
                        echo "mail sent";
                    }
                    else
                    {   
                        $response = $email->printDebugger(['headers']);
                        echo $response ;
                    }
                }
                else
                {
                    echo "error occured";
                }     
            }
        }
        else
        {
            echo "not connected";
        }
    }

    //Checking whether connection is present or not
    public function isonline($url="https://google.com")
    {
        if(@fopen($url,'r'))
        {
            return true;
        }
        else
            return false;
    }

    //Function to check whether link duration is valid or not
    public function resetpassword($id)
    {   
        $user=new EmployeeModel();
        $fetch=$user->getdata($id);
        $current=date("Y-m-d h:i:s");
        $t1=strtotime($current);
        $t2=$fetch['valid_till'];
        if($t2==Null)
        {
            echo"INVALID LINK";
        }
        elseif((strtotime($t2)-$t1)<=0)
        {   
            $data=["valid_till"=>null,
                    "updated_at"=>date("Y:m-d h:i:s")
                  ];
            $user->updatedata($data,$id);
            return view("index.html");
        }
        else
        {
            return view("Resetpassword",["Id"=>$id]);
        }
    }

    //Function to Change password
    public function changepass($id)
    {   
        $user=new EmployeeModel();
        $verification=$this->request->getPost('resetcode');
        $password=$this->request->getPost('Password');
        $confirmpassword=$this->request->getPost('confirmpass');
        $current=date("Y-m-d h:i:s");
        $fetch=$user->getdata($id);
        if(($verification==$fetch['verification_code'] && $verification !=null))
        {
            if($password==$confirmpassword)
            {
                $data=array(
                    "verification_code"=>null,
                    "Password"=>$confirmpassword,
                    "updated_at"=>date("Y-m-d h:i:sa"),
                    "valid_till"=>null,
                );
                $update=$user->updatedata($data,$id);
                if($update==false)
                {
                    echo "failure";
                }
                else
                {    
                    $email = \Config\Services::email();
                    $email->setTo($fetch['Email']);
                    $email->setSubject("Password Successfully Changed");
                    $email->setMessage("You have Successfully changed your password");
                    $email->setFrom("singhvinayethics527@gmail.com","Admin");
                    if($email->send())
                    {
                        return redirect()->to(base_url("/"))->with('Alert','Your Password was changed Successfully');
                    }
                    else
                    {
                        echo "mail could not be sent";
                    }
                }
            }
            else
            {
                return redirect()->to(base_url("resetpass/".$id))->with('Error','Password does not match');
            }
        }
        else
        {
            return redirect()->to(base_url("resetpass/".$id))->with('Error','Verification code does not match');
        }
    }
}
