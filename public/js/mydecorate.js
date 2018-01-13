
//折叠面板图标
$(function(){
	        var icons = {
		      header: "ui-icon-circle-arrow-e",
		      activeHeader: "ui-icon-circle-arrow-s"
		    };
		    $( "#accordion" ).accordion({
		      icons: icons,
		      collapsible: true,
		      heightStyle: "content"
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
