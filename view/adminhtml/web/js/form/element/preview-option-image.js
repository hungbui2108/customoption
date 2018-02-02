define([
    'Magento_Ui/js/form/element/abstract',
    'mageUtils',
    'jquery',
    'jquery/file-uploader'
], function (Element, utils, $) {
    'use strict';

    return Element.extend({
        initialize: function () {
            this._super();
        },

        getFileName: function (file) {
            return file.url;
        },
    });
});