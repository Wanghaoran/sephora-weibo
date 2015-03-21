<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {



	public function index()
	{
        $this->load->view('weibo_index');

    }

    public function wechat_index(){
        $this->load->view('wechat_index');
    }

    public function terms(){
        $this->load->view('terms');
    }

    public function oauth2_authorize(){

        $q = $_GET['q'];

        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this -> config -> item('wechat_appid') . '&redirect_uri=' . urlencode($this->config->base_url() . 'index.php/welcome/oauth2_authorize') . '&response_type=code&scope=snsapi_userinfo&state=' . $q . '#wechat_redirect';
            redirect($token_url);
        }

        //get token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this -> config -> item('wechat_appid') . '&secret=' . $this -> config -> item('wechat_appsecret') . '&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //get user info
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';
        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }

        //select user
        $this -> load -> model('wechatuser_model');
        if($query_result = $this -> wechatuser_model -> queryhave($result_arr['openid'])){
            //write session
            $this->session->set_userdata('sephora_wechat_id', $query_result[0]['id']);
        }else{
            //create user
            if(!$insert_id = $this -> wechatuser_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //write session
                $this->session->set_userdata('sephora_wechat_id', $insert_id);
            }
        }

        redirect('user/' . $_GET['state']);

    }

    public function oauth2_authorize2(){

        $q = $_GET['q'];

        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this -> config -> item('wechat_appid') . '&redirect_uri=' . urlencode($this->config->base_url() . 'index.php/welcome/oauth2_authorize2') . '&response_type=code&scope=snsapi_userinfo&state=' . $q . '#wechat_redirect';
            redirect($token_url);
        }

        //get token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this -> config -> item('wechat_appid') . '&secret=' . $this -> config -> item('wechat_appsecret') . '&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //get user info
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';
        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }

        //select user
        $this -> load -> model('wechatuser_model');
        if($query_result = $this -> wechatuser_model -> queryhave($result_arr['openid'])){
            //write session
            $this->session->set_userdata('sephora_wechat_id', $query_result[0]['id']);
        }else{
            //create user
            if(!$insert_id = $this -> wechatuser_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //write session
                $this->session->set_userdata('sephora_wechat_id', $insert_id);
            }
        }

        redirect('q/' . $_GET['state']);

    }

    public function oauth2_authorize3(){

        $q = $_GET['q'];

        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this -> config -> item('wechat_appid') . '&redirect_uri=' . urlencode($this->config->base_url() . 'index.php/welcome/oauth2_authorize2') . '&response_type=code&scope=snsapi_userinfo&state=' . $q . '#wechat_redirect';
            redirect($token_url);
        }

        //get token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this -> config -> item('wechat_appid') . '&secret=' . $this -> config -> item('wechat_appsecret') . '&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //get user info
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';
        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }

        //select user
        $this -> load -> model('wechatuser_model');
        if($query_result = $this -> wechatuser_model -> queryhave($result_arr['openid'])){
            //write session
            $this->session->set_userdata('sephora_wechat_id', $query_result[0]['id']);
        }else{
            //create user
            if(!$insert_id = $this -> wechatuser_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //write session
                $this->session->set_userdata('sephora_wechat_id', $insert_id);
            }
        }

        redirect('welcome/' . $_GET['state']);

    }

    public function question($q){

        $this->load->helper('url');

        if(!$this->session->userdata('sephora_wechat_id')){
            redirect('welcome/oauth2_authorize2?q=' . $q);
        }

        //query question uid
        $this -> load -> model('question_model');
        $uid = $this -> question_model -> getuid($q);

        //myself
        if($this->session->userdata('sephora_wechat_id') == $uid){
            redirect('complete/' . $q);
        }

        //check user
        $this -> load -> model('questionuser_model');
        if($this -> questionuser_model -> checkuser($q, $uid)){
            redirect('errorpage');
        }

        //query question
        $question = $this -> question_model -> getquestion($q);
        $data = array(
            'question' => $question,
            'q' => $q,
        );

        $this->load->view('questions', $data);
    }

    public function trueanswer($q){
        $this->load->helper('url');
        if(!$this->session->userdata('sephora_wechat_id')){
            redirect('welcome/oauth2_authorize2?q=' . $q);
        }

        //check user
        $this -> load -> model('questionuser_model');
        if($this -> questionuser_model -> checkuser($q, $this->session->userdata('sephora_wechat_id'))){
            redirect('errorpage');
        }

        //query question code
        $this -> load -> model('question_model');
        $code_info = $this -> question_model -> getquestioncode($q);

        //no code
        if($code_info['10code'] == 0 && $code_info['30code'] == 0 && $code_info['50code'] == 0){
            redirect('welcome/nocode');
        }

        //create code pool
        $code_pool = array();
        for($i=0; $i<$code_info['10code']; $i++){
            $code_pool[] = 10;
        }
        for($i=0; $i<$code_info['30code']; $i++){
            $code_pool[] = 30;
        }
        for($i=0; $i<$code_info['50code']; $i++){
            $code_pool[] = 50;
        }
        $ctype = $code_pool[array_rand($code_pool)];

        //get code
        $this -> load -> model('code_model');
        $uid = $this->session->userdata('sephora_wechat_id');
        $ip = $this->input->ip_address();
        $code = $this -> code_model -> getcode($ctype, 3, $uid, $q, $ip);

        //rec code question user
        $this -> questionuser_model -> insertinfo($q, $uid, $ctype, $code);

        //update question code num
        $num = $code_info[$ctype.'code'] - 1;
        $this -> question_model -> updatequestioncode($q, $ctype, $num);


        $data = array(
            'code' => $code,
            'ctype' => $ctype,
            'q' => $q,
        );
        $this->load->view('trueanswer', $data);

    }


    public function completequestion($q){
        $this->load->helper('url');
        if(!$this->session->userdata('sephora_wechat_id')){
            redirect('welcome/oauth2_authorize2?q=' . $q);
        }

        $uid = $this->session->userdata('sephora_wechat_id');

        //read my code
        $this -> load -> model('code_model');
        $code10 = $this -> code_model -> selectmycode(10, $uid);
        $code30 = $this -> code_model -> selectmycode(30, $uid);
        $code50 = $this -> code_model -> selectmycode(50, $uid);

        //user icon
        $this -> load -> model('questionuser_model');

        $icon_arr = $this -> questionuser_model -> selectusericon($q);

        @$re_arr = $icon_arr[array_rand($icon_arr)];

        @$icon = $re_arr['headimgurl'];
        @$name = $re_arr['nickname'];
        $num = $this -> questionuser_model -> selectusernum($q);

        $data = array(
            'code_arr' => array_merge($code10, $code30, $code50),
            'icon' => $icon,
            'name' => $name,
            'num' => $num,
        );

        $this->load->view('completequestion', $data);

    }

    public function nocode(){
        $this->load->view('nocode');
    }

    public function errorpage(){
        $this->load->view('errorpage');

    }

    public function usercenter(){

        if(!$this->session->userdata('sephora_wechat_id')){
            redirect('welcome/oauth2_authorize3?q=usercenter');
        }

        $uid = $this->session->userdata('sephora_wechat_id');

        //read my code
        $this -> load -> model('code_model');
        $code10 = $this -> code_model -> selectmycode(10, $uid);
        $code30 = $this -> code_model -> selectmycode(30, $uid);
        $code50 = $this -> code_model -> selectmycode(50, $uid);


        $this -> load -> model('wechatuser_model');
        $user_info = $this -> wechatuser_model -> queryhave2($uid);

        $data = array(
            'code_arr' => array_merge($code10, $code30, $code50),
            'icon' => $user_info[0]['headimgurl']
        );
        $this->load->view('usercenter', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */