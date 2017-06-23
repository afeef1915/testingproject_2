function getContainerAlertContent(container_id, type, is_portlet, icon, message, default_show) {
    var containerId = '';
    if (typeof container_id != 'undefined' && container_id !== false) {
        containerId = 'id="' + container_id + '_error"';
    }
    return '<div ' + containerId + ' class="app_main_alerts_area eserv_alert alert alert-' + type + '' + ((typeof is_portlet != 'undefined' && is_portlet !== true) ? '' : ' in_portlet ') + ' alert-dismissable" style="' + (typeof default_show == 'undefined' || (typeof default_show != 'undefined' && default_show == false) ? 'display:none;' : 'display:block; ') + '"> <span class="close" data-dismiss="alert">×</span><div class="icon"><i class="fa fa-' + getAlertIcon(type) + '"></i></div>\n\
                <strong class="">' + message + '</strong><div class="clearfix"></div></div>';
}

function getAlertIcon(type) {
    var icon = 'remove';
    switch (type) {
        case 'success':
            icon = 'check';
            break;
    }
    return icon;
}

function toggleScreenWidth(size) {
    $(document).find('.container').each(function () {
        var settings_panel_toggle_switch = $('#settings_panel').find('.fullwidth_trigger');
        var top_nav_toggle_btn = $('.navbar-mtl').find('.fullwidth_trigger');
        if (typeof size != 'undefined') {
            setPageWidth($(this), settings_panel_toggle_switch, size, {
                onClass: 'fa-toggle-on',
                offClass: 'fa-toggle-off'
            });
            setPageWidth($(this), top_nav_toggle_btn, size, {
                onClass: 'fa-expand',
                offClass: 'fa-compress'
            });
        } else {
            if ($(this).hasClass('full_width')) {
                setPageWidth($(this), settings_panel_toggle_switch, 'normal', {
                    onClass: 'fa-toggle-on',
                    offClass: 'fa-toggle-off'
                });
                setPageWidth($(this), top_nav_toggle_btn, 'normal', {
                    onClass: 'fa-expand',
                    offClass: 'fa-compress'
                });
            } else {
                setPageWidth($(this), settings_panel_toggle_switch, 'wide', {
                    onClass: 'fa-toggle-on',
                    offClass: 'fa-toggle-off'
                });
                setPageWidth($(this), top_nav_toggle_btn, 'wide', {
                    onClass: 'fa-expand',
                    offClass: 'fa-compress'
                });
            }
        }
    });
}

$("#hide").click(function(){
    $("#error_msg").hide();
});
  $('#notification_ids').on('click',function(){
  //   var id= $("#notification_id").find("input").attr("id");
    // var customer= $("#notification_id").find("input").attr("data-customer");
      //  var id = ($(this).attr('class'));
      console.log('dsaf');
    //  alert('d');
//        var httpRequest = $http({
//            method: 'POST',
//            data: $.param({id: id,customer:customer}),
//            url: root_url + 'mylogs/noti_inactive',
//            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//        }).success(function (response, status) {
//            console.log(response);
//            if(response=="true")
//            {
//            window.location=root_url+'#/mylogs/edit-portlets/' + id+'/customer/'+customer+'?time=' + new Date().getTime(); 
//            }
//            else
//            {
//            }
//            
//        });
     });   
         