<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="apple-mobile-web-app-title" content="丝芙兰力挺你家闺蜜！让你们都美美哒！">
    <title>真金犒赏真闺蜜。速速来答题，赢走我的真金犒赏。丝芙兰力挺你家闺蜜！让你们都美美哒！</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/css/reset.css">
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/css/common.css">
    <link rel="stylesheet" type="text/css" href="<?=$this->config->base_url()?>public/css/main.css">



</head>
<body>
<div class="weixin_share_hidden">
    <img src="<?=$this->config->base_url()?>public/images/share_icon.jpg">
</div>
<div class="main">
    <div class="content" id="content" data-q="n" data-style="questioner" data-a="n" data-share="n">
        <!-- step2选出对应答案 -->
        <section class="screen" id="screen_3">
            <div class="s3_question" id="question">
                <h3>Step2</h3>
                <h4>选出你的答案</h4>
                <h5 id="s3_ques_title"><?php echo$question;?></h5>
                <ul class="s3_q_list">
                    <?php foreach($answer_arr as $key => $value): ?>
                        <li data-list="<?php echo$key;?>"><span></span><?php echo$key;?>：<?php echo$value;?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="s3_sure top120" id="s3_sure">
                    <img src="<?=$this->config->base_url()?>public/images/btn_sure.jpg">
                </div>
                <div class="s3_back top120" id="s3_back">
                    <a href="javascript:history.go(-1);"><img src="<?=$this->config->base_url()?>public/images/btn_back.jpg"></a>
                </div>
            </div>
            <div class="libao s3_libao">
                <img src="<?=$this->config->base_url()?>public/images/gift.png">
            </div>
        </section>
    </div>
</div>



<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/zepto.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/fastclick.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/zepto.cookie.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/common.js"></script>
<script type="text/javascript" src="<?=$this->config->base_url()?>public/js/main.js"></script>
<script type="text/javascript">
    $(function(){
        Sephora.init();
        $("#s3_sure").click(function() {
            var active_val = $(".s3_q_list>li.active");
            var ques = active_val.data("list");
            console.log(ques)
            if (active_val.length > 0) { //成功选择后
                location.href='<?=$this->config->base_url()?>creatquestion?q=<?php echo $q;?>&a=' + ques;
            } else {
                alert("请选择一个答案。");  //当玩家没有做任何选择，就点击确定的情况
            }
        })
        //var aaa = window.location.hash;
        //alert(aaa)
    })
</script>
</body>

</html>