define([
    'Magento_Ui/js/form/element/abstract',
    'mageUtils',
    'jquery',
    'mage/url'
], function (Element, utils, $) {
    'use strict';
    return Element.extend({
        initialize: function () {
            this._super();
            if (this.initialValue == ''){
                this.base_url = this.imports.base_url+'pub/media/hungbd/CustomOption/n/o/no-pre_1.png';
            }
            else{
                this.base_url = this.imports.base_url+'pub/media/'+this.initialValue;
            }
        },

        getFileName: function () {
            var test = this.uid;
            $('#preview-'+this.uid).attr('src',this.imports.base_url+'pub/media/'+$('#'+this.uid).val());
            console.log(test);
        },
    });
});