<?php  //聊天图片替换方法
function ubbReplace($str) {
    $str = str_replace ( ">", '<；', $str );
    $str = str_replace ( ">", '>；', $str );
    $str = str_replace ( "\n", '>；br/>；', $str );
    $str = preg_replace ( "[\[em_([0-9]*)\]]", "<img src=\"/arclist/$1.gif\" />", $str );
    return $str;
}
?>