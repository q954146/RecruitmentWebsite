var id=$('input:hidden[name="id"]').attr('value');
function showPop() {
    $('body').append('<form id="deliverForm" action="/send/resume" style="width: 300px;height: 200px;background: lightgoldenrodyellow;position: fixed;top: 100px;left: 500px;z-index: 1000"> ' +
        '<span style="margin: 20px">请选择投递方式：</span><br>' +
        ' <input type="radio" value="0" name="sendType" style="margin: 20px 0 30px 20px;width: 25px;height: 20px">在线<br>' +
        ' <input type="radio" value="1" name="sendType" style="margin: 0 0 30px 20px;width: 25px;height: 20px">附件<br> ' +
        '<input type="hidden" name="id" value="' +id+ '"> ' +
        '<input type="submit" style="width: 50px;height: 30px;margin-left: 20px" value="提交"> ' +
        '<input type="button" style="width: 50px;height: 30px;margin-left: 20px" value="取消" onclick="quitPop()"> </form>');
}
function quitPop(){
    $("#deliverForm").hide();
}

function cancel() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        data: {
            id:id
        },
        url:"/postCancelCollection"
    }).done(function (a) {
        console.info(a);
    })

}


function collection() {
    if( ( $("#JobCollection").css("background-positionY"))=="0px"){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                id:id
            },
            url:"/postCollection"
        }).done(function (a) {
            console.info(a);
            if(a.flag==true ){
               $("#JobCollection").css("background-positionY","-71px");
            }
        })
    }
    else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                id:id
            },
            url:"/postCancelCollection"
        }).done(function (a) {
            console.info(a);
            if(a.flag==true ){
                $("#JobCollection").css("background-positionY","0px");
            }
        })
    }
}