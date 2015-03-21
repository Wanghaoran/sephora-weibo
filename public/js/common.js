/*
* head.JS
* 2014-6-25
* control header and aside
*/

var platform = navigator.platform;
var ua = navigator.userAgent;
var ios = /iPhone|iPad|iPod/.test(platform) && ua.indexOf( "AppleWebKit" ) > -1;
var andriod = ua.indexOf( "Android" ) > -1;



var Common = {
	init:function(){
		
	},
	//exp:Common.playVideo($(".icon_play"),$("#wrap"))
	playVideo:function(tar,this_window){
		tar.on('click',function(){
			var mp4=$(this).attr('data-mp4');
			if(ios){
				var playerHolder='<video id="video" src="' + mp4 + '" width="100%" height="auto" controls autoplay preload="auto">您的浏览器不支持该视频！</video>'
				this_window.append(playerHolder);
				var video = $('#video'),
					h = window.innerHeight,
					scrollTop = $(window).scrollTop();
				video[0].play();
				video.css({
					'width': '100%',
					'height': h,
					'position': 'absolute',
					'top': scrollTop,
					'left': 0
				})
				//video[0].addEventListener('webkitbeginfullscreen', onVideoBeginsFullScreen, false);
				//../../images/touch/testvideo.mp4
				video[0].addEventListener('webkitendfullscreen', onVideoEndsFullScreen, false);
				function onVideoEndsFullScreen(){
					$('#video').remove();
				}
			}else {
				var playerHolder = [
					'<div id="playerHolder">',
					'<video id="video" src="' + mp4 + '" width="100%" height="auto" controls autoplay preload="auto">您的浏览器不支持该视频！</video>',
					'<a href="javascript:void(0);" class="video_close"></a>',
					'</div>'
				].join('');
				this_window.append(playerHolder);
				var videoWrapper = $('#playerHolder'),
					video = $('#video'),
					h = window.innerHeight,
					scrollTop = $(window).scrollTop();
				video[0].play();
				document.ontouchmove = function(e) {
					e.preventDefault();
				}
				videoWrapper.css({
					'width': '100%',
					'height': h,
					'position': 'absolute',
					'top': scrollTop,
					'left': 0
				})
				video.attr('height', h);
				$(window).on('resize', function() {
					h = window.innerHeight;
					scrollTop = $(window).scrollTop();
					videoWrapper.css({
						'width': '100%',
						'height': h,
						'position': 'absolute',
						'top': scrollTop,
						'left': 0
					})
					video.attr('height', h);
				})

				$('.video_close').on('click', function() {
					$('#playerHolder').remove();
					document.ontouchmove = function(e) {
						e.default();
					}
				})
			}
			
		})
	},
	// show_comm 是否显示 评论数
	showArticles:function(url,type,page,pageSize,tar,show_comm){
		var html = "",
			show_time,
			result = "",
			more_tar = tar.parent().find(".more");
		$.ajax({
			//url:"/m/article/list",
			url:url,
			dataType:"json",
			type:"get",
			data:{
				"columnAlias":type,
				"p":page,
				"pageSize":pageSize,
				"t":new Date().getTime()
			},
			success:function(data){
				var msg = data.msg;
				if(msg=="error"||msg=="404"||msg=="no_such_column"||msg=="no_such_page"){
					$(".ajax_error").remove();
					tar.append('<p class="ajax_error">内容读取异常，请检查网络环境。</p>');
					more_tar.find("span").text("内容读取异常，请检查网络环境。");
					return false;
				}
				tar.attr("data-page",data.curPage);
				html = [
				'{@each articles as item,index}',
					'{@if index == 0 && curPage == 1}',
						'<article class="first clearFix">',
					'{@else}',
						'<article class="clearFix">',
					'{@/if}',					
		                '<a href="${item.linkUrl}">',
		                    '<div class="article_img">',                     
		                        '<img src="${item.thumbnailUrl}">',
		                    '</div>',                           
		                    '<h3>${item.title}</h3>',
		                    '<p>${item.description}</p>',
		                    '<div class="art_bottom">',
		                    	'{@if show_comm != "n"}',
		                        '<span class="icon_comment">${item.commentSum}</span>',
		                        '{@/if}',
		                        //'<span class="art_time">${item.publishTime|show_time}</span>',
		                    '</div>',
		                '</a>',
		           	'</article>',
		       	'{@/each}'].join("");			
				show_time = function(t){
					var time = new Date(t),
						y = time.getFullYear(),
						m = time.getMonth()+1,
						d = time.getDate();
					return y+'-'+m+'-'+d;
				}
				juicer.register('show_time',show_time);
				juicer.register('show_comm',show_comm);
				result = juicer(html,data);
				tar.find(".loading").remove();
				tar.append(result);
				more_tar.find("span").text("点击查看更多");
				if(data.curPage==data.totalPage){
					more_tar.hide()
				}
			},
			error:function(){
				tar.find(".loading").remove();
				$(".ajax_error").remove();
				tar.append('<p class="ajax_error">内容读取异常，请检查网络环境。</p>');
				more_tar.find("span").text("内容读取异常，请检查网络环境。");
			}
		})
	},
	getUrlParam:function(url_param){
		var url = window.location.href,
			url_search,
			url_array,
			val;
		if(url.indexOf("?")!=-1){
			url_search = url.substr(url.indexOf("?")+1);
			url_array = url_search.split(/[=&]/);
			for(var i = 0;i<url_array.length;i++){
				if(url_array[i]==url_param){
					val = url_array[i+1];
					return val;
				}else {
					return false;
				}
			}
		}
	},
	setReturnBtn:function(tar){
		var prevUrl = document.referrer;
		if(prevUrl){
			tar.attr("href",prevUrl);
		}
	},
	checkDeviceVersion:function(){
		var u = navigator.userAgent, app = navigator.appVersion;
        return {         //移动终端浏览器版本信息
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
            iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
            language:(navigator.browserLanguage || navigator.language).toLowerCase()
        };
	},
	//app应用下载
	checkAppDownload:function(){
		//console.log("android"+Common.checkDeviceVersion().android)
		//console.log("ios"+ Common.checkDeviceVersion().ios)
		if(Common.checkDeviceVersion().android){
			var url = appsite_data.andr.download;
			if(url.indexOf("http")!= -1){
				$(".app_download a").attr("href",appsite_data.andr.download);
			}
		}else if(Common.checkDeviceVersion().ios){
			var url = appsite_data.IOS.download;
			if(url.indexOf("http")!= -1){
				$(".app_download a").attr("href",appsite_data.IOS.download);
			}else {
				$(".app_download").hide();
				//console.log(1)
			}
		}else {
			$(".app_download").hide();
		}
	}
}