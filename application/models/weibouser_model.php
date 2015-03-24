<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class weibouser_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function queryhave($openID){
        $query = $this -> db -> get_where('weibouser', array('weiboid' => $openID), 1);
        return $query -> result_array();
    }


    public function queryhave2($id){
        $query = $this -> db -> get_where('weibouser', array('id' => $id), 1);
        return $query -> result_array();
    }


    public function insertuser($weiboid, $nickname, $headimgurl){
        $data = array(
            'weiboid' => $weiboid,
            'nickname' => $nickname,
            'headimgurl' => $headimgurl,
            'addtime' => date('Y-m-d H:i:s'),
        );

        $this -> db -> insert('weibouser', $data);

        return $this->db->insert_id();
    }

    public function getnum(){
        $now = $this->db->count_all_results('weibouser');
        return $now;
    }

}
