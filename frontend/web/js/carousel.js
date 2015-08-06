/**
 * Created by ruslan on 8/6/15.
 */


var carousel = {
    additionalImages:[],
    countItems:0,
    beforeLoad :function(){
        this._detectAdditionalImages();
        this._countItems();
        this._initDefaultImages();
    },
    catchChangeImage :function(){
        $('.carousel').on('slide.bs.carousel', function () {
            var curItem = $('.carousel-indicators li.active',this).index();
            if (curItem == carousel.countItems) {
                curItem  = carousel.additionalImages[0][0];
            } else {
                curItem  = carousel.additionalImages[0][++curItem];
            }
            $('.carousel-left-top-image').animate({opacity: 0}, 'slow', function() {
                $(this)
                    .css({'background-image': 'url('+carousel._changeImage('top_left_img',curItem) +')'})
                    .animate({opacity: 1});
            });

            $('.carousel-left-bottom-image').animate({opacity: 0}, 'slow', function() {
                $(this)
                    .css({'background-image': 'url('+carousel._changeImage('bottom_left_img',curItem) +')'})
                    .animate({opacity: 1});
            });
            $('.carousel-right-top-image').animate({opacity: 0}, 'slow', function() {
                $(this)
                    .css({'background-image': 'url('+carousel._changeImage('top_right_img',curItem) +')'})
                    .animate({opacity: 1});
            });
            $('.carousel-right-bottom-image').animate({opacity: 0}, 'slow', function() {
                $(this)
                    .css({'background-image': 'url('+carousel._changeImage('bottom_right_img',curItem) +')'})
                    .animate({opacity: 1});
            });
        })
    },
    _detectAdditionalImages:function(){
        carousel.additionalImages.push($('.carousel .additional_images').data('addimages'));
    },
    _countItems:function(){
        carousel.countItems = $('.carousel .carousel-indicators li').length - 1;
    },
    _initDefaultImages:function(){
        var curItem = carousel.additionalImages[0][0];
        $('.carousel-left-top-image').animate({opacity: 0}, 'slow', function() {
            $(this)
                .css({'background-image': 'url('+carousel._changeImage('top_left_img',curItem) +')'})
                .animate({opacity: 1});
        });

        $('.carousel-left-bottom-image').animate({opacity: 0}, 'slow', function() {
            $(this)
                .css({'background-image': 'url('+carousel._changeImage('bottom_left_img',curItem) +')'})
                .animate({opacity: 1});
        });
        $('.carousel-right-top-image').animate({opacity: 0}, 'slow', function() {
            $(this)
                .css({'background-image': 'url('+carousel._changeImage('top_right_img',curItem) +')'})
                .animate({opacity: 1});
        });
        $('.carousel-right-bottom-image').animate({opacity: 0}, 'slow', function() {
            $(this)
                .css({'background-image': 'url('+carousel._changeImage('bottom_right_img',curItem) +')'})
                .animate({opacity: 1});
        });
    },
    _changeImage:function(imgName, imgArray){
        var imgData = imgArray[imgName];
        if(imgData){
            imgData = imgData['base_url']+'/'+imgData['path'];
        }else imgData = '';
        return imgData;
    }
    ,
    init:function(){
        this.beforeLoad();
        this.catchChangeImage()
    }
}
$(document).ready(function(){carousel.init()});