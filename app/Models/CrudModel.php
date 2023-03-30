<?php
namespace App\Models;
 
class CrudModel extends \App\Models\BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function tesmodel()
    {
        return "testing";
    }
 
    public function trans_begin($database = "default")
    {
        $this->condb = $this->load->database($database, TRUE);
        $this->condb->trans_begin();
    }
 
    public function trans_complete()
    {
        if ($this->condb->trans_status() === FALSE) {
            $this->condb->trans_rollback();
        } else {
            $this->condb->trans_commit();
        }
    }
 
    public function get_all($table = "", $database = "default")
    {
        if (!empty($database)) {
            $this->condb = $this->load->database($database, TRUE);
            $this->condb->select('*');
            $this->condb->from($table);
            $query = $this->condb->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
 
    public function get_by_query_array($query = "", $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $querys = $this->condb->query($query);
 
            if (!empty($querys->getResultArray())) {
                return $querys->getResultArray();
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
 
    public function crttb($query = "", $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $this->condb->query($query);
            return "";
        } else {
            return "";
        }
    }
 
    public function get_by_query($query = "", $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $querys = $this->condb->query($query);
 
            if (!empty($querys->getResult())) {
                return $querys->getResult();
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
 
    public function add_return_id($table, $data, $database = "default")
    {
        if (!empty($database)) {
            // $this->condb =  $this->load->database($database, TRUE);
            // $this->condb->insert($table, $data);
            // return $this->condb->insertID();
            $db = db_connect($database);
            $builder = $db->table($table);
 
 
 
            $builder->insert($data);
            return   $db->insertID();
        } else {
            return "";
        }
    }
 
    public function add($table, $data, $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $this->condb = $this->condb->table($table);
            $query = $this->condb->insert($data);
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return "";
        }
    }
 
    public function add_batch($table, $data, $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $this->condb = $this->condb->table($table);
            $query = $this->condb->insertBatch($data);
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return "";
        }
    }
 
    public function updatetbl($table, $data, $where, $database = "default")
    {
        if (!empty($database)) {
            $this->condb = db_connect($database);
            $this->condb = $this->condb->table($table);
            $query = $this->condb->update($data, $where);
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return "";
        }
    }
}
 