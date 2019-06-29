/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * @todo
 * Add https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html to ckeditor
 */

require('./bootstrap');
require ('./components/ckeditor');

require('statblock5e/src/js/statblock5e');

import select2 from 'select2';

$(document).ready(function () {
    $("select[data-select='select2']").select2({
        theme: "bootstrap"
    });
});