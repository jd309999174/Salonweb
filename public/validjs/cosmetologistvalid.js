$(document).ready(function() {
    $('#cosmetologist').bootstrapValidator({
        message: 'This value is not valid',
        //excluded:[":hidden",":disabled",":not(visible)"] ,//bootstrapValidator的默认配置
        //excluded: ':disabled',//关键配置，表示只对于禁用域不进行验证，其他的表单元素都要验证

        
        fields: {
        	cosphone: {
                message: '号码无效',
                validators: {
                    notEmpty: {
                        message: '手机号码不能为空'
                    },
                    stringLength: {
                        min: 11,
                        max: 11,
                        message: '请输入11位手机号码'
                    },
                    regexp: {
                    	regexp: /^1[3|4|5|6|7|8|9]{1}[0-9]{9}$/,
                        message: '请输入正确的手机号码'
                    }
                }
            },
            cospassword: {
                message:'密码无效',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: '用户名长度必须在6到30之间'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: '密码只能包含数字，字母，标点或下划线'
                    }
                }
            },
            cosname: {
                message: '姓名无效',
                validators: {
                    notEmpty: {
                        message: '姓名不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: '姓名长度在1-30之间'
                    },
                    regexp: {
                        regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            cosaddress: {
                message:'地址无效',
                validators: {
                   
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
            cosposition: {
                message:'职务无效',
                validators: {
                    notEmpty: {
                        message: '职务不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '职务长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            cosspeciality: {
                message:'专长无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '专长长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            cosyears: {
                message: '时长无效',
                validators: {
                    notEmpty: {
                        message: '时长不能为空'
                    },
                    digits: {
                    	min: 1,
                        max: 3,
                        message: '时长只能是数字，单位为年'
                    },
                }
            },
            cosidentity: {
                message:'证件号无效',
                validators: {
                    
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: '证件号长度必须在1到50之间'
                    },
                    regexp: {
                    	regexp: /^[^<>]+$/,
                        message: '不得使用特殊字符'
                    }
                }
            },
            cosbirthday: {
                message: '日期无效',
                validators: {
                   
                    date: {
                    	format: 'YYYY/MM/DD',
                        message: '日期无效，正确格式为YYYY/MM/DD'
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