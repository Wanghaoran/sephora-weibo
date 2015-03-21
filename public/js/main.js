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
		//S2 选择绑定
		$(".s2_q_list").on("click", "li", function() {
				var This = $(this);
				This.addClass("active").siblings().removeClass("active");
			})
			//S3 选择绑定
		$(".s3_q_list").on("click", "li", function() {
			var This = $(this);
			This.addClass("active").siblings().removeClass("active");
		})
		$("#s10_q_list").on("click", "li", function() {
			$(this).addClass("active").siblings().removeClass("active");
		})
		$("#btn_s4_share").click(function() {
			$(".s4_share_guide").removeClass("dn");
		})
		$("#btn_s4_back").click(function() {
			$(".s4_share_guide").addClass("dn");
		})
		$(".error_close").click(function() {
			$("#answer_error").addClass("dn");
		})
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