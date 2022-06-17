require('./bootstrap');

window.Swal = require('sweetalert2');

window.$ = window.jQuery = require('./jquery');

require('./admin');

window.$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
