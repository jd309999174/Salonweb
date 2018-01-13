//首页，产品，活动，动态四个按钮
$(document).ready(function(){
	$('#homepagenavtext1').css("color","red");
	$('#homepagenavtext1').css("font-size","120%");
	$('#homepagenav2').hide();$('#homepagenav3').hide();$('#homepagenav4').hide();
	$("#homepagenavbtn1").click(function(){
	$('.homepagenav').hide();$('#homepagenav1').show();
	//设其他文字变黑变小
	$('.homepagenavtext').css("color","#333");
	$('.homepagenavtext').css("font-size","100%");
	//设文字变红变大
	$('#homepagenavtext1').css("color","red");
	$('#homepagenavtext1').css("font-size","120%");	
	});
	$("#homepagenavbtn2").click(function(){
	$('.homepagenav').hide();$('#homepagenav2').show();
	//设其他文字变黑变小
	$('.homepagenavtext').css("color","#333");
	$('.homepagenavtext').css("font-size","100%");
	$('#homepagenavtext2').css("color","red");
	$('#homepagenavtext2').css("font-size","120%");
	});
	$("#homepagenavbtn3").click(function(){
	$('.homepagenav').hide();$('#homepagenav3').show();
	//设其他文字变黑变小
	$('.homepagenavtext').css("color","#333");
	$('.homepagenavtext').css("font-size","100%");
	$('#homepagenavtext3').css("color","red");
	$('#homepagenavtext3').css("font-size","120%");
	});
	$("#homepagenavbtn4").click(function(){
	$('.homepagenav').hide();$('#homepagenav4').show();
	//设其他文字变黑变小
	$('.homepagenavtext').css("color","#333");
	$('.homepagenavtext').css("font-size","100%");
	$('#homepagenavtext4').css("color","red");
	$('#homepagenavtext4').css("font-size","120%");
	});
})
//排序按钮   已移到homepage中,addclass在.js中似乎不起作用，.get的ajax方法也不能放在.js文件中
//$(document).ready(function(){
//    $("#sortsynthesis").addClass("active");
//	$('#prodpriceup').hide();$('#prodpricedown').hide();$('#prodsales').hide();$('#prodregdate').hide();
//	$("#sortsynthesis").click(function(){
//	    $('.prodsort').hide();$('#prodsynthesis').show();});
//	$("#sortpriceup").click(function(){
//		$("#sortsynthesis").removeClass("active");
//	    $('.prodsort').hide();$('#prodpriceup').show();});
//	$("#sortpricedown").click(function(){
//		$("#sortsynthesis").removeClass("active");
//		$('.prodsort').hide();$('#prodpricedown').show();});
//	$("#sortsales").click(function(){
//		$("#sortsynthesis").removeClass("active");
//	    $('.prodsort').hide();$('#prodsales').show();});
//	$("#sortregdate").click(function(){
//		$("#sortsynthesis").removeClass("active");
//	    $('.prodsort').hide();$('#prodregdate').show();});
//})

//$(document).ready(function(){
//	//$y= $("#subnav").offset().top - $(window).scrollTop();//最初距离屏幕高度
//	//$y=180;
//  $(document).scroll(function(){
//	  //搜索栏透明度和背景
//	 
//	  //按钮组的固定
//	  $x= $("#fixedstandard").offset().top - $(window).scrollTop();//变化中参考div距离屏幕高度
//	  if($x<=$("#headpagebtnset").height()){
//             $("#subnav").css({"position":"fixed","top":$("#headpagebtnset").height()});//4个按钮固定高度
//             $("#productsort").css({"position":"fixed","top":$("#subnav").height()+$("#headpagebtnset").height()});//产品排序按钮固定高度
//             $('.pageheadbtn').css('opacity','1');
//      		 $('#headpagebtnset').css('background-color','white');
//		  }else{
//			  $('.pageheadbtn').css('opacity','0.5');
//			  $('#headpagebtnset').css('background-color','');
//			  $("#subnav").css("position","static");
//			  $("#productsort").css({"position":"static",});
//			  }
//	  //if($y>=$(window).scrollTop()){$("#subnav").css("position","static");}
//  });
//});