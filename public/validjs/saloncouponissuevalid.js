$(document).ready(function() {
    $('#saloncouponissue').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',//显示验证成功或者失败时的一个小图标
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	cusid: {
                message: '编号无效',
                validators: {
                    notEmpty: {
                        message: '编号不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 10,
                        message: '编号只能是数字'
                    },
                }
            },
            scirestriction: {
                message: '使用限制无效',
                validators: {
                    notEmpty: {
                        message: '使用限制不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 10,
                        message: '使用限制只能是数字'
                    },
                }
            },
            scimoney: {
                message: '优惠券金额无效',
                validators: {
                    notEmpty: {
                        message: '优惠券金额不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 10,
                        message: '优惠券金额只能是数字'
                    },
                }
            },
            scitimes: {
                message: '每人限领次数无效',
                validators: {
                    notEmpty: {
                        message: '每人限领次数不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 2,
                        message: '每人限领次数只能是数字'
                    },
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