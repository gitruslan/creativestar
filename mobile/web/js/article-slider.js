/**
 * Created by ruslan on 8/10/15.
 */
var articleSlider = {
    items:0, // count items
    imageWidth:224, // width with margin
    sliderWidth:parseInt($('.article-slider').width()), // slider width
    sliderStep:225,
    sliderStartPosition:184,
    prepareImagesPosition:function(){
        if(articleSlider._getItems() > 1){
            articleSlider._animateTo('-'+articleSlider.sliderStartPosition);
        }
    },
    handlerControls:function(){
        articleSlider.items = articleSlider._getItems();
        $('.article-slider .slider-control-left').unbind('click').click(function(event){
            //console.log("Left - "+articleSlider._getLeftPosition()+" | Right - "+articleSlider._getRightPosition());
            if(articleSlider._getLeftPosition() >= 41) {
                articleSlider._animateTo('-'+articleSlider.sliderStartPosition);
                return;
            }
            articleSlider._animateTo('+='+articleSlider.sliderStep);
        });
        $('.article-slider .slider-control-right').unbind('click').click(function(event){
            if( articleSlider._getLeftPosition() != 0
                && (articleSlider._getLeftPosition()*(-1)) > articleSlider._getRightPosition()){
                articleSlider._animateTo('-'+articleSlider.sliderStartPosition);
                return;
            }
            articleSlider._animateTo('-='+articleSlider.sliderStep);
        })
    },
    _getItems:function(){
        return parseInt($('#w1 .gallery-item').length);
    },
    _getLeftPosition:function(){
        return parseInt($('#w1').css('left'));
    },
    _getRightPosition:function(){
        return (articleSlider.items * articleSlider.imageWidth) - articleSlider.sliderWidth;
    },
    _animateTo:function(pixels){
        $('#w1').animate({
            left:pixels
        },'slow');
    },
    init:function(){
        this.prepareImagesPosition();
        this.handlerControls();
    }
}

$(document).ready(function(){
    articleSlider.init();
});