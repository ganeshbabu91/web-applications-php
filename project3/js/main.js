$(document).ready(function(){
    /* Format dates in the sales table */
    $('.sales.table td>a').each(function(i,val){
        var date = new Date(val.innerText);
        var formattedDate = date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();
        this.innerText = formattedDate;
    });
    $("#searchForm [type='radio']").on('click', function(){
        var target = $(this).data('target');
        if(target == '.title-text'){
            $(target).show();
            $('.desc-text').hide();
            $('.title-text').val("");
            $('.desc-text').val("");
        } else if(target == '.desc-text'){
            $(target).show();
            $('.title-text').hide();
            $('.title-text').val("");
            $('.desc-text').val("");
        } else{
            $('.title-text').val("").hide();
            $('.desc-text').val("").hide();
        }
        
    });
});