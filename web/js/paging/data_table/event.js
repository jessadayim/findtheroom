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
                    $(idCheck).focus();
                }else if (msg == 'finish') {
                    showId("#btnShowHide");
                    reloadId('#innerPanel', urlPost);
                    hideId("#panelEvent");
                    alert('√ ทำการเพิ่ม ' + namePage + ' เรียบร้อยแล้ว');
                } else {
                    reloadId('#panelEvent', msg);
                    alert(msg+'เกิดการผิดพลาด\n** กรุณาตรวจสอบ **');
                }
            }
        });
        return false;
    });

    //Cancel create, edit
    $("#btnCancelCreate,#btnCancelEdit").click(function(){
        hideId("#panelEvent");
        showId("#btnShowHide");
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
                    $(idCheck).focus();
                }else if (msg == 'finish') {
                    showId("#btnShowHide");
                    reloadId('#innerPanel', urlPost);
                    hideId("#panelEvent");
                    alert('√ ทำการแก้ไข ' + namePage + ' เรียบร้อยแล้ว');
                } else {
                    reloadId('#panelEvent', msg);
                    alert('เกิดการผิดพลาด\n** กรุณาตรวจสอบ **');
                }
            }
        });
        return false;
    });
});