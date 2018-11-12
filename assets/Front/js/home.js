const $ = require('jquery');
require('../css/home.scss');
require('bootstrap');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
})