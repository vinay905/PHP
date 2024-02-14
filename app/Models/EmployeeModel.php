<?php
namespace App\Models;
use CodeIgniter\Model;
class EmployeeModel extends Model
{
    public function checkmail($mail)
    {
        $builder=$this->db->table("admin");
        $builder->select("ID");
        $builder->where("Email",$mail);
        $query=$builder->get();
        if(count($query->getResultArray())==1)
        {
            $row=$query->getRowArray();
            return $row;
        }
        else
        {
            return false;
        }
    }

    public function updatedata($data,$id)
    {
        $builder=$this->db->table("admin");
        $builder->where('ID',$id);
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

    public function getdata($id)
    {
        $builder=$this->db->table("admin");
        $builder->select('*');
        $builder->where('ID',$id);
        $query=$builder->get();
        if($query)
        {
            $row=$query->getRowArray();
            return $row;
        }
        else
        {   
            return "Failed";
        }
    }
}