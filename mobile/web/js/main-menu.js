/**
 * Created by ruslan on 10/1/15.
 */
var mainMenu = {
    showMenuButton:'.navbar-left-menu',
    hideMenuButton:'.main-menu-close',
    mainClass:'.main-menu',
    handlerMainMenu:function(){
        mainMenu._showMenu();
        mainMenu._hideMenu();
    },
    _hideMenu:function(){
        $(mainMenu.showMenuButton).click(function(){
            $(mainMenu.mainClass).fadeIn(500);//css('display','block');
        })
    },
    _showMenu:function(){
        $(mainMenu.hideMenuButton).click(function(){
            $(mainMenu.mainClass).fadeOut(500);
        })
    },
    init:function(){
        this.handlerMainMenu();
    }
}
$(document).ready(function(){mainMenu.init()});