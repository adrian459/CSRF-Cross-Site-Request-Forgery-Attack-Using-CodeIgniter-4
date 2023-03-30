<?php 
namespace App\Models;
use App\Models\CrudModel;
class CSRF extends \App\Models\BaseModel
{
    public function __construct()
    {
        $this->crud = new CrudModel();
    }
    public function InsertData($data, $table)
    {
        $res = $this->crud->add($table, $data);
    }
    public function UserList()
    {
        $res = $this->crud->get_by_query_array('SELECT * FROM user_list');
        return $res;   
    }
    public function UpdateData($data, $UID)
    {
        $NewData = array(
            'username'    => $data['username'],
            'password' => $data['password']
        );
        $where = "UID = '".$UID."'";
        $res = $this->crud->updatetbl("user_list", $NewData, $where);
    }
    public function GetPassword($where)
    {
        //echo $where;
        $res = $this->crud->get_by_query_array('SELECT password FROM user_list WHERE username="'.$where.'" ');
        return $res;
    }
    public function UpdatePassword($username,$password)
    {
        $NewData = array(
            'password' => $password
        );
        $where = "username = '".$username."'";
        $res = $this->crud->updatetbl("user_list", $NewData, $where);
    }
    public function CheckUser($username,$password)
    {
        $res = $this->crud->get_by_query_array('SELECT UID FROM user_list WHERE username = "'.$username.'" AND password = "'.$password.'"');
        return $res;
    }

}