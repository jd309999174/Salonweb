
//折叠面板图标
$(function(){
	        var icons = {
		      header: "ui-icon-circle-arrow-e",
		      activeHeader: "ui-icon-circle-arrow-s"
		    };
		    $( "#accordion" ).accordion({
		      icons: icons,
		      collapsible: true,
		      heightStyle: "content",
		      active: 100
		    });
})

//提交
function myheadpage($x){ //首页头
	$("#headpageicon").attr("src",$("#headpagerowicon").attr("src"));
	$("#headpagename").html($("#headpagerowname").val());
	$("#pagehead").css("background-image","url("+$("#headpagerowimg").attr("src")+")");
	$("#pagehead").attr("data-backgroundimg",$("#headpagerowimg").attr("src"));
	$("#pagehead").attr("data-href",$("#headpagerowlink").val());
	$(".fieldset").hide();
	};
function mynewold($x){//新老顾客
		$(".intro").eq($x).find(".newoldimg1").attr("src",$("#newoldrowimg1").attr("src"));
		$(".intro").eq($x).find(".newolda1").attr("data-href",$("#newoldrowlink1").val());
		$(".intro").eq($x).find(".newoldimg2").attr("src",$("#newoldrowimg2").attr("src"));
		$(".intro").eq($x).find(".newolda2").attr("data-href",$("#newoldrowlink2").val());
		$(".fieldset").hide();
		};
function myvip($x){ //单列图
		$(".intro").eq($x).find(".vipimg").attr("src",$("#viprowimg").attr("src"));
		$(".intro").eq($x).find(".vipa").attr("data-href",$("#viprowlink").val());
		$(".intro").eq($x).find(".vipa").attr("data-level",$("#viprowlevel").val());
		$(".fieldset").hide();
		};
function mysingle($x){ //单列图
	$(".intro").eq($x).find(".singleimg").attr("src",$("#singlerowimg").attr("src"));
	$(".intro").eq($x).find(".singlea").attr("data-href",$("#singlerowlink").val());
	$(".fieldset").hide();
	};
function mydouble($x){//双列图
	$(".intro").eq($x).find(".doubleimg1").attr("src",$("#doublerowimg1").attr("src"));
	$(".intro").eq($x).find(".doublea1").attr("data-href",$("#doublerowlink1").val());
	$(".intro").eq($x).find(".doubleimg2").attr("src",$("#doublerowimg2").attr("src"));
	$(".intro").eq($x).find(".doublea2").attr("data-href",$("#doublerowlink2").val());
	$(".fieldset").hide();
	};
function myswiper($x){//轮播图
		$(".intro").eq($x).find(".swiperimg1").attr("src",$("#swiperrowimg1").attr("src"));
		$(".intro").eq($x).find(".swipera1").attr("data-href",$("#swiperrowlink1").val());
		$(".intro").eq($x).find(".swiperimg2").attr("src",$("#swiperrowimg2").attr("src"));
		$(".intro").eq($x).find(".swipera2").attr("data-href",$("#swiperrowlink2").val());
		$(".intro").eq($x).find(".swiperimg3").attr("src",$("#swiperrowimg3").attr("src"));
		$(".intro").eq($x).find(".swipera3").attr("data-href",$("#swiperrowlink3").val());
		$(".intro").eq($x).find(".swiperimg4").attr("src",$("#swiperrowimg4").attr("src"));
		$(".intro").eq($x).find(".swipera4").attr("data-href",$("#swiperrowlink4").val());
		$(".intro").eq($x).find(".swiperimg5").attr("src",$("#swiperrowimg5").attr("src"));
		$(".intro").eq($x).find(".swipera5").attr("data-href",$("#swiperrowlink5").val());
		$(".fieldset").hide();
		};
function myheadline($x){ //标题
	    $(".intro").eq($x).find(".headlinetext").html($("#headlinerowtext").val());
	    $(".intro").eq($x).css("height","auto");
		$(".intro").eq($x).find(".headlinea").attr("data-href",$("#headlinerowlink").val());
		$(".fieldset").hide();
		};
function mytext($x){ //文本
		$(".intro").eq($x).find(".texttext").html($("#textrowtext").val());
		//重新调整高度，否则文字被遮盖
		$(".intro").eq($x).css("height","auto");
		$(".fieldset").hide();
		};
function myimgtext($x){//图文
	var $y=$('#imgtextrowimg').attr('src');
	$(".intro").eq($x).find(".imgtextimg").css("background-image","url("+$y+")");
	$(".intro").eq($x).find(".imgtextimg").attr("data-backgroundimage",$y);
	$(".intro").eq($x).find(".imgtexttitle1").html($("#imgtextrowtitle1").val());
	$(".intro").eq($x).find(".imgtexta1").attr("data-href",$("#imgtextrowlink1").val());
	$(".intro").eq($x).find(".imgtexttext1").html($("#imgtextrowtext1").val());
	$(".intro").eq($x).find(".imgtexttitle2").html($("#imgtextrowtitle2").val());
	$(".intro").eq($x).find(".imgtexta2").attr("data-href",$("#imgtextrowlink2").val());
	$(".intro").eq($x).find(".imgtexttext2").html($("#imgtextrowtext2").val());
	$(".intro").eq($x).find(".imgtexttitle3").html($("#imgtextrowtitle3").val());
	$(".intro").eq($x).find(".imgtexta3").attr("data-href",$("#imgtextrowlink3").val());
	$(".intro").eq($x).find(".imgtexttext3").html($("#imgtextrowtext3").val());
	$(".intro").eq($x).css("height","auto");
	$(".fieldset").hide();
}
function myvideo($x){//视频
		$(".intro").eq($x).find(".videosrc").attr("src",$("#videorowsrc").attr("src"));
		$(".fieldset").hide();
		};
function mylottery($x){//抽奖
	    $(".intro").eq($x).find(".lotteryimg1").attr("src",$("#lotteryrowimg1").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg2").attr("src",$("#lotteryrowimg2").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg3").attr("src",$("#lotteryrowimg3").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg4").attr("src",$("#lotteryrowimg4").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg5").attr("src",$("#lotteryrowimg5").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg6").attr("src",$("#lotteryrowimg6").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg7").attr("src",$("#lotteryrowimg7").attr("src"));
	    $(".intro").eq($x).find(".lotteryimg8").attr("src",$("#lotteryrowimg8").attr("src"));
	    $(".intro").eq($x).find(".lotterytable").attr("data-lotteryrate",$("#lotteryrowtext1").val());
	    $(".intro").eq($x).find(".lotterytable").attr("data-lotterypoints",$("#lotteryrowtext2").val());
		$(".fieldset").hide();
		};
function mylotterypoints($x){//抽奖
		$(".intro").eq($x).find(".lotterypointsimg1").attr("src",$("#lotterypointsrowimg1").attr("src"));
		$(".intro").eq($x).find(".lotterypointsimg2").attr("src",$("#lotterypointsrowimg2").attr("src"));
		$(".intro").eq($x).find(".lotterypointsimg3").attr("src",$("#lotterypointsrowimg3").attr("src"));
		$(".intro").eq($x).find(".lotterypointsimg4").attr("src",$("#lotterypointsrowimg4").attr("src"));
	    $(".intro").eq($x).find(".lotterypointsimg5").attr("src",$("#lotterypointsrowimg5").attr("src"));
	    $(".intro").eq($x).find(".lotterypointsimg6").attr("src",$("#lotterypointsrowimg6").attr("src"));
		$(".intro").eq($x).find(".lotterypointsimg7").attr("src",$("#lotterypointsrowimg7").attr("src"));
		$(".intro").eq($x).find(".lotterypointsimg8").attr("src",$("#lotterypointsrowimg8").attr("src"));
		$(".intro").eq($x).find(".lotterypointstable").attr("data-lotterypointsrate",$("#lotterypointsrowtext1").val());
		$(".intro").eq($x).find(".lotterypointstable").attr("data-lotterypointspoints",$("#lotterypointsrowtext2").val());
	    $(".fieldset").hide();
	    };
//删除元素
function mydelete($x){
	  $(".intro").eq($x).remove();
	  $(".fieldset").hide();
	  };
//拖动
$(function() {
    $( "#sortable" ).sortable({
      revert: true
    });
    $( "#draggable11" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable12" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable13" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable21" ).draggable({
      connectToSortable: "#sortable",
      helper: "clone",
      revert: "invalid"
    });
    $( "#draggable22" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable23" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable31" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable32" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable33" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable41" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable42" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
    $( "#draggable43" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
  });

//TODO 控制搜索栏和菜单栏下滑时的透明度和固定定位
$(document).ready(function(){
		$y= $("#subnav").offset().top-$('.nav_ul').offset().top- $('.nav_ul').scrollTop();//最初距离屏幕高度
		  $('.nav_ul').scroll(function(){
			  //搜索栏透明度和背景
			  if($('.nav_ul').scrollTop()>200){
				  $('.pageheadbtn').css('opacity','1');
				  $('#headpagebtnset').css('background','white')
			  }else{
				  $('.pageheadbtn').css('opacity','0.5');
				  $('#headpagebtnset').css('background','')
				  }
			  //按钮组的固定
			  $x= $("#subnav").offset().top -$('.nav_ul').offset().top- $('.nav_ul').scrollTop();//变化中距离屏幕高度
			  if($x<=$("#headpagebtnset").height()){
		             $("#subnav").css({"position":"fixed","top":$('.nav_ul').offset().top+$("#headpagebtnset").height()});
				  }
			  if($y>=$('.nav_ul').scrollTop()){$("#subnav").css("position","static");}
		      
		  });
		});
