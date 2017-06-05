function getObjectURL(file) {
    var url = null ;
    if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
}

function check_img0() {
    $("#upImg").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#perImg").attr("src", objUrl);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append('file', $('#upImg')[0].files[0]);
        $.ajax({
            url: '/resume/image',
            type: 'post',
            cache: false,
            data: formData,
            processData: false,
            contentType: false
        }).done(function (res) {
            console.info(res);
            $('#Picture').val(res.file);
        }).fail(function (res) {
        });
    })
}

// 基本信息
function upInfo() {
    $("#infBox").css("display",'none');
    $("#upName").val($("#name").html());
    if($('#sex').html()=="男"){
        $("input:radio[name='Sex']:first").attr("checked","true");
    }
   else {
        $("input:radio[name='Sex']:last").attr("checked","true");
    }
    $("#selEdu").val($("#edu").html());
    $("#selExp").val($("#exp").html());
    $("#upTel").val($("#tel").html());
    $("#upEmail").val($("#email").html());
    $("#selStatus").val($("#status").html());
    $("#infoForm").css("display",'block');
}
function quitInfo() {
    $("#infBox").css("display",'block');
    $("#infoForm").css("display",'none');
}
function saveInfo() {
    var a,b,c,d,e,f,g;
    a=$("#upName").val();//名字
    b=$("input[name='Sex']:checked").val();//性别
    c=$("#selEdu").val();//学历
    d=$("#selExp").val();//经验
    e=$("#upTel").val();//电话
    f=$("#upEmail").val();//邮箱
    g=$("#selStatus").val();//目前状态
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        data: {
            name:a,
            sex:b,
            education:c,
            workYear:d,
            phone:e,
            email:f,
            state:g
        },
        url:"/resume/basic"
    }).done(function (data) {//记得要在html里写东西
        console.info(data)
        if(data.flag==true) {
            $("#name").html(a);//名字
            $('#sex').html(b);//性别
            $("#edu").html(c);//学历
            $("#exp").html(d);//经验
            $("#tel").html(e);//电话
            $("#email").html(f);//邮箱
            $("#status").html(g);//目前状态
            $("#infBox").css("display", 'block');
            $("#infoForm").css("display", 'none');
        }
        else {
            alert("保存不成功");
        }
    })
}
// 基本信息 end

// 期望工作
function upHope() {
    $("#hopeBox").css("display",'none');
    $("#upcity").val($("#city").html());
    $("input:radio[name='type'][value='"+$("#type").html()+"']").attr("checked","true");
    $("#upposition").val($("#position").html());
    $("#uppay").val($("#pay").html());
    $("#hopeForm").css("display",'block');
}
function quitHope() {
    $("#hopeBox").css("display",'block');
    $("#hopeForm").css("display",'none');
}
function saveHope() {
    var a,b,c,d;
    a=$("#upcity").val();//期望城市
    b=$("input:radio[name='type']:checked").val();//工作类型
    c=$("#upposition").val();//期望职位
    d=$("#uppay").val();//期望月薪
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        data: {
            city:a,
            nature:b,
            profession:c,
            salary:d
        },
        url:"/resume/hopeProfession"
    }).done(function (data) {
        console.info(data);
        if(data.flag==true) {
            $("#city").html(a);//期望城市
            $('#type').html(b);//工作类型
            $("#position").html(c);//期望职位
            $("#pay").html(d);//期望月薪
            $("#hopeBox").css("display", 'block');
            $("#hopeForm").css("display", 'none');
        }
        else {
            alert("保存不成功");
        }
    })
}
// 期望工作end

// 工作经历
function upWork() {
    $("#workBox").css("display",'none');
    $("#upcompany").val($("#company").html());
    $("#upjob").val($("#job").html());
    $("#upWorkStaYear").val($("#workStaYear").html());
    $("#upWorkStaMon").val($("#workStaMon").html());
    $("#upWorkEndYear").val($("#workEndYear").html());
    $("#upWorkEndMon").val($("#workEndMon").html());
    $("#workForm").css("display",'block');
}
function quitWork() {
    $("#workBox").css("display",'block');
    $("#workForm").css("display",'none');
}
function saveWork() {
    var a,b,c,d,e,f;
    a=$("#upcompany").val();//公司名称
    b=$("#upjob").val();//职位名称
    c=$("#upWorkStaYear").val();//开始年份
    d=$("#upWorkStaMon").val();//开始月份
    e=$("#upWorkEndYear").val();//结束年份
    f=$("#upWorkEndMon").val();//结束月份
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        data: {
            company:a,
            profession:b,
            beginYearTime:c,
            beginMonthTime:d,
            endYearTime:e,
            endMonthTime:f
        },
        url:"/resume/workExperience"
    }).done(function (data) {
        console.info(data);
        if(data.flag==true) {
            $("#company").html(a);//公司名称
            $("#job").html(b);//职位名称
            $("#workStaYear").html(c);//开始年份
            $("#workStaMon").html(d);//开始月份
            $("#workEndYear").html(e);//结束年份
            $("#workEndMon").html(f);//开始月份
            $("#workBox").css("display", 'block');
            $("#workForm").css("display", 'none');
        }
        else {
            alert("保存不成功");
        }
    })
}

// 教育经历
function upEdu() {
    $("#eduBox").css("display",'none');
    $("#upschool").val($("#school").html());
    $("#updegree").val($("#degree").html());
    $("#upmajor").val($("#major").html());
    $("#upeduStaYear").val($("#eduStaYear").html());
    $("#upeduEndYear").val($("#eduEndYear").html());
    $("#eduForm").css("display",'block');
}
function quitEdu() {
    $("#eduBox").css("display",'block');
    $("#eduForm").css("display",'none');
}
function saveEdu() {
    var a,b,c,d,e;
    a=$("#upschool").val();//学校
    b=$("#updegree").val();//学位
    c=$("#upmajor").val();//专业
    d=$("#upeduStaYear").val();//开始年份
    e=$("#upeduEndYear").val();//结束年份
    $.ajax({
        type: "POST",
        data: {
            1:a,
            2:b,
            3:c,
            4:d,
            5:e
        },
        url:""
    }).done(function (data) {
        if(data.flag==true) {
            $("#school").html(a);
            $("#degree").html(b);
            $("#major").html(c);
            $("#eduStaYear").html(d);
            $("#eduEndYear").html(e);
            $("#eduBox").css("display", 'block');
            $("#eduForm").css("display", 'none');
        }
        else {
            alert("保存不成功");
        }
    })
}
// 教育经历end


function showupload() {
    $('#upload_resume').show();
}
function uploadQuit() {
    $('#upload_resume').hide();
}
function uploadResume(){
    $("#uploadResume").attr("disabled","true").css("background","silver").attr("value","上传中...");
    $("#uploadQuit").attr("disabled","true").css("background","silver");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = new FormData();
    formData.append('file', $('#uploadFile')[0].files[0]);
    $.ajax({
        url: '/upload/file',
        type: 'post',
        cache: false,
        data: formData,
        processData: false,
        contentType: false
    }).done(function (res) {
        console.info(res.flag);
        if(res.flag==true){
            $("#uploadResume").attr("disabled","false").css("background","#0d9572").attr("value","上传");
            $("#uploadQuit").attr("disabled","false").css("background","#0d9572");
            alert("上传成功");
            $('#upload_resume').hide();
        }
    }).fail(function (res) {
        alert("上传不成功");
    });
}
