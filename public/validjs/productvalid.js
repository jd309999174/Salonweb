$(document).ready(function() {
    $('#product').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',//显示验证成功或者失败时的一个小图标
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        fields: {
        	
            prodprice: {
                message:'价格无效',
                validators: {
                    notEmpty: {
                        message: '价格不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 11,
                        message: '价格长度必须在1到11之间'
                    },
                    regexp: {
                        regexp: /^[0-9_\.]+$/,
                        message: '价格只能包含数字,标点'
                    }
                }
            },
            prodoriginal: {
                message:'价格无效',
                validators: {
                    notEmpty: {
                        message: '价格不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 11,
                        message: '价格长度必须在1到11之间'
                    },
                    regexp: {
                        regexp: /^[0-9_\.]+$/,
                        message: '价格只能包含数字,标点'
                    }
                }
            },
            prodtitle: {
                message: '标题无效',
                validators: {
                    notEmpty: {
                        message: '标题不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 100,
                        message: '标题长度在1-100之间'
                    },
                    regexp: {
                        regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodbrand: {
                message:'品牌无效',
                validators: {
                   
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '品牌长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodspecification: {
                message:'规格无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '规格长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodcontent: {
                message:'含量无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '含量长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodfactor: {
                message:'指数无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '指数长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodplace: {
                message:'产地无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '产地长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodapproval: {
                message:'批号无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '批号长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodefficacy: {
                message: '功效无效',
                validators: {
                	stringLength: {
                        min: 1,
                        max: 50,
                        message: '功效长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            prodvalidity: {
                message: '有效期无效',
                validators: {
                    
                    digits: {
                    	min: 1,
                        max: 3,
                        message: '有效期只能是数字，单位为年'
                    },
                }
            },
            prodtreatment: {
                message: '疗程次数无效',
                validators: {
                    
                    digits: {
                    	min: 1,
                        max: 3,
                        message: '疗程次数只能是数字'
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