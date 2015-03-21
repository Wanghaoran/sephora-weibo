<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wechatuser_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function queryhave($openID){
        $query = $this -> db -> get_where('wechatuser', array('openid' => $openID), 1);
        return $query -> result_array();
    }


    public function queryhave2($id){
        $query = $this -> db -> get_where('wechatuser', array('id' => $id), 1);
        return $query -> result_array();
    }


    public function insertuser($openid, $nickname, $sex, $language, $city, $province, $country, $headimgurl){
        $data = array(
            'openid' => $openid,
            'nickname' => $nickname,
            'sex' => $sex,
            'language' => $language,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'headimgurl' => $headimgurl,
            'addtime' => date('Y-m-d H:i:s'),
        );

        $this -> db -> insert('wechatuser', $data);

        return $this->db->insert_id();
    }

}
