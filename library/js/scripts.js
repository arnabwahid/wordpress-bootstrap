/* imgsizer (flexible images for fluid sites) */
var imgSizer={Config:{imgCache:[],spacer:"/path/to/your/spacer.gif"},collate:function (aScope) {
    var isOldIE=(document.all&&!window.opera&&!window.XDomainRequest)?1:0;if(isOldIE&&document.getElementsByTagName) {var c=imgSizer;var imgCache=c.Config.imgCache;var images=(aScope&&aScope.length)?aScope:document.getElementsByTagName("img");for(var i=0;i<images.length;i++){images[i].origWidth=images[i].offsetWidth;images[i].origHeight=images[i].offsetHeight;imgCache.push(images[i]);c.ieAlpha(images[i]);images[i].style.width="100%";}
        if(imgCache.length) {c.resize(
            function () {
                for(var i=0;i<imgCache.length;i++){var ratio=(imgCache[i].offsetWidth/imgCache[i].origWidth);imgCache[i].style.height=(imgCache[i].origHeight*ratio)+"px";}}
            );}}},ieAlpha:function (img) {
                var c=imgSizer;if(img.oldSrc) {img.src=img.oldSrc;}
                    var src=img.src;img.style.width=img.offsetWidth+"px";img.style.height=img.offsetHeight+"px";img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')"
                    img.oldSrc=src;img.src=c.Config.spacer;},resize:function (func) {
                        var oldonresize=window.onresize;if(typeof window.onresize!='function') {window.onresize=func;}else{window.onresize=function () {
                            if(oldonresize) {oldonresize();}
                                func();}}}}

// add twitter bootstrap classes and color based on how many times tag is used
function addTwitterBSClass(thisObj) 
{
    var title = jQuery(thisObj).attr('title');
    if (title) {
        var titles = title.split(' ');
        if (titles[0]) {
            var num = parseInt(titles[0]);
            if (num > 0) {
                jQuery(thisObj).addClass('label label-default');
            }
            if (num == 2) {
                jQuery(thisObj).addClass('label label-info');
            }
            if (num > 2 && num < 4) {
                jQuery(thisObj).addClass('label label-success');
            }
            if (num >= 5 && num < 10) {
                jQuery(thisObj).addClass('label label-warning');
            }
            if (num >=10) {
                jQuery(thisObj).addClass('label label-important');
            }
        }
    }
    else {
        jQuery(thisObj).addClass('label');
    }
    return true;
}

// as the page loads, call these scripts
jQuery(document).ready(
    function ($) {

        // modify tag cloud links to match up with twitter bootstrap
        $("#tag-cloud a").each(
            function () {
                addTwitterBSClass(this);
                return true;
            }
        );
    
        $("p.tags a").each(
            function () {
                addTwitterBSClass(this);
                return true;
            }
        );
    
        $("ol.commentlist a.comment-reply-link").each(
            function () {
                $(this).addClass('btn btn-success btn-mini');
                return true;
            }
        );
    
        $('#cancel-comment-reply-link').each(
            function () {
                $(this).addClass('btn btn-danger btn-mini');
                return true;
            }
        );
    
        // $('article.post').hover(function(){
        //     $('a.edit-post').show();
        // },function(){
        //     $('a.edit-post').hide();
        // });
    
        // Prevent submission of empty form
        $('[placeholder]').parents('form').submit(
            function () {
                $(this).find('[placeholder]').each(
                    function () {
                        var input = $(this);
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    }
                )
            }
        );
            
        $('.alert-message').alert();
    
        $('.dropdown-toggle').dropdown();
 
    }
);