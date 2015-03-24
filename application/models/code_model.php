<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function getcode($ctype, $ttype, $uid, $qid, $ip){
        $query = $this -> db -> get_where('code' . $ctype, array('type' => 1), 1);
        $a = $query -> result_array();
        if(!$a){
            return false;
        }
        //update
        $data = array(
            'type' => $ttype,
            'time' => time(),
            'uid' => $uid,
            'qid' => $qid,
            'ip' => $ip,
        );
        $this -> db -> where('id', $a[0]['id']);
        $this -> db -> update('code' . $ctype, $data);
        $re = $this -> db -> affected_rows();
        if(!$re){
            return false;
        }
        return $a[0]['code'];
    }

    public function selectmycode($ctype, $uid){
        $query = $this -> db -> get_where('code' . $ctype, array('uid' => $uid));
        return $query -> result_array();
    }

    //已使用的优惠券
    public function getcodenum($ctype, $type){
        if($type == 1){
            $this -> db -> where('type !=', 1);
        }else{
            $this -> db -> where('type', 1);
        }
        $now = $this->db->count_all_results('code' . $ctype);
        return $now;
    }
}
