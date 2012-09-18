$(document).ready(function() {
    // Paging
    $(".inPage").click(function(){
        var numPage = this.value;
        getHtml(numPage, getOrderBy());
        return false;
    });

    //กำหนดจำนวนหน้า
    $(".record").change(function(){
        var numPage = $(".disableBtn").val();
        getHtml(numPage, getOrderBy());
        return false;
    });

    //ค้นหาด้วยข้อความ
    $("#tbxSearch").change(function(){
        var numPage = 1;
        getHtml(numPage, getOrderBy());
        return false;
    });

    //Order by
    $(".btnOrderBy").click(function(){
        var type = this.id;
        type = type.replace('sort_', '');
        var numPage = $(".disableBtn").val();
        var orderBy = "&orderBy=" + type;
        if (orderByOld == type){
            if (orderByTypeOld == 'asc'){
                orderBy += "&orderByType=desc";
            }else{
                orderBy += "&orderByType=asc";
            }
        }else{
            orderBy += "&orderByType=desc";
        }
        getHtml(numPage, orderBy);
        return false;
    });
});

//get ค่าการ sort ปัจจุบัน
function getOrderBy(){
    var strOrderBy = "&orderBy=" + orderByOld + "&orderByType=" + orderByTypeOld;
    return strOrderBy;
}

//Paging, Sorting, Search
function getHtml(numPage, orderBy){
    var recordValue = $(".record").val();
    var textSearch = $("#tbxSearch").val();
    var send = "?numPage=" + numPage + "&record=" + recordValue + "&textSearch=" + textSearch + orderBy;
    $.post(urlPost + send, function(data) {
        $('#innerPanel').html(data);
    });
}