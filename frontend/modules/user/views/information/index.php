<?php
$this->title = "完善资料";
$this->registerCss("
    .user-information-index{max-width: 450px;border: 1px solid #eee;padding:10px;margin:auto;}
    @media screen and (max-width: 768px){
        .user-information-index{margin: 10px auto;}
        .wrap > .container-fluid{padding:10px 0 0 !important;}
        .user-information-index{}
    }
   
");

?>
<link href="/css/profile.css" rel="stylesheet">

<div class="user-information-index">
    <section id="stepsBox">
        <section id="genderBox" class="genderBox">
            <article class="title">
                <span class="reg2-icons title-icon"></span>
                <h1 style="line-height: 18px;">只要您提供一些简单的信息,就能专门为您推荐合适的异性了！</h1>
            </article>
            <article class="header">
                <div class="reg2-icons header-cont gender-head">请问您是一位美女，还是一位帅哥？</div>
            </article>
            <div class="flexBox content">
                <div class="female flex1" onclick="saveSex(2)">
                    <div class="cont-ct">
                        <div class="circle girl cont-ct"><i class="reg2-icons gb g"></i></div>
                    </div>
                    <p>美女</p>
                </div>
                <div class="male flex1" onclick="saveSex(1)">
                    <div class="cont-ct">
                        <div class="circle boy cont-ct"><i class="reg2-icons gb b"></i></div>
                    </div>
                    <p>帅哥</p>
                </div>
            </div>
        </section>
    </section>
</div>
<script>
    function saveSex(con) {

        window.location.href = "/user/information/save-sex?sex="+con;
    }
</script>
