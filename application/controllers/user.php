<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function _remap($method, $params = array()){

        //check authorization
        if(!$this->session->userdata('sephora_wechat_id')){
            $this->load->helper('url');
            /*
            if($method == 'usercenter'){
                redirect('welcome/oauth2_authorize?q=usercenter');
            }else{
                redirect('welcome/oauth2_authorize?q=question');

            }
            */
            redirect('welcome/oauth2_authorize?q=question');

        }

        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

    public function question(){

        $data = array(
            'q' => $this -> config -> item('questions'),
        );

        $this->load->view('question', $data);
    }

    public function answer(){

        $q = $this->input->get('q');

        $data = array(
            'answer_arr' => $this -> config -> item('questions')[$q]['answer'],
            'question' => $this -> config -> item('questions')[$q]['question'],
            'q' => $q,
        );
        $this->load->view('answer',$data);
    }

    public function customquestion(){
        $this->load->view('customquestion');
    }

    public function creatquestion(){
        $this -> load -> model('question_model');
        if(!empty($_POST)){
            //customquestion
            $uid = $this->session->userdata('sephora_wechat_id');
            $q = $this->input->post('ques');
            $a1 = $this->input->post('ans1');
            $a2 = $this->input->post('ans2');
            $a3 = $this->input->post('ans3');
            $true = $this->input->post('trueanswer');
        }else{
            $uid = $this->session->userdata('sephora_wechat_id');
            $q = $this -> config -> item('questions')[$this->input->get('q')]['question'];
            $a1 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][1];
            $a2 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][2];
            $a3 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][3];
            $true = $this->input->get('a');
        }
        $qid = $this -> question_model -> insertquestion($uid, $q, $a1, $a2, $a3, $true);
        if(!$qid){
            die('<h1>Creat Question Fail!</h1>');
        }


        //get wechat access_token
        $this -> load -> model('wechattoken_model');
        $token_arr = $this -> wechattoken_model -> gettoken();
        if(!$token_arr){
            $token = $this -> wechattoken_model -> querytoken();
        }else{
            $token = $token_arr[0]['value'];
        }

        if(!$token){
            die('<h1>Get Token Fail!</h1>');
        }

        //get wechat ticket
        $ticket_arr = $this -> wechattoken_model -> getticket();
        if(!$ticket_arr){
            $ticket = $this -> wechattoken_model -> queryticket($token);
        }else{
            $ticket = $ticket_arr[0]['value'];
        }

        if(!$ticket){
            die('<h1>Get Ticket Fail!</h1>');
        }

        //signature
//        $timestamp = time();
//        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//        $wxnonceStr = "sephora";
//        $wxticket = $ticket;
//        $wx_str = 'jsapi_ticket=' . $wxticket . '&noncestr=' . $wxnonceStr . '&timestamp=' . $timestamp . '&url=' . $url;
//        $wxSha1 = sha1($wx_str);
        $data = array(
//            'timestamp' => $timestamp,
//            'nonceStr' => $wxnonceStr,
//            'signature' => $wxSha1,
            'qid' => $qid,
            'q' => $q,
        );
//        $this->load->view('creatquestion', $data);
        $this->load->view('startgift', $data);
    }



    public function endquestion($qid){
        $this->load->helper('url');

        //check question type
        $this -> load -> model('question_model');
        $qtype = $this -> question_model -> gettype($qid);
        if($qtype != 1){
            redirect('user/usercenter');
        }

        //get 30code
        $this -> load -> model('code_model');
        $uid = $this->session->userdata('sephora_wechat_id');
        $ip = $this->input->ip_address();
        $ttype = 30;
        $code = $this -> code_model -> getcode($ttype, 2, $uid, $qid, $ip);

        if(!$code){
            //again
            $code = $this -> code_model -> getcode($ttype, 2, $uid, $qid, $ip);
        }

        if(!$code){
            redirect('user/usercenter');
        }

        //update question type
        $this -> question_model -> updatetype($qid);

        $data = array(
            'ttype' => $ttype,
            'code' => $code,
            'q' => $qid,
        );

        $this->load->view('endquestion', $data);

    }


    //share_weibo
    public function share_weibo(){

        $q = $_GET['q'];

        $this -> load -> model('question_model');
        $question = $this -> question_model -> getquestion($q);


        $user_friend = $this -> _bilateral($this->session->userdata('token')['access_token'], $this->session->userdata('token')['uid']);

        $name = '';

        if(count($user_friend['users']) >= 3){
            $total = 3;
        }else{
            $total = count($user_friend['users']);
        }

        for($i = 0; $i < $total; $i++){
            $name .= '@' . $user_friend['users'][$i]['screen_name'];
        }

        $url = 'http://service.weibo.com/share/share.php?url=' . urlencode($this->config->base_url() . 'q/' . $q) . '&type=button&language=zh_cn&appkey=2463278834&title=＃真金犒赏真闺蜜＃' . $question['q'] . $name . '，速速来答题，应走我的真金犒赏。丝芙兰力挺你家闺蜜！让你们都美哒哒！&searchPic=false&style=simple';

        $this->load->helper('url');
        redirect($url);


//        $this->load->view('startgift', $data);
    }

    //微博API － 互粉列表
    public function _bilateral($asstoken, $uid){
        $url = 'https://api.weibo.com/2/friendships/friends/bilateral.json?access_token=' . $asstoken . '&uid=' . $uid;
        $json_result = file_get_contents($url);
        $result = json_decode($json_result, true);
        return $result;
    }



    public function startgift($qid){
        $data = array(
            'qid' => $qid,
        );
        $this->load->view('startgift', $data);

    }






}

/* End of file user.php */
/* Location: ./application/controllers/user.php */