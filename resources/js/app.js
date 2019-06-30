/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * @todo
 * Add https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html to ckeditor
 */

require('./bootstrap');
require('./components/ckeditor');

import select2 from 'select2';

$(document).ready(function () {
    $("select[data-select='select2']").select2({
        theme: "bootstrap"
    });
    let characterIds = [];
    $('article [data-entity-type="character_block"]').each(function () {
        let characterId = $(this).data('entity-id');
        if (characterIds.indexOf(characterId) !== -1) {
            return;
        }
        $.ajax({
            url: '/characters/' + characterId + '/stats',
            success: (function (data) {
                $(this).replaceWith(data);
            }).bind(this)
        })
    });
});
