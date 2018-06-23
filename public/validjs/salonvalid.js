$(document).ready(function() {
    $('#salon').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',//显示验证成功或者失败时的一个小图标
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	salbranch: {
                message: '分店号无效',
                validators: {
                    notEmpty: {
                        message: '分店号不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 30,
                        message: '分店号只能是数字'
                    },
                }
            },
            salname: {
                message: '分院名称无效',
                validators: {
                    notEmpty: {
                        message: '分院名称不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: '分院名称长度在1-30之间'
                    },
                    regexp: {
                        regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            salphone: {
                message: '号码无效',
                validators: {
                    notEmpty: {
                        message: '号码不能为空'
                    },
                    stringLength: {
                        min: 7,
                        max: 11,
                        message: '请输入正确号码',
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            saladdress: {
                message:'地址无效',
                validators: {
                    notEmpty: {
                        message: '地址不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '地址长度必须在1到50之间'
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