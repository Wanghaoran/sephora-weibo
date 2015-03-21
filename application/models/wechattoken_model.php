<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wechattoken_model extends CI_Model {

    var $CI = '';

    public function __construct()
    {
        $this -> CI = &get_instance();
        parent::__construct();
        $this -> load -> database();
    }


    public function gettoken(){
        $this -> db -> where('name', 'access_token');
        $this -> db -> where('time >=', time() - 7000);
        $query = $this -> db -> get('sephora_wechattoken');
        return $query -> result_array();
    }

    public function querytoken(){

        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this -> CI -> config -> item('wechat_appid') . '&secret=' . $this -> CI -> config -> item('wechat_appsecret') . '');
        $res = json_decode($res, true);

        $token = $res['access_token'];

        if(!$token){
            return false;
        }

        $data = array(
            'value' => $token,
            'time' => time(),
        );
        $this -> db -> where('name', 'access_token');
        $this -> db -> update('sephora_wechattoken', $data);
        if(!$this -> db -> affected_rows()){
            return false;
        }

        return $token;
    }

    public function getticket(){
        $this -> db -> where('name', 'jsapi_ticket');
        $this -> db -> where('time >=', time() - 7000);
        $query = $this -> db -> get('sephora_wechattoken');
        return $query -> result_array();
    }

    public function queryticket($token){
        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $token . '&type=jsapi');
        $res = json_decode($res, true);

        $ticket = $res['ticket'];

        if(!$ticket){
            return false;
        }

        $data = array(
            'value' => $ticket,
            'time' => time(),
        );
        $this -> db -> where('name', 'jsapi_ticket');
        $this -> db -> update('sephora_wechattoken', $data);
        if(!$this -> db -> affected_rows()){
            return false;
        }
        return $token;

    }

}
