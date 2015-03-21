/**
 *
 * @version 1.0.1
 * @codingstandard js
 * @author  Lemons Lin
 * @copyright Sephora
 * @license MIT License
 */
var platform = navigator.platform;
var ua = navigator.userAgent;
var ios = /iPhone|iPad|iPod/.test(platform) && ua.indexOf("AppleWebKit") > -1;
var andriod = ua.indexOf("Android") > -1;


var quesJson = {
	"q1": {
		"title": "姐最满意自己哪一部分？",
		"answer": {
			"a1": "a: 前凸后翘",
			"a2": "b：颜值爆表",
			"a3": "c：姐哪儿都美"
		}
	},
	"q2": {
		"title": "哪种男生是姐的菜？",
		"answer": {
			"a1": "a: 前凸后翘2222",
			"a2": "b：颜值爆表",
			"a3": "c：姐哪儿都美"
		}
	},
	"q3": {
		"title": "姐是什么Cup？",
		"answer": {
			"a1": "a: 前凸后翘3333",
			"a2": "b：颜值爆表",
			"a3": "c：姐哪儿都美"
		}
	},
	"q4": {
		"title": "我在朋友圈是什么卦？",
		"answer": {
			"a1": "a: 前凸后翘4444",
			"a2": "b：颜值爆表",
			"a3": "c：姐哪儿都美"
		}
	},
	"q5": {
		"title": "该不该看男人手机？",
		"answer": {
			"a1": "a: 前凸后翘5555",
			"a2": "b：颜值爆表",
			"a3": "c：姐哪儿都美"
		}
	}
}

var Sephora = {
	init: function() {
		this.setAnswer() //设置基本
		this.setBtnCtrl(); //设置基本按键功能
		this.setQuestion(); //设置问题功能
		this.setShare() //设置分享
		this.getGift() //获取礼物即 优惠券
		this.getCookieCode(); //获取cookie中的优惠券代码
		FastClick.attach(document.body); //快速点击
	},
	//设置所有页面控制
	setBtnCtrl: function() {
		//设置问题去S2
		$("#s1_btn_gift").click(function() {
				$("#screen_2").removeClass("dn").siblings().addClass("dn");
			})
			//查看优惠券
		$("#s1_my_gift").click(function() {
				$("#screen_8").removeClass("dn").addClass("highZindex");
			})
			//返回按钮
		$(".btn_back").click(function() {
				$(this).parents("section").removeClass("highZindex").addClass("dn");
			})
			//免责条款和 活动规则 -->S7
		$("#s1_act_law").click(function() {
				$("#screen_7").removeClass("dn").addClass("highZindex");
			})
			//返回S2 选择问题
		$("#s3_back").click(function() {
			$("#screen_2").removeClass("dn").siblings().addClass("dn");
		});
	},
	setQuestion: function() {
		//S2 选择绑定
		$(".s2_q_list>li").click(function() {
				var This = $(this);
				This.addClass("active").siblings().removeClass("active");
			})
			//S3 选择绑定
		$(".s3_q_list").on("click", "li", function() {
				var This = $(this);
				This.addClass("active").siblings().removeClass("active");
			})
			//选择完问题
		$("#s2_sure").click(function() {
			var active_val = $(".s2_q_list>li.active");
			var ques = active_val.data("list");
			console.log(ques)
			if (active_val.length > 0) {
				$("#content").attr("data-q", active_val.data("list"));

				//设置关联答案
				$("#s3_ques_title").text(quesJson[ques].title);
				var answer_array = quesJson[ques].answer;
				var html = "";
				for (var i in answer_array) {
					html += '<li data-list="' + i + '"><span></span>' + answer_array[i] + '</li>'
				}
				$(".s3_q_list").html(html);
				$("#screen_3").removeClass("dn").siblings().addClass("dn");
			} else {
				alert("请选择一个问题。");
			}
		})
		$("#s3_sure").click(function() {
			var active_val = $(".s3_q_list>li.active");
			var ques = active_val.data("list");
			if (active_val.length > 0) {
				$("#content").attr("data-a", active_val.data("list"));
				$("#screen_4").removeClass("dn").siblings().addClass("dn");
				window.location.hash = "#" + "spr_ques=" + $("#content").attr("data-q") + "," + "spr_answer=" + $("#content").attr("data-a")
			} else {
				alert("请选择一个答案。");
			}
		})
	},
	//设置分享 ,判断是否分享成功
	setShare: function() {
		//点击分享弹出指引
		$("#btn_s4_share").click(function() {
			$(".s4_share_guide").removeClass("dn");
			if ($("#content").attr("data-share") == "y") { //判断是否被分享，这里需要后端接入，做分享的回调函数 @后端
				$(".s4_share_success").removeClass("dn")
			} else {
				$("#content").attr("data-share", "y")
			}
		})
		$("#btn_s4_back").click(function() {
			$(".s4_share_guide").addClass("dn");
		})
	},
	getGift: function() {
		var self = this;
		$("#btn_s4_success").click(function() {
			self.getCouponCode();
		})
		$("#btn_s5_ques,#btn_s9_ques").click(function() {
			window.location.href = "http://" + location.host + location.pathname;
		})
	},
	//ajax 获取优惠券代码
	getCouponCode: function() {
		var self = this;
		//模拟 ajax提交获取优惠券  @后端
		$.ajax({
			url: "test_coupon2.json", //后端完成优惠券接口替换  @后端
			type: "post",
			data: {
				weixinId:"123456", //微信id
				giftId:"1234444"
			},
			success: function(data) {
				if (data.msg == "200") {
					$(".coupon_cost").text(data.cost);
					$(".coupon_code").text(data.num);
					var style = $("#content").attr("data-style"); //判断是出题者还是回答问题的人
					if (style == "questioner") {
						$("#screen_9").removeClass("dn").siblings().addClass("dn"); //出题者的抽奖结果
					} else if (style == "answer") {
						$("#screen_5").removeClass("dn").siblings().addClass("dn"); //回答者的抽奖结果
					}
					self.setCookieCouponJson(data.num, data.cost) //将优惠券存在cookie中，方便查看
				} else { //优惠券已经领完了

				}
			}
		})
	},
	setCookieCouponArray: function(code) {
		var val = $.cookie("sephoraCouponCode");
		console.log(val)
		if (val) {
			var val_array = val.split(",");
			for (var i = 0; i < val_array.length; i++) {
				if (val_array[i] == code) {
					return;
				}
			}
			val_array.push(code);
			$.cookie("sephoraCouponCode", val_array, {
				expires: 100,
				path: "/"
			})
		} else {
			$.cookie("sephoraCouponCode", code, {
				expires: 100,
				path: "/"
			})
		}
	},
	setCookieCouponJson: function(num, cost) {
		var val = $.cookie("sephoraCouponCode");
		console.log(val)
		if (val) {
			var val_json = JSON.parse(val);
			console.log(val_json)
			if (val_json[num]) {

			} else {
				val_json[num] = cost;
				$.cookie("sephoraCouponCode", JSON.stringify(val_json), {
					expires: 100,
					path: "/"
				})
			}
		} else {
			var val_json = {};
			val_json[num] = cost;
			$.cookie("sephoraCouponCode", JSON.stringify(val_json), {
				expires: 100,
				path: "/"
			})
		}
	},
	setAnswer: function() {
		var hash = window.location.hash;
		var self = this;
		console.log(hash);
		//alert(location.href)
		//alert(hash)
		if (hash) {
			var val = hash.substring(1);
			var val_array = val.split(","),
				val_json = {},
				spr_ques = "",
				spr_answer = "";
			for (var i = 0; i < val_array.length; i++) {
				var val_array_s = val_array[i].split("=");
				val_json[val_array_s[0]] = val_array_s[1];
			}
			if (val_json["spr_ques"]) {
				spr_ques = val_json["spr_ques"];
			}
			if (val_json["spr_answer"]) {
				spr_answer = val_json["spr_answer"];
			}
			if (quesJson[spr_ques] && quesJson[spr_ques].answer[spr_answer]) {
				$("#s10_ques_title").text(quesJson[spr_ques].title);
				var answer = quesJson[spr_ques].answer;
				var html = "";
				for (var i in answer) {
					html += '<li data-list="' + i + '"><span></span>' + answer[i] + '</li>';
				}
				$("#s10_q_list").html(html);
				$("#content").attr("data-a", spr_answer);
				$("#screen_10").removeClass("dn").siblings().addClass("dn");
				//设置状态
				$("#content").data("style", "answer");
				//绑定事件
				$("#s10_q_list").on("click", "li", function() {
					$(this).addClass("active").siblings().removeClass("active");
				})
				$(".error_close").click(function() {
					$("#answer_error").addClass("dn");
				})


				$("#s10_sure").click(function() {
					var answer = $("#content").attr("data-a");
					var This = this;
					var rel_val = $("#s10_q_list>li.active").attr("data-list");
					if (rel_val == answer) {
						self.getCouponCode(); //答案正确,获取优惠券
						//$("#screen_5").removeClass("dn").siblings().addClass("dn");
					} else {
						$("#answer_error").removeClass("dn"); //答案不正确  弹出提示
					}
				})
			}
		}
	},
	//获取cookie中的优惠券代码
	getCookieCode: function() {
		var val = $.cookie("sephoraCouponCode");
		var val_json = JSON.parse(val);
		var html = "";
		for (var i in val_json) {
			html = [
				'<div class="s8_txt_li">',
				'<h4>' + val_json[i] + '元现金礼券<span>' + i + '</span></h4>',
				'<p>请在官网结账前输入兑换号使用。消费满100元即可抵扣，截止日期：2015年5月30日</p>',
				'</div>'
			].join("");
			$("#s8_coupon_box").append(html);
		}
	},
	setWeixinShare: function() {
		// 微信配置
		wx.config({
			debug: false,
			appId: "你的AppID",
			timestamp: '上一步生成的时间戳',
			nonceStr: '上一步中的字符串',
			signature: '上一步生成的签名',
			jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // 功能列表，我们要使用JS-SDK的什么功能
		});
		var shareJson = {
				title: '分享标题', // 分享标题
				desc: "分享描述", // 分享描述
				link: "分享的url,以http或https开头",
				imgUrl: "分享图标的url,以http或https开头", // 分享图标
				type: 'link', // 分享类型,music、video或link，不填默认为link
			}
			// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function() {
			// 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
			wx.onMenuShareTimeline(json);
			// 获取“分享给朋友”按钮点击状态及自定义分享内容接口
			wx.onMenuShareAppMessage(json);
		});
	}
}