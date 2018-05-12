 <?php echo $this->headLink(array('rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/img/favicon.ico'))
                        ->prependStylesheet($this->basePath('css/ionic.css'))
                        ->prependStylesheet($this->basePath('css/swiper-3.4.2.min.css'))
                        ;?>

        <!-- Scripts -->
        <?php echo $this->headScript()
            ->prependFile($this->basePath('js/ionic.js'))
            ->prependFile($this->basePath('js/swiper-3.4.2.jquery.min.js'))
            ->prependFile($this->basePath('js/jquery.min.js')); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">

<script>
function change(file,text) {
var x="0123456789qwertyuioplkjhgfdsazxcvbnm";
var tmp="";
var timestamp = new Date().getTime();
for(var i=0;i< 10;i++) {
tmp += x.charAt(Math.ceil(Math.random()*100000000)%x.length);}
var random=timestamp+tmp;
var obj = document.getElementById(file);
var len = obj.files.length;
for (var i = 0; i < len; i++) {
var temp = obj.files[i].name;}
var fileExt=(/[.]/.exec(temp)) ? /[^.]+$/.exec(temp.toLowerCase()) : '';
var randomname=random+"."+fileExt;
var obj2 = document.getElementById(text);
obj2.value=randomname;
}
</script>