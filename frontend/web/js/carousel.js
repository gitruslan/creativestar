/**
 * Created by ruslan on 8/6/15.
 */


var carousel = {
    additionalImages:[],
    beforeLoad :function(){
        this._detectAdditionalImages()
    },
    catchChangeImage :function(){
        $('.carousel').on('slide.bs.carousel', function () {
            console.log($('.carousel-indicators li.active',this).attr('data-slide-to'));
        })
    },
    _detectAdditionalImages:function(){
        carousel.additionalImages.push($('.carousel .additional_images').data('addimages'));
        if (!carousel.additionalImages.length) {
           return false;
        } return true;
    },
    init:function(){
        this.beforeLoad();
        this.catchChangeImage()
    }
}
$(document).ready(function(){carousel.init()});