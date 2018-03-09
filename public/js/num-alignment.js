(function($){ 
	var functions = {
		init:function(input, step, max, min, digit){
			var width = input.width()-3;
			var height = input.width()/4;
			var _this = this;
		 	width += 3;
		 	width=width-30;//太大，缩小点
		 	
		 	input.attr("readonly", "readonly");
		 	//设置不分样式
			input.css("border", "none");
			input.css("width", width-height*2-2);
			input.css("height", height);
			input.css("padding", "0px");
			input.css("margin", "0px");
			input.css("text-align", "center");
			input.css("vertical-align", "middle");
			input.css("line-height", height + "px");
			
			
			//添加左右加减号
			input.wrap("<div style = 'overflow:hidden;width:" + width + "px;height:" + height + "px;border: 1px solid #CCC;'></div>");
			input.before("<div id = '" + input.attr('id') + "l'  onselectstart = 'return false;' style = '-moz-user-select:none;cursor:pointer;text-align:center;width:" + height + "px;height:" + height + "px;line-height:" + height + "px;border-right: 1px solid #CCC;float:left'>-</div>");
			input.after("<div id = '" + input.attr('id') + "r'  onselectstart = 'return false;' style = '-moz-user-select:none;cursor:pointer;text-align:center;width:" + height + "px;height:" + height + "px;line-height:" + height + "px;border-left: 1px solid #CCC;float:right'> + </div>");
			//左右调用执行
			$("#" + input.attr('id') + "l").click(function(){
				_this.execute(input, step, max, min, digit, true);
			});
			$("#" + input.attr('id') + "r").click(function(){
				_this.execute(input, step, max, min, digit, false);
			});
		},
		execute:function(input, step, max, min, digit, _do){
			var val = parseFloat(this.format(input.val(), digit));
			var ori = val;
			if(_do) val -= step;
			if(!_do) val += step;
			if(val<min){
				val  =  min;
			}else if(val>max){
				val  =  max;
			}
			input.val(this.format(val, digit));
		},
		format:function(val, digit){
			if(isNaN(val)){ 
				val = 0;
			}
			return parseFloat(val).toFixed(digit);	
		}
	};
	
	
    $(function(){
    	//使用控件必须有以下属性或者引用alignment类
		var inputs = $("input[user_data], input[data_digit], input[data_step], input[data_min], input[data_max], input.alignment");
		inputs.each(function(){
			//预设值数据选择
			var data = {
			            default_data : 	{"step" : 0.1, "min" : 0, "max" : 99, "digit" : 1}, 
			            aaa : 			{"step" : 0.5, "min" : 5, "max" : 20, "digit" : 1}, 
						}
			
			var user_data = eval("data." + $(this).attr("user_data"));
			if(user_data == null){
				user_data = data.default_data;
			}
			
			var digit = $(this).attr("data_digit");
			if(digit != null&&!isNaN(parseFloat(digit))){
				digit  =  parseFloat(digit).toFixed(0);
				user_data.digit = parseFloat(digit);
			}
			
			var step = $(this).attr("data_step");
			if(step != null &&!isNaN(parseFloat(step))){
				user_data.step = parseFloat(step);
			}
			var min = $(this).attr("data_min");
			if(min != null &&!isNaN(parseFloat(min))){
				user_data.min = parseFloat(min);
			}
			
			var max = $(this).attr("data_max");
			if(max != null &&!isNaN(parseFloat(max))){
				user_data.max = parseFloat(max);
			}
			//自动装载
	        functions.init($(this), user_data.step, user_data.max, user_data.min, user_data.digit);
	        
	        var data_edit = $(this).attr("data_edit");
	        if(data_edit){
	        	$(this).attr("readonly",null);
	        }
		});
	})  
})(jQuery);