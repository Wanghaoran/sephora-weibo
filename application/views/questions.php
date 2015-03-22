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
    <!-- 可以直接 在 data-a      标签设置答案属性 @后端 -->
    <div class="content" id="content" data-q="n" data-style="questioner" data-a="<?=$question['true']?>" data-share="n">
        <!-- 回答问题  -->
        <section class="screen" id="screen_10">
            <div class="s10_question" id="question">
                <h3>妞，速速来回答我的小秘“蜜”</h3>
                <h4>答对有奖</h4>
                <h5 id="s10_ques_title"><?=$question['q']?></h5>
                <ul class="s10_q_list" id="s10_q_list">
                    <li data-list="1"><span></span>a：<?=$question['a1']?></li>
                    <li data-list="2"><span></span>b：<?=$question['a2']?></li>
                    <li data-list="3"><span></span>c：<?=$question['a3']?></li>
                </ul>
                <div class="s10_sure" id="s10_sure">
                    <img src="<?=$this->config->base_url()?>public/images/btn_sure.jpg">
                </div>
            </div>
            <!-- 答错问题提示 -->
            <div class="answer_error dn" id="answer_error">
                <div class="error_box">
                    <p>有没有搞错！<br>姐准你重新来过！</p>
                    <div class="error_close">
                        <img src="<?=$this->config->base_url()?>public/images/btn_close.jpg">
                    </div>
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
        $("#s10_sure").click(function() {
            // 可以直接 在 data-a标签设置答案属性
            var answer = $("#content").attr("data-a");
            var This = this;
            var rel_val = $("#s10_q_list>li.active").attr("data-list");
            if (rel_val == answer) {
                location.href= '<?=$this->config->base_url()?>trueanswer/<?=$q;?>' //答案正确,获取优惠券 @后端
            } else {
                $("#answer_error").removeClass("dn"); //答案不正确  弹出提示
            }
        })
        $(".error_close").click(function() {
            $("#answer_error").addClass("dn");
        })
    })
</script>
</body>

</html>