<?php
namespace App\Controllers;
use App\Models\CSRF;
class Home extends BaseController
{
    public function __construct()
    {
        $this->model = new CSRF();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function Login()
    {
        return view('login');
    }
    public function HomePage()
    {
        //print_r($_SESSION);
        if(!empty($_SESSION['logged_id'])){    
            return view('HomePage');
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function index()
    {
        return view('CSRF');
        //echo "Hello Tans";
    }
    public function ListView()
    {
        $data['result'] = $this->model->UserList();
        return view('update', $data);
    }
    public function SubmitData()
    {
        //$data['UID'] = "CSRF".uniqid();
        $data['username'] = $this->request->getPost('username');
        $data['password'] = $this->request->getPost('password');
        $response = $this->model->CheckUser($data['username'],$data['password']);
        if(!empty($response)){
            $userData = array(
                'username' => $data['username'],
                'password' => $data['password'],
                'logged_id' => TRUE
            );
            //$_SESSION['SESSION_LIST'] = $userData['logged_id'];
            $this->session->set($userData); //30 sec only
            return redirect()->to(base_url('/homepage'));
        }else{
            echo "Wrong Username or Password";
        }
        //return redirect()->to(base_url('/'));
    }
    public function UpdateData()
    {
        $data['UID'] = $this->request->getPost('UID');
        $data['username'] = $this->request->getPost('username');
        $data['password'] = $this->request->getPost('password');
        $this->model->UpdateData($data, $data['UID']);
        return redirect()->to(base_url('/list'));
    }
    // public function ExecuteCSRF()
    // {
    //     $uri = new \CodeIgniter\HTTP\URI('http://localhost:8080');
    //     //$uri->setQuery('SELECT * FROM user_list');
    //     echo $uri->getQuery('SELECT * FROM user_list');
    // }
    public function ExecuteCSRF()
    {
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI((string)$uri);
        $str = $uri->getQuery();
        $pattern = '/username=/i'; //RegEx
        $str = preg_replace($pattern, '',$str);
        print_r($this->model->GetPassword(str_replace('%22','',$str)));
        //print_r($this->model->GetPassword());        
    }
    public function UpdateCSRF()
    {
        //Malicious URL : http://localhost:8080/ExecuteUpdate?username=”Tanida”&password=”Arman”
        if(!empty($_SESSION['username'])){
            $uri = current_url(true);
            $uri = new \CodeIgniter\HTTP\URI((string)$uri);
            $str = $uri->getQuery(['only' => ['username']]);//Cari query yang memiliki key username (username="key")
            $pattern = '/username=/i'; //RegEx
            $str = preg_replace($pattern, '',$str);
            $str2 = $uri->getQuery(['only' => ['password']]);//Cari query yang memiliki key password(password="key")
            $pattern2 = '/password=/i'; //RegEx
            $str2 = preg_replace($pattern2, '',$str2);
            $this->model->UpdatePassword(str_replace('%22','',$str),str_replace('%22','',$str2));
            echo "You Have Been hacked";    
        }else{
            echo "No Sessions Available";
        }
    }
    public function AttackWeb()
    {
        return view('attack');
    }
    public function PostCSRF()
    {
        if($_SESSION['logged_id']){
            $data['username'] = $this->request->getPost('username');
            $data['password'] = $this->request->getPost('password');
            $uri = new \CodeIgniter\HTTP\URI('http://localhost:8080/ExecuteUpdate?username="'.$data['username'].'"&password="'.$data['password'].'"');
            $str = $uri->getQuery(['only' => ['username']]);//Cari query yang memiliki key username (username="key")
            $pattern = '/username=/i'; //RegEx
            $str = preg_replace($pattern, '',$str);
            $str2 = $uri->getQuery(['only' => ['password']]);//Cari query yang memiliki key password(password="key")
            $pattern2 = '/password=/i'; //RegEx
            $str2 = preg_replace($pattern2, '',$str2);
            $this->model->UpdatePassword(str_replace('%22','',$str),str_replace('%22','',$str2));
            echo "You Have been hacked";
        }else{
            echo "No sessions available";
        }
    }
}
