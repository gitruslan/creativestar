$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
    $("#article-category_id").change(function(){
        var currentCat = '_'+$(":selected",this).html().toLowerCase();
        var articleView = $("#article-view").val();
        if(currentCat != articleView){
            $("#article-view").val(currentCat);
        }
    });
})