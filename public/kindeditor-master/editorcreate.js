   var editor1;
		KindEditor.ready(function(K) {
			    editor1 = K.create('#textrowtext', {
			    items:[
			    	    'source','emoticons','fontname','formatblock','fontsize','undo', 'redo','preview', 'cut', 'copy', 'paste',
				        'justifyleft', 'justifycenter', 'justifyright',
				        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				        'superscript', 'clearhtml', 'quickformat', 'selectall', 
				        'forecolor', 'hilitecolor', 'bold',
				        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', 'table', 'hr',  'baidumap','fullscreen'],
				minWidth:"322px",
				cssPath : '/kindeditor-master/plugins/code/prettify.css',
				uploadJson : '/kindeditor-master/php/upload_json.php',
				fileManagerJson : '/kindeditor-master/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		}); 
		function editorsync(){
			editor1.sync();
			}
		function editorsync2(content){
			editor1.html(content);
			}