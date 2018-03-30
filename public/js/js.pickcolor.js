var colorPicker = function(idStr){
 this.colorPool = ["#000000","#993300","#333300","#003300","#003366","#000080","#333399","#333333","#800000","#FF6600","#808000","#008000","#008080","#0000FF","#666699","#808080","#FF0000","#FF9900","#99CC00","#339966","#33CCCC","#3366FF","#800080","#999999","#FF00FF","#FFCC00","#FFFF00","#00FF00","#00FFFF","#00CCFF","#993366","#CCCCCC","#FF99CC","#FFCC99","#FFFF99","#CCFFCC","#CCFFFF","#99CCFF","#CC99FF","#FFFFFF"];
 this.initialize(idStr);
}
colorPicker.prototype = {
 initialize: function(idStr){
  var count=0;
  var html = '';
  var self = this;
  html+= '<table cellspacing="5" cellpadding="0" border="2" bordercolor="#000000" style="cursor:pointer;background:#ECE9D8" mce_style="cursor:pointer;background:#ECE9D8" >';
  // html+= '<tr><td align="center" colspan="8" width="160" height="20" id="currentColor" bgcolor="#ffffff">当前颜色</td></tr>';
  for(i=0;i<5;i++)
  {
   html+= "<tr>";
   for(j=0;j<8;j++)
   {
    html+= '<td align="center" width="20" height="20" style="background:'+ this.colorPool[count]+'" mce_style="background:'+ this.colorPool[count]+'" unselectable="on"> </td>';
    count++;
   }
   html+= "</tr>";
  }
  html+= '</table>';
  this.trigger = document.getElementById(idStr);
  this.div = document.createElement('div');
  this.div.innerHTML = html;
  var tds = this.div.getElementsByTagName('td');
  for(var i=0,l=tds.length;i<l;i++){
   tds[i].onclick = function(){
    self.setValue(this.style.backgroundColor);
   }
  }
  this.div.id = 'myColorPicker';
  this.trigger.parentNode.appendChild(this.div);
  this.div.style.position = 'absolute';
  this.div.style.left = this.trigger.offsetLeft + 'px'
  this.div.style.top = (this.trigger.clientHeight + this.trigger.offsetTop)+ 'px';
  //this.hide();
  this.trigger.onclick = function(){
   if(self.div.style.display == 'none'){
    self.show();
    return false;
   }else{
    self.hide();
    return false;
   }
  }
 },
 setValue : function(c){
  this.hide();
  document.getElementById('pagecolor').value = c //proEditor.setColor(c); //自己定义函数决定setColor的功能
 },
 hide : function(){
  this.div.style.display = 'none'
 },
 show : function(){
  this.div.style.display = 'block'
 }
}