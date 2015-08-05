/**
 * Created by ruslan on 8/6/15.
 */


var carousel = {
    additionalImages:[],
    countItems:0,
    beforeLoad :function(){
        this._detectAdditionalImages();
        this._countItems();
    },
    catchChangeImage :function(){
        $('.carousel').on('slide.bs.carousel', function () {
            curItem = $('.carousel-indicators li.active',this).index();
            if (curItem == carousel.countItems) {
                curItem  = carousel.additionalImages[0][0];
            } else {
                curItem  = carousel.additionalImages[0][++curItem];
            }
            
        })
    },
    _detectAdditionalImages:function(){
        carousel.additionalImages.push($('.carousel .additional_images').data('addimages'));
    },
    _countItems:function(){
        carousel.countItems = $('.carousel .carousel-indicators li').length - 1;
    },
    _changeImage:function(){

    },
    init:function(){
        this.beforeLoad();
        this.catchChangeImage()
    }
}
$(document).ready(function(){carousel.init()});