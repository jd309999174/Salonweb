$(document).ready(function() {
    $('#page').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',//显示验证成功或者失败时的一个小图标
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	pageheaddata3: {
                message: '简介无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 100,
                        message: '简介长度在1-100之间'
                    },
                    regexp: {
                        regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            pagename: {
                message: '页面名称无效',
                validators: {
                    notEmpty: {
                        message: '页面名称不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: '页面名称长度在1-100之间',
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            pagecolor: {
                message: '页面主题颜色无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: '页面主题颜色长度在1-30之间',
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            pagepaddingtop: {
                message: '上间距无效',
                validators: {
                    
                    digits: {
                        min: 1,
                        max: 3,
                        message: '上间距长度在1-3之间',
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            pagepaddinglr: {
                message: '左右间距无效',
                validators: {
                    
                	digits: {
                        min: 1,
                        max: 30,
                        message: '左右间距长度在1-3之间',
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            pagepaddingbottom: {
                message: '下间距无效',
                validators: {
                    
                	digits: {
                        min: 1,
                        max: 3,
                        message: '下间距长度在1-3之间',
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