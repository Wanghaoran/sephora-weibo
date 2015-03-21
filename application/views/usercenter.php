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
        <!-- 查看自己的优惠券 -->
        <section class="screen" id="screen_8">
            <div class="c_header_box">
                <img src="<?=$this->config->base_url()?>public/images/head_cover.png" class="cover_img">
                <div class="custom_header">
                    <?php if($icon): ?>
                        <img id="loading_head" src="<?=$this->config->base_url()?>public/images/loading.gif">
                        <img id="c_header_img" style="display:none;" src="<?=$icon;?>" >
                    <?php else: ?>
                        <img id="loading_head" src="<?=$this->config->base_url()?>public/images/loading.gif">
                        <img id="c_header_img" style="display:none;" src="<?=$this->config->base_url()?>public/images/wenhao.png" >
                    <?php endif; ?>
                </div>
                <div class="c_header">
                    <img src="<?=$this->config->base_url()?>public/images/crown.png">
                </div>
            </div>
            <div class="s8_coupon_box" id="s8_coupon_box">
                <h3>我的优惠券</h3>
                <?php foreach($code_arr as $value): ?>
                    <div class="s8_txt_li">
                        <?php if(substr($value['code'], 1, 1) == 1): ?>
                            <h4>10元现金礼券<span><?=$value['code']?></span></h4>
                            <p>请在官网结账前输入兑换号使用。消费满100元即可抵扣，截止日期：2015年4月30日</p>
                        <?php elseif(substr($value['code'], 1, 1) == 3): ?>
                            <h4>30元现金礼券<span><?=$value['code']?></span></h4>
                            <p>请在官网结账前输入兑换号使用。消费满300元即可抵扣，截止日期：2015年4月30日</p>
                        <?php elseif(substr($value['code'], 1, 1) == 5): ?>
                            <h4>50元现金礼券<span><?=$value['code']?></span></h4>
                            <p>请在官网结账前输入兑换号使用。消费满500元即可抵扣，截止日期：2015年4月30日</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="btn_s8_home btn_common" id="btn_s8_home" href="http://www.sephora.cn?rsour=wechat&rmeth=social&rcamp=Besties&rcont=account">去官网使用</a>
            <!-- <div class="btn_s8_ques btn_common" id="btn_s8_ques">我也要出题</div> -->
            <div class="btn_back btn_s8_ques btn_common" id="btn_s8_back" onclick="location.href='<?=$this->config->base_url()?>wechat';">返回</div>
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
        //var aaa = window.location.hash;
        //alert(aaa)
        setTimeout(function(){
            $("#loading_head").hide();
            $("#c_header_img").show();
        },1000)
    })



</script>
</body>

</html>