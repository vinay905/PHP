<?php 
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
//query to check admin user and allow login///////////////////////
	public function login($data) 
    {
        $builder =$this->db->table('admin');
        $builder->select('password');
        $builder->select('username');              
        $builder->where('email',$data['Email']);     
        $query = $builder->get();
       
        if(count($query->getResultArray())==1)
        {
            $row=$query->getRowArray();
            if($row['password']==$data['Password'])
            {
                return $row;   
            }
            else
                return false;
        }
        else
            return false;
    }

//query to display company data//////////////////////////////////
    public function display()
    {
        $builder=$this->db->table('company');
        $builder->select('*');
        $query=$builder->get();
        if($query)
        {
            $row=$query->getResultArray();
            return $row;
        }
    }

//query to delete specific company data//////////////////////////
    public function datadelete($id)
    {
        $builder=$this->db->table('company');
        $builder->where('id', $id);
        $query=$builder->delete();
        if($query)
        {
            return true;
        }
        else
            return false;
    }

//query to display specific company data/////////////////////////
    public function userdata($id)
    {
        $builder=$this->db->table('company');
        $builder->select("*");
        $builder->where('id',$id);
        $query=$builder->get();
        if(count($query->getResultArray())==1)
        {
            $row=$query->getRowArray();
            return $row;
        }
        else
            return false;
    }

//query to update specific company data//////////////////////////
    public function dataupdate($id,$data)
    {   
        $builder=$this->db->table('company');
        $builder->where('id', $id);
        $query=$builder->update($data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

//query to insert company data///////////////////////////////////
    public function datainsert($data)
    {   
        $builder=$this->db->table('company');
        $query=$builder->insert($data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
//query to display employee data/////////////////////////////////
    public function empdisplay()
    {
        $builder=$this->db->table('employee');
        $builder->select('*');
        $query=$builder->get();
        if($query)
        {
            $row=$query->getResultArray();
            return $row;
        }
        else
        {
            return false;
        }
    }

//query to store employee data///////////////////////////////////
    public function empinsert($data)
    {
        $builder=$this->db->table('employee');
        $query=$builder->insert($data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

//query to display total registered company data and total no of employee who used service//////////////////////////////////
    public function counttotal()
    {
        $query2=$this->db->table('company')->countAllResults();
        $query=$this->db->table('employee')->countAllResults();
        $Total = array('Employee' => $query, 'Company'=>$query2);
        if($query2 || $query)
        {   
            return $Total;
        }
        else
        {
            return false;
        }
    }

    public function display2($id)
    {
        $builder =$this->db->table('company');
        $builder->select('company.*,company_address.address');
        $builder->where('company.id',$id);
        $builder->join("company_address",'company.id=company_address.company_id',"left");
        $query = $builder->get();
        if($query)
        {
            $row=$query->getResultArray();
            return $row;
        }
        else
        {
            return false;
        }
    }
}