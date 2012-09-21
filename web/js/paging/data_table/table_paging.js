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

//Set time
var timeUp = 300;
var timeOut = 400;
var timeDelay = 800;

//Show id
function showId(id){
    $(id).fadeIn(timeOut);
}

//Hide id
function hideId(id){
    $(id).fadeOut(timeOut);
}

//Reload id
function reloadId(id, url){
    $(id).load(url).fadeOut(timeOut).fadeIn(timeUp);
}


//Show data
$(document).ready(function() {

    // คลิกปุ่ม New
    $("#btnNew").click(function(){
        hideId("#btnShowHide");
        reloadId('#panelEvent', urlPostNew);
        return false;
    });

    // คลิกปุ่ม Edit
    $(".btnEdit").click(function(){
        hideId("#btnShowHide");
        reloadId('#panelEvent', this.href);
        document.getElementById('containerwrap').scrollIntoView(true);
        return false;
    });

    // คลิกปุ่ม Delete
    $(".btnDelete").click(function(){
        if (!confirm("คุณต้องการลบ " + namePage + " นี้ใช่หรือไม่")){
            return false;
        }
        var url = this.href;
        $.ajax({
            type : "POST",
            url : url,
            data : {checkPost: 'delete'},
            success : function(msg) {
                if (msg == "finish_math"){
                    alert('!!! ' + namePage + ' นี้มีการใช้งานอยู่ \nไม่สามารถลบออกได้');
                }else if (msg == 'finish') {
                    reloadId('#innerPanel', urlPost);
                    alert('√ ทำการลบ ' + namePage + ' เรียบร้อยแล้ว');
                } else {
                    reloadId('#panelEvent', msg);
                    alert('เกิดการผิดพลาด\n** กรุณาตรวจสอบ **');
                }
            }
        });
        return false;
    });

    // Paging
    $(".inPage").click(function(){
        var numPage = this.value;
        getHtml(numPage, getOrderBy());
        return false;
    });

    //กำหนดจำนวนหน้า
    $(".record").change(function(){
        var numPage = 1
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
