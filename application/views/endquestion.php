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
        <!-- 自己出题抽奖 显示结果 -->
        <section class="screen" id="screen_9">
            <div class="s9_box">
                <img class="block" src="<?=$this->config->base_url()?>public/images/block.png">
                <div class="s9_gift_cost" id="s9_gift_cost"><span class="coupon_cost"><?=$ttype?></span>元现金券</div>
                <?php if(substr($code, 1, 1) == 1): ?>
                    <div class="s9_gift_desc">使用条件：<br>至丝芙兰官网消费<br>满100元即可抵扣<br>截止日期：<br>2015年4月30日</div>
                <?php elseif(substr($code, 1, 1) == 3): ?>
                    <div class="s9_gift_desc">使用条件：<br>至丝芙兰官网消费<br>满300元即可抵扣<br>截止日期：<br>2015年4月30日</div>
                <?php elseif(substr($code, 1, 1) == 5): ?>
                    <div class="s9_gift_desc">使用条件：<br>至丝芙兰官网消费<br>满500元即可抵扣<br>截止日期：<br>2015年4月30日</div>
                <?php endif; ?>
                <div class="s9_txt" id="s9_txt">真可惜，竟然没有抽中大奖<br>还好有丝芙兰<span class="coupon_cost"><?=$ttype?></span>元现金券送上<br>优惠券代码：<span class="coupon_code"><?=$code?></span></div>
            </div>
            <a class="btn_s9_home btn_common" id="btn_s9_home" href="http://www.sephora.cn?rsour=wechat&rmeth=social&rcamp=Besties&rcont=luckydraw">去官网使用</a>
            <div class="btn_s9_ques btn_common" id="btn_s9_ques" onclick="location.href='<?=$this->config->base_url()?>question';">出题再抽</div>
            <a class="lookup_p s_link" href="<?=$this->config->base_url()?>complete/<?=$q?>">查看结果</a>
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
    })
</script>
</body>

</html>