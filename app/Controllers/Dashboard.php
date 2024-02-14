<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
class Dashboard extends BaseController
{


//function to load dashboard page/////////////////////////////////////////////////////////	
	public function index()
	{	
		$session= session();
		if($session->has('logged_in')==true)
		{
			$user=new UserModel();
			$result['data']= $user->counttotal();
			return view("Dashboard",$result);
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}

	}

//function to logout admin////////////////////////////////////////////////////////////////
	public function adminlogout()
	{
		$session= session();
		$session->destroy();
		return redirect()->to(site_url("admin"));
	}


//function to display comapany data////////////////////////////////////////////////////////
	public function Companylist()
	{	
		$session= session();
		if($session->has('logged_in')==true)
		{
			$user=new UserModel();
			$result['data'] = $user->display();
			return view("Companylist",$result);
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}

	}


//function to display newcompany page//////////////////////////////////////////////////////
	public function Adddata()
	{	
		$session= session();
		if($session->has('logged_in')==true)
		{
			return view("newcompany");
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}
	}


//function to delete data/////////////////////////////////////////////////////////
	public function deletedata($id)
	{	
        $session= session();
        if($session->has('logged_in')==true)
		{
	        $user = new UserModel();
	        $data = $user->datadelete($id);
	        if($data)
	        {
	        	return redirect()->route("admin/list")->with("response", "Data Deleted Successfully");
	        }
	        else
	        {
	        	return redirect()->route("admin/list")->with("response", "Data Deletion Failed ");
	        }
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		} 
    } 


//function to load updatedata page/////////////////////////////////////////////////////////
    public function editdata($id)
	{	
		$session= session();
		if($session->has('logged_in')==true)
		{
			$user=new UserModel();
			$result['data'] = $user->userdata($id);
			return view("Updatedata",$result);
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}
    }    


//function to update data/////////////////////////////////////////////////////////
	public function updatedata($id)
	{	
		$session= session();
		if($session->has('logged_in')==true)
		{
			$user=new UserModel();
			$fetch = $user->userdata($id);
			$imageFile = $this->request->getFile('file');
			if($imageFile->isValid() && !$imageFile->hasMoved())
			{	
				$oldimage=$fetch['logo'];
				if(file_exists("public/images/".$oldimage)&&(strlen($oldimage)!=0))
				{
					unlink("public/images/".$oldimage);
				}

				$newname=$imageFile->getRandomName();
				$imageFile->move('public/images/',$newname);
			}
			else
			{
				$newname=$fetch['logo'];
			}
			$data=array(
				"company_name"=>$this->request->getPost('companyname'),
				"website"=>$this->request->getPost('companysite'),
				"speciality"=>$this->request->getPost('speciality'),
				"content"=>$this->request->getPost('content'),
				"logo"=>$newname,
				"updated_at"=>date('Y-m-d H:i:s')
				);
			$result= $user->dataupdate($id,$data);
			if($result==true)
			{
				return redirect()->route("admin/list")->with("response", "Data Updated Successfully ");
			}
			else
			{
				return redirect()->route("admin/list")->with("response", "Data Updation Failed");
			}
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}
    }


//function to insert new data////////////////////////////////////////////////////////
    public function insertdata()
    {
    	$session= session();
    	if($session->has('logged_in')==true)
		{
	    	$user=new UserModel();
			$imageFile = $this->request->getFile('file');
			if($imageFile->isValid() && !$imageFile->hasMoved())
			{	
				// $filepath="/public/images/";
				$newname=$imageFile->getRandomName();
				$imageFile->move('public/images/',$newname);
				$filepath=$newname;
			}
			$data=array(
				"company_name"=>$this->request->getPost('companyname'),
				"website"=>$this->request->getPost('companysite'),
				"speciality"=>$this->request->getPost('speciality'),
				"content"=>$this->request->getPost('content'),
				"logo"=>$filepath
				);
			$result=$user->datainsert($data);
			if($result==true)
			{
				return redirect()->route("admin/list")->with("response", "Data Inserted Successfully");
			}
			else
			{
				return redirect()->route("admin/list")->with("response", "Data Insertion Failed");	
			}
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}
	}


//function to display employee hsitory data////////////////////////////////////////////////////////
	public function employeedata()
	{	$session= session();
		if($session->has('logged_in')==true)
		{
			$user=new UserModel();
			$result['data'] = $user->empdisplay();
			return view("Employeelist",$result);
		}
		else
		{
			return redirect()->route("admin")->with("response", "Session Expired! Please Login again");
		}
	}
}