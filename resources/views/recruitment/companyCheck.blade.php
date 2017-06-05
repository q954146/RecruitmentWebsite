<!DOCTYPE HTML><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/style/css/style1.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>

<body>
@include('headerAndFooter.headerType1Login')
<div style="clear: both"></div>

<div id="container">
    <div class="content user_modifyContent">
        <dl class="ex_section">
            <dt>
            <h2><em></em>公司审查</h2>
            </dt>
            <form id="companyExamine_Form">
                <p class="ex_prompt">请上传公司营业执照或公司法人相关照片方便后台进行公司验证</p>
                <img id="examineIMG" src="" alt="请上传图片" width="150" height="150"><br>
                <p id="img_prompt"></p>
                <!--*图片格式限制JPG、PNG、GIF-->
                <input type="file" id="fileIMG" class="ex_filebutton" onchange="upload()">
                <label id="file_lable" for="fileIMG">上传</label>
                <input type="submit" value="提交" class="ex_subbutton"  id="subIMG" disabled onclick="sub()">
            </form>

        </dl>
    </div>
    <!-- end #container -->
</div><!-- end #body -->
<div class="clear"></div>
<input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
<a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
</div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')
<script src="/style/js/core.min.js" type="text/javascript"></script>

{{--<script src="/style/js/popup.min.js" type="text/javascript"></script>--}}
</body>
</html>
<script>
    var img_url='';

    function upload() {
        var fileName=$("#fileIMG").val();
        if((/\.jpg$/.test(fileName))||(/\.png$/.test(fileName))||(/\.gif$/.test(fileName))|| (/\.JPG$/.test(fileName))||(/\.PNG$/.test(fileName))||(/\.GIF$/.test(fileName))){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData();
            formData.append('file', $('#fileIMG')[0].files[0]);
            $.ajax({
                url: '/upload/picture',
                type: 'post',
                cache: false,
                data: formData,
                processData: false,
                contentType: false
            }).done(function(res) {
                console.info(res);
                img_url = res.file;
                $("#examineIMG").attr("src","/uploads/" + res.file);//临时用，这个地址应该是后台传
                $("#subIMG").attr('disabled',false).css('background','#019875');
                $('#img_prompt').html("");
            }).fail(function(res) {});
        }
        else{
            $('#img_prompt').html("图片格式限制JPG、PNG、GIF");
        }
    }

    function sub(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                img:img_url
            },
            url:"/check"
        }).done(function (a) {
            console.info(a);
            a.flag==true ? $("#companyExamine_Form").html("<p class='succeed'>上传已成功，谢谢配合</p>") : alert('error');
        })

    }
</script>