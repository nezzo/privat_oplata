jQuery(document).ready(function(){
    /*Скрипт прокрутки к нужному блоку*/
    jQuery('a.my_butt').click(function() {
        jQuery.scrollTo('#features', 1000);
    });
});