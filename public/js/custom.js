//切换
$(document).ready(function(){
	
	 
	$("#button1").click(function(){
		$("#content1").show();
		$("#content2").hide();
		$("#content3").hide();
		
		
	});
	$("#button2").click(function(){
		$("#content1").hide();
		$("#content2").show();
		$("#content3").hide();
		
		
	});
	$("#button3").click(function(){
		$("#content1").hide();
		$("#content2").hide();
		$("#content3").show();
// 		$.get("/php/content3.php",function(data,status){
// 			$("#content3").html(data);
// 		});
		
	});
	$("#button4").click(function(){
		 window.location.reload();
	});
	
});
//幻灯片
var mySwiper = new Swiper ('.swiper-container', {
	effect : 'fade',
	autoplay : 2000,
    loop: true,
    
    // 如果需要分页器
    pagination: '.swiper-pagination',
    
    
    
    // 如果需要滚动条
    scrollbar: '.swiper-scrollbar',
  })   

//随机文件名
function change(file,text) {
	var x="0123456789qwertyuioplkjhgfdsazxcvbnm";
	var tmp="";
	var timestamp = new Date().getTime();
	for(var i=0;i< 10;i++) {
	tmp += x.charAt(Math.ceil(Math.random()*100000000)%x.length);}
	var random=timestamp+tmp;
	var obj = document.getElementById(file);
	var len = obj.files.length;
	for (var i = 0; i < len; i++) {
	var temp = obj.files[i].name;}
	var fileExt=(/[.]/.exec(temp)) ? /[^.]+$/.exec(temp.toLowerCase()) : '';
	var randomname=random+"."+fileExt;
	var obj2 = document.getElementById(text);
	obj2.value=randomname;
	}