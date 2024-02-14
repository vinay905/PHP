<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
class Employee extends BaseController
{
	public function index()
	{	$user=new UserModel();
		$result['data']=$user->display();
		return view("Emailsignature",$result);
	}

// Function to insert user data into database
	public function employeeinsert()
	{
		$user=new UserModel();
		$filename=$this->request->getPost('filename');
		$image=$this->request->getPost('file');

		// Function to decode the base64 image & move it to folder
		$this->decodemove($image,$filename);

		$data=array
		(
			"employee_name"=>$this->request->getPost('Name'),
			"email"=>$this->request->getPost('Email'),
			"contact_no"=>$this->request->getPost('Number'),
			"designation"=>$this->request->getPost('Designation'),
			"company_id"=>$this->request->getPost('Companyid'),
			"image"=>$filename
		);
		$result=$user->empinsert($data);
		if($result==true)
		{
			return "Successfull";
			template($data);
		}
		elseif ($result==false) 
		{
			return "Error occured";	
		}
	}


//-- Function to Decode the base64 string and then save it to a folder-----------------------//
	public function decodemove($image,$filename)
	{
		$image=explode(";",$image)[1];//remove the "data:image/png;" from string
		$image=explode(",",$image)[1];// remove the "base64," from string
		$image=str_replace(" ","+",$image);// replace " " with "+"
		$image=base64_decode($image);
		file_put_contents("public/usersignatures/".$filename, $image);//create a file on the folder
	}


//------------ Function to get Company table data based on id-------------------------------------//
	public function displaypreview()
    {
        $user=new UserModel();
		$companyid=$this->request->getPost('Id');
		$result["data"]=$user->display2($companyid);
		echo json_encode($result["data"]);
    }
}