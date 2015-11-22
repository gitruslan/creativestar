/**
 * Created by ruslan on 8/10/15.
 */
var articleSlider = {
    items:0,
    _handlerControls:function(){
        articleSlider.items = articleSlider._getItems();
      // console.log(articleSlider._getRightPosition());
        $('.article-slider .slider-control-left').unbind('click').click(function(event){
            if(articleSlider._getLeftPosition() == 0) return;
            $('#w1').animate({
                left:'+=234'
            },'slow');
        });
        $('.article-slider .slider-control-right').unbind('click').click(function(event){
            //console.log(articleSlider._getRightPosition()+"--"+articleSlider._getLeftPosition()+'  '+articleSlider._getWorkPath());
            if(articleSlider._getLeftPosition() != 0
               && ((articleSlider._getLeftPosition()+articleSlider._getWorkPath()) <= articleSlider._getWorkPath())) {
                $('#w1').animate({
                    left:'0'
                },'slow');
                return;
            }
            $('#w1').animate({
                left:'-=234'
            },'slow');
        })
    },
    _getItems:function(){
        return parseInt($('#w1 .gallery-item').length);
    },
    _getLeftPosition:function(){
       return parseInt($('#w1').css('left'));
    },
    _getRightPosition:function(){
       return -(articleSlider._getItemsWidth())
    },
    _getItemsWidth:function(){
        return parseInt((articleSlider.items * 234));
    },
    _getWorkPath:function(){
        return parseInt(234 * 3);
    },
    init:function(){
        this._handlerControls();
    }
}

$(document).ready(function(){
    articleSlider.init();
});