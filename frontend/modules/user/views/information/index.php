<?php
$this->registerCss("
    .user-information-index{max-width: 450px;margin: 180px auto;border: 1px solid #eee;padding:10px;}
    @media screen and (max-width: 768px){
        .user-information-index{margin: 80px auto;}
        .wrap > .container-fluid{padding:80px 0 0 !important;}
        .user-information-index{}
    }
   
");

?>
<link href="//images.zastatic.com/imwap/wap2015/css/public/base_e5352a8.css" rel="stylesheet">
<link href="//images.zastatic.com/imwap/wap2015/css/public/base_e5352a8.css" rel="stylesheet">
<link href="//images.zastatic.com/imwap/wap2015/css/register201603_0be970e.css" rel="stylesheet">
<div class="user-information-index">
    <section id="stepsBox">
        <section id="genderBox" class="genderBox">
            <article class="title">
                <span class="reg2-icons title-icon"></span>
                <h1>只要您提供一些简单的信息,就能专门为您推荐合适的异性了！</h1>
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
