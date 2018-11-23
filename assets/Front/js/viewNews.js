require('../css/viewNews.scss');
require('bootstrap');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-bg]').each(function(){
        $(this).attr('style', 'background: url("' + $(this).data('bg') + '");')
        console.log($(this).data('bg'));
    })
})