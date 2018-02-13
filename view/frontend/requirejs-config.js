var config = {
    paths: {
        "hungbd_customoption": "Hungbd_Slider/js/jquery.flexslider"
    },
    shim: {
        'hungbd_customoption': {
            deps: ['jquery']
        }
    },
    map: {
        '*': {
            hungbd_customoption:    'Hungbd_CustomOptionImage/js/customoption',
        }
    }
};
