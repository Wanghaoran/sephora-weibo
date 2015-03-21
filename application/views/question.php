<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="apple-mobile-web-app-title" content="丝芙兰力挺你家闺蜜！让你们都美美哒！">
    <title>姐最满意自己哪一部分？速速来答题，赢走我的真金犒赏。</title>
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
        <!-- step1 选出想要问闺蜜的问题 -->
        <section class="screen" id="screen_2">
            <div class="s2_slogan">茫茫朋友圈<br>谁是最懂你的真命闺蜜？<br>找到她，一起赢取甜蜜好礼</div>
            <div class="s2_question" id="question">
                <h3>Step1</h3>
                <h4>选出你的问题</h4>
                <ul class="s2_q_list">
                    <?php foreach($q as $key => $value): ?>
                        <li data-list="<?php echo$key;?>"><span></span>问题<?php echo$key;?>：<?php echo$value['question'];?></li>
                    <?php endforeach; ?>
                    <li class="custom"><a href="<?=$this->config->base_url()?>customquestion">姐要自己出题！</a></li>
                </ul>
                <div class="s2_sure" id="s2_sure">
                    <img src="<?=$this->config->base_url()?>public/images/btn_sure.jpg">
                </div>
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
        $("#s2_sure").click(function() {
            var active_val = $(".s2_q_list>li.active");
            var ques = active_val.data("list");
            console.log(ques)
            if (active_val.length > 0) { //成功选择后
                location.href='<?=$this->config->base_url()?>answer?q=' + ques;
            } else {
                alert("请选择一个问题。");  //当玩家没有做任何选择，就点击确定的情况
            }
        })
        //var aaa = window.location.hash;
        //alert(aaa)
    })
</script>
</body>

</html>