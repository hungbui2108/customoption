function displaymutilimage(element, optid) {
    jQuery('#preview-' + optid).html('');
    var list = [];
    jQuery('#select_' + optid+' option:selected').each(function () {
        list.push(jQuery(this).attr('data-src'));
    });
    // console.log(jQuery('#select_' + optid).val());
    list.forEach(function (element) {
        var data = element.split('||');
        if(data[0] == 'image'){
            var html = '<img src="'+data[1]+'" width="50px" height="50px" style="margin-right: 5px" />';
        }
        if(data[0] == 'color'){
            var html = '<span style="background: '+data[1]+'; width: 50px; height: 50px; display: inline-block; margin-right: 5px;"></span>';
        }
        jQuery('#preview-' + optid).append(html);
    });
    jQuery('#preview-' + optid).show();
}

function displaysingleimage(element,optid) {
    jQuery('#preview-' + optid).html('');
    var src = jQuery('#select_' + optid+' option:selected').attr('data-src');
    var data = '';
    if(src != null){
        data = src.split('||');
    }
    if(data[0] == 'image'){
        var html = '<img src="'+data[1]+'" width="50px" height="50px"/>';
    }
    if(data[0] == 'color'){
        var html = '<span style="background: '+data[1]+'; width: 50px; height: 50px; display: inline-block;"></span>';
    }
    jQuery('#preview-' + optid).append(html);
    jQuery('#preview-' + optid).show();
}
