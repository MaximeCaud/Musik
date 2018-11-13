require('../css/media.scss');
require('bootstrap');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-bg]').each(function(){
        $(this).attr('style', 'background-image: url("' + $(this).data('bg') + '");')
    })
})