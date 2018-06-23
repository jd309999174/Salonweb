$(document).ready(function() {
    $('#custombutton').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',//显示验证成功或者失败时的一个小图标
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        fields: {
        	
        	buttonname: {
                message: '按钮名称无效',
                validators: {
                    notEmpty: {
                        message: '按钮名称不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 20,
                        message: '按钮名称长度在1-20之间'
                    },
                    regexp: {
                        regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            

        }
    }).on('error.form.bv', function(e) {
        console.log('error');

        // Active the panel element containing the first invalid element
        var $form         = $(e.target),
            validator     = $form.data('bootstrapValidator'),
            $invalidField = validator.getInvalidFields().eq(0),
            $collapse     = $invalidField.parents('.collapse');

        $collapse.collapse('show');
    });
});