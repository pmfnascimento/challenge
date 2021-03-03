require('./bootstrap');
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) { }


/*!
 * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */

$(function () {
    

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
});

window.Vue = require('vue');
import "leaflet/dist/leaflet.css";
Vue.component('list-drivers', require('./components/managers/ListDrivers.vue').default);
Vue.component('edit-drivers', require('./components/managers/EditDrivers.vue').default);
Vue.component('create-drivers', require('./components/managers/CreateDrivers.vue').default);
const app = new Vue({
    el: '#app',
});
