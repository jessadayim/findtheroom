

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
var tiimeUp = 300;
var timeOut = 400;
var timeDelay = 800;

//Show id
function showId(id){
    alert(id)
    $(id).fadeIn(timeOut);
}

//Hide id
function hideId(id){
    $(id).fadeOut(timeOut);
}

//Reload id
function reloadId(id, url){
    $(id).load(url).fadeOut('slow').fadeIn(tiimeUp);
}


//Show data
$(document).ready(function() {

    // คลิกปุ่ม New
    $("#btnNew").click(function(){
//        $("#btnShowHide").hide("slow");
        hideId("#btnShowHide");
//        $('#edit').fadeOut('slow');
        hideId("#edit");
        reloadId('#new', urlPostNew);
        return false;
    });

    // คลิกปุ่ม Edit
    $(".btnEdit").click(function(){
//        $("#btnShowHide").hide("slow");
        hideId("#btnShowHide");
//        $('#new').fadeOut('slow');
        hideId("#new");
        reloadId('#edit', this.href);
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
//                    $('#innerPanel').fadeOut(100).load(urlPost).fadeIn("slow");
                    reloadId('#innerPanel', urlPost);
                    alert('√ ทำการลบ ' + namePage + ' เรียบร้อยแล้ว');
                } else {
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

//Insert data
$(document).ready(function() {
    $("#formCreate").submit(function(){
        $.ajax({
            type : "POST",
            url : urlCreate,
            data : $(this).serialize(),
            success : function(msg) {
                if (msg == "finish_comp"){
                    alert('!!! ชื่อ ' + namePage + ' "' + $(idCheck).val() + '" นี้มีข้อมูลอยู่แล้ว');
                }else if (msg == 'finish') {
//                    $("#btnShowHide").show("slow");
                    showId("#btnShowHide");
//                    $('#innerPanel').fadeOut(100).load(urlPost).fadeIn("slow");
                    reloadId('#innerPanel', urlPost);
//                    $("#new").slideUp(300).delay(800).fadeOut(400);
                    hideId("#new");
                    alert('√ ทำการเพิ่ม ' + namePage + ' เรียบร้อยแล้ว');
                } else {
//                    $('#new').fadeOut().load(msg).fadeIn("slow");
                    reloadId('#new', msg);
                    alert(msg+'เกิดการผิดพลาด\n** กรุณาตรวจสอบ **');
                }
            }
        });
        return false;
    });

    $("#btnCancelCreate").click(function(){
//        $("#btnShowHide").show("slow");
        showId("#btnShowHide");
//        $("#new").slideUp(300).delay(800).fadeOut(400);
        hideId("#new");
        return false;
    });
});

//Edit data
$(document).ready(function() {
    $("#formEdit").submit(function(){
        $.ajax({
            type : "POST",
            url : urlEdit,
            data : $("#formEdit").serialize(),
            success : function(msg) {
                if (msg == "finish_comp"){
                    alert('!!! ชื่อ ' + namePage + ' "' + $(idCheck).val() + '" นี้มีข้อมูลอยู่แล้ว');
                }else if (msg == 'finish') {
//                    $("#btnShowHide").show("slow");
                    showId("#btnShowHide");
//                    $('#innerPanel').fadeOut(100).load(urlPost).delay(800).fadeIn("slow");
                    reloadId('#innerPanel', urlPost);
//                    $("#edit").slideUp(300).delay(800).fadeOut(400);
                    hideId("#edit");
                    alert('√ ทำการแก้ไข ' + namePage + ' เรียบร้อยแล้ว');
                } else {
//                    $('#edit').fadeOut(300).load(msg).fadeIn("slow");
                    reloadId('#edit', msg);
                    alert('เกิดการผิดพลาด\n** กรุณาตรวจสอบ **');
                }
            }
        });
        return false;
    });

    $("#btnCancelEdit").click(function(){
//        $("#btnShowHide").show("slow");
        showId("#btnShowHide");
//        $("#edit").slideUp(300).delay(800).fadeOut(400);
        hideId("#edit");
        return false;
    });
});