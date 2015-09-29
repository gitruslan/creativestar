/**
 * Created by ruslan on 8/9/15.
 */
var dropDown = {
    _handlerItemsEvent:function(){
        $('.dropdown-list .main-item').click(function(){
            $('.dropdown-list .items').toggleClass('show-items');
            $('.dropdown-list .caret-item').toggleClass('caret-item-color');
            $('.dropdown-wrapper').mouseleave(function(){
                if($('.dropdown-list .items').hasClass('show-items')){
                    $('.dropdown-list .items').toggleClass('show-items');
                    $('.dropdown-list .caret-item').toggleClass('caret-item-color');
                }
            })
        });
        $('.dropdown-list .items').click(function(){
            window.location.href = $(this).data('value');
        });
    },
    init:function(){
        this._handlerItemsEvent();
    }
}
$(document).ready(function(){dropDown.init()})
