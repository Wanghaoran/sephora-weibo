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
        <!-- 中大奖的情况 显示结果 -->
        <section class="screen" id="screen_3">
            <div class="s3_question" id="question">
                <h3>Step2</h3>
                <h4>姐要自己出题</h4>
                <div class="s32_form">
                    <form action="<?=$this->config->base_url()?>creatquestion" method="post" id="form" name="form">
                        <input type="text" value="" name="ques" class="s32_ques c_input" placeholder="问题"/>
                        <ul class="s32_q_list clearFix">
                            <li data-list="1"><span></span><input type="text" value="" name="ans1" class="c_input" placeholder="答案一"/></li>
                            <li data-list="2"><span></span><input type="text" value="" name="ans2" class="c_input"  placeholder="答案二"/></li>
                            <li data-list="3"><span></span><input type="text" value="" name="ans3" class="c_input"  placeholder="答案三"/></li>
                        </ul>
                        <input type="hidden" name="trueanswer" value="">
                    </form>
                </div>
                <div class="s3_sure" id="s3_sure">
                    <a onclick="checkup();"><img src="<?=$this->config->base_url()?>public/images/btn_sure.jpg"></a>
                </div>
                <div class="s3_back" id="s3_back">
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
        $(".s32_q_list>li").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        })
    })
</script>
<script>
    var checkup = function(){
        if(!$("input[name='ques']").val()){
            alert('问题不能为空！');
            return;
        }
        if(!$("input[name='ans1']").val()){
            alert('答案一不能为空！');
            return;
        }
        if(!$("input[name='ans2']").val()){
            alert('答案二不能为空！');
            return;
        }
        if(!$("input[name='ans3']").val()){
            alert('答案三不能为空！');
            return;
        }
        var active_val = $(".s32_q_list>li.active");
        var ques = active_val.data("list");

        if (active_val.length > 0) { //成功选择后
            $("input[name='trueanswer']").val(ques);
        }else{
            alert('请选择一个正确答案！');
            return;
        }

        $('#form').submit();
    }
</script>
</body>

</html>