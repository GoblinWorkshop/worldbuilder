/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import CkeditorUpload from './components/CkeditorUpload';

import select2 from 'select2';

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new CkeditorUpload( loader );
    };
}

ClassicEditor.create(document.querySelector("textarea[editor='rich']"), {
    extraPlugins: [MyCustomUploadAdapterPlugin]
});

$(document).ready(function() {
    $("select[data-select='select2']").select2();
});