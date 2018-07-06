<?php
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="/common/css/language-update.css">
    <link rel="stylesheet" href="/common/css/fonts/roboto.css">
    <link rel="stylesheet" href="/common/css/fonts/nanumgothic.css">
    <link rel="stylesheet" href="/common/css/fonts/zawgyi.css" />
</head>
<body ng-app="myApp">
<?php
/*putenv("HOME=/home/tony");
exec("git config --global user.email 'anthony@gambit88.com' 2>&1");
exec("git config --global user.name 'anthony_gambit88' 2>&1");
exec("git config --global push.default simple 2>&1");
exec("git config --list 2>&1",$config);
exec("cd /home/tony/public_html/common/js/resources/ 2>&1",$cd);
exec("git add /home/tony/public_html/common/js/resources/locale-en_US.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-fil_PH.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-ja_JP.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-ko_KR.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-mm_MY.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-mn_MO.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-th_TH.json 2>&1");
exec("git add /home/tony/public_html/common/js/resources/locale-zh_CN.json 2>&1");
exec("git commit -m 'Apache Initial Commit' 2>&1", $commit);
exec("git push --set-upstream origin master 2>&1",$push);
exec('ssh -vT git@bitbucket.org 2>&1', $bitbucket);

echo "HOME = ".getenv("HOME");
echo "<pre>"; print_r($config); echo "<pre>";
echo "<pre>"; print_r($commit); echo "<pre>";
echo "<pre>"; print_r($push); echo "<pre>";
echo "<pre>"; print_r($bitbucket); echo "<pre>";*/
?>
<div class="loading" style="width:100%;height: 100%;background: white;opacity: 0.8;z-index: 2;position:absolute;display: none;">
    <div style="z-index: 3;position: absolute;left: 43%;top: 40%;opacity: 1;line-height: 20px;">
        <div style="width:100%;height:350px;text-align: center">
            <img src="images/lade.gif" align="center">
            <br>
            <span>Don't close browser. It takes one minute.</span>
            <br>
            <span>ไม่ปิดเบราว์เซอร์ มันต้องใช้เวลาหนึ่งนาที หน้านี้จะทำงานอย่างถูกต้องเพียง</span>
            <br>
            <span>နီးကပ်မဟုတ် browser ကိုလုပ်ပါ။ ဒါဟာတစ်မိနစ်ကြာ။. </span>
            <br>
            <span>不要关闭浏览器。这需要一分钟。</span>
            <br>
            <span>不要關閉瀏覽器。這需要一分鐘。</span>
            <br>
            <span>閉じないでブラウザを実行してください。これは、1分かかります。</span>
            <br>
            <span>Үгүй биш ойрхон хөтчийг байна. Энэ нь нэг минут болдог.</span>
            <br>
            <span>브라우저를 닫지 마세요. 작업 완료시간은 약 1분입니다.</span>
            <br>
            <span>តើកម្មវិធីរុករកមិនជិតស្និទ្ធ។ វាត្រូវចំណាយពេលមួយនាទី.</span>
            <br>
        </div>
    </div>
</div>
<div id="top"ng-controller="myCtrl" style="z-index: 0;">
    <div class="header">
        <div class="container">
            <h2>Select Translate Language</h2>
            <select ng-model="dropdownLanguage"
                    ng-options="displayCountry for displayCountry in displayCountries"
                    ng-change="changeLanguage(dropdownLanguage)"
                    placeholder="Choose Translate Language"
                    class="inputField">
            </select>
        </div>
    </div>
    <div class="container">
        <div align="center" class="warning" style="line-height: 20px;text-align: left">
            <h1 style="color: red">contact email : jamstark3319@gmail.com</h1>
            Please contact support upon error. This page will work correctly only in "demo.frontend88.com/language". Do not updated in the other domains.<br/>
            กรุณาติดต่อฝ่ายสนับสนุนเมื่อเกิดข้อผิดพลาด แต่ใน "demo.frontend88.com/language" อย่าปรับปรุงในโดเมนอื่น ๆ<br/>
            အမှားအပျေါမှာ support ကိုဆက်သွယ် ကျေးဇူးပြု.. ဤစာမျက်နှာကိုသာ "demo.frontend88.com/language" တွင်မှန်မှန်ကန်ကန်အလုပ်မလုပ်ပါလိမ့်မယ်။ သည်အခြား domain များအတွက် updated မနေပါနဲ့<br/>
            请支持有差错. 这个页面将只在“demo.frontend88.com/language”正常工作。不要在其他领域没有更新<br/>
            請支持有差錯. 這個頁面將只在“demo.frontend88.com/language”正常工作。不要在其他領域沒有更新<br/>
            エラー時のサポートにお問い合わせください. このページは「demo.frontend88.com/language」のみ正常に動作します。他のドメインからの更新しないでください<br/>
            Алдаа дээр дэмжлэг холбоо барина уу!. Энэ хуудас нь зөвхөн "demo.frontend88.com/language" -д зөв ажиллах болно. Бусад салбарт шинэчилсэн байхгүй юу<br/>
            에러가 발생하면 연락주세요. 이 페이지는 "demo.frontend88.com/language"에서만 정상 작동 합니다. 다른 도메인에서 업데이트 하지 마세요<br/>
            សូមទាក់ទងបានការគាំទ្រលើកំហុស។ ទំព័រនេះនឹងធ្វើការយ៉ាងត្រឹមត្រូវតែនៅក្នុង« demo.frontend88.com/language "។ កុំធ្វើឱ្យទាន់សម័យនៅក្នុងដែនផ្សេងទៀត<br/>
            <br/>

        </div>
        <form class="js-ajax-php-json" method="POST" accept-charset="utf-8" >
            <div align="center" class="the-return"></div>
            <table cellpadding="0" cellspacing="0" class="tableLanguage">
                <tr>
                    <th>English</th>
                    <th style='display: none;' id="headerKorean">Korean</th>
                    <th style='display: none;' id="headerThailand">Thai</th>
                    <th style='display: none;' id="headerSimplifiedChinese">Simplified Chinese</th>
                    <th style='display: none;' id="headerTraditionalChinese">Traditional Chinese</th>
                    <th style='display: none;' id="headerMyanmar">Burmese</th>
                    <th style='display: none;' id="headerJapanese">Japanese</th>
                    <th style='display: none;' id="headerMongolian">Mongolian</th>
                    <th style='display: none;' id="headerKhmer">Khmer</th>
                </tr>
                <?php
                $en = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-en_US.json');
                $enObj = json_decode($en, true);
                $i=0;
                foreach ($enObj as $enKey=>$enValue) {
                    echo '<tr >';
                    echo "<td valign='top'>" . $enValue. "</td>"; //English
                    echo "<td id='editFields".$i."' style='display: none;' ></td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </table>
            <div id="updateButton" class="container divButton">
                <input type="submit" name="submit" value="Update" class="btn btn-submit" />
            </div>
        </form>
    </div>
    <input type="hidden" value="<?php echo $i; ?>" id="countTotal" >
    <input type="hidden" id="selectedUpdate" >
</div>

<script src="/common/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/common/js/angular.min.js"></script>
<script>
    var app = angular.module('myApp', []);

    app.controller('myCtrl', function($scope) {

        $scope.displayCountries=["Choose the Translate Language", "Korean", "Thailand","Simplified Chinese","Traditional Chinese",  "Myanmar", "Japanese", "Mongolian", "Khmer"];
        var countAll = $('#countTotal').val();

        $scope.changeLanguage = function (selectedCountry) {

            if(selectedCountry == "Korean"){

                <?php
                $ko = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/common/js/resources/locale-ko_KR.json');
                $koObj = json_decode($ko, true);

                 $k=0;
                 foreach ($koObj as $koKey => $koValue) { ?>

                $('#editFields'+[<?php echo $k; ?>]).show().html("<textarea  rows='3' cols='70' class='inputTextarea' name='<?php echo htmlentities($koKey, ENT_QUOTES); ?>' ><?php echo htmlentities($koValue, ENT_QUOTES); ?></textarea>");

                <?php $k++; } ?>

                $('#headerKorean').show();
                $('#headerThailand').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("korean");

            }else if(selectedCountry == "Thailand"){

                <?php
                $th = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-th_TH.json');
                $thObj = json_decode($th, true);
                 $t=0;
                 foreach ($thObj as $thKey => $thValue) { ?>

                $('#editFields'+[<?php echo $t; ?>]).show().html("<textarea  rows='3' cols='70' class='inputTextarea' name='<?php echo htmlentities($thKey, ENT_QUOTES); ?>' ><?php echo htmlentities($thValue, ENT_QUOTES); ?></textarea>");

                <?php $t++; } ?>

                $('#headerThailand').show();
                $('#headerKorean').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("thailand");

            }else if(selectedCountry == "Simplified Chinese"){

                <?php
                $zh = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-zh_CN.json');
                $zhObj = json_decode($zh, true);

                 $z=0;
                 foreach ($zhObj as $zhKey => $zhValue) { ?>

                $('#editFields'+[<?php echo $z; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' name='<?php echo htmlentities($zhKey, ENT_QUOTES); ?>' ><?php echo htmlentities($zhValue, ENT_QUOTES); ?></textarea>");

                <?php $z++; } ?>


                $('#headerSimplifiedChinese').show();
                $('#headerTraditionalChinese').hide();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("simplified-chinese");

            }else if(selectedCountry == "Traditional Chinese"){

                <?php
                $zh = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-zh_TW.json');
                $zhObj = json_decode($zh, true);

                 $z=0;
                 foreach ($zhObj as $zhKey => $zhValue) { ?>

                $('#editFields'+[<?php echo $z; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' name='<?php echo htmlentities($zhKey, ENT_QUOTES); ?>' ><?php echo htmlentities($zhValue, ENT_QUOTES); ?></textarea>");

                <?php $z++; } ?>

                $('#headerTraditionalChinese').show();
                $('#headerSimplifiedChinese').hide();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("traditional-chinese");

            }else if(selectedCountry == "Myanmar"){

                <?php
                $mm = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-mm_MY.json');
                $mmObj = json_decode($mm, true);

                 $m=0;
                 foreach ($mmObj as $mmKey => $mmValue) { ?>

                $('#editFields'+[<?php echo $m; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' stytle='font-family:padauk,Yunghkio,Myanmar3,'Masterpiece Uni Sans';' name='<?php echo htmlentities($mmKey, ENT_QUOTES); ?>' ><?php echo htmlentities($mmValue, ENT_QUOTES); ?></textarea>");

                <?php $m++; } ?>

                $('#headerMyanmar').show();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerJapanese').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("myanmar");

            }else if(selectedCountry == "Japanese"){

                <?php
                $ja = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-ja_JP.json');
                $jaObj = json_decode($ja, true);

                 $j=0;
                 foreach ($jaObj as $jaKey => $jaValue) { ?>

                $('#editFields'+[<?php echo $j; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' name='<?php echo htmlentities($jaKey, ENT_QUOTES); ?>' ><?php echo htmlentities($jaValue, ENT_QUOTES); ?></textarea>");

                <?php $j++; } ?>

                $('#headerJapanese').show();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerMyanmar').hide();
                $('#headerMongolian').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("japanese");

            }else if(selectedCountry == "Mongolian"){

                <?php
                $mn = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-mn_MO.json');
                $mnObj = json_decode($mn, true);

                 $mon=0;
                 foreach ($mnObj as $mnKey => $mnValue) { ?>

                $('#editFields'+[<?php echo $mon; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' name='<?php echo htmlentities($mnKey, ENT_QUOTES); ?>' ><?php echo htmlentities($mnValue, ENT_QUOTES); ?></textarea>");

                <?php $mon++; } ?>

                $('#headerMongolian').show();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#headerKhmer').hide();
                $('#selectedUpdate').val("mongolian");

            }else if(selectedCountry == "Khmer"){

                <?php
                $km = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/common/js/resources/locale-km_CA.json');
                $kmObj = json_decode($km, true);

                 $cam=0;
                 foreach ($kmObj as $kmKey => $kmValue) { ?>

                $('#editFields'+[<?php echo $cam; ?>]).show().html("<textarea rows='3' cols='70' size='100' class='inputTextarea' name='<?php echo htmlentities($kmKey, ENT_QUOTES); ?>' ><?php echo htmlentities($kmValue, ENT_QUOTES); ?></textarea>");

                <?php $cam++; } ?>

                $('#headerKhmer').show();
                $('#headerMongolian').hide();
                $('#headerKorean').hide();
                $('#headerThailand').hide();
                $('#headerSimplifiedChinese').hide();
                $('#headerTraditionalChinese').hide();
                $('#headerMyanmar').hide();
                $('#headerJapanese').hide();
                $('#selectedUpdate').val("khmer");

            }

            $('#updateButton').show();

        };

    });
</script>
<script type="text/javascript">

    $("document").ready(function(){

        $(".js-ajax-php-json").submit(function(){
            $('html, body').animate({ scrollTop: 0 }, 0);
            $(".the-return").hide()
                .removeClass("success")
                .removeClass("error");
            $(".loading").show();

            if($("#selectedUpdate").val() == "korean"){

                var data = {
                    "action": "korean"
                };

            }else if($("#selectedUpdate").val() == "thailand"){

                var data = {
                    "action": "thailand"
                };
            }else if($("#selectedUpdate").val() == "simplified-chinese"){

                var data = {
                    "action": "simplified-chinese"
                };
            }else if($("#selectedUpdate").val() == "traditional-chinese"){

                var data = {
                    "action": "traditional-chinese"
                };
            }else if($("#selectedUpdate").val() == "myanmar"){

                var data = {
                    "action": "myanmar"
                };
            }else if($("#selectedUpdate").val() == "japanese"){

                var data = {
                    "action": "japanese"
                };
            }else if($("#selectedUpdate").val() == "mongolian"){

                var data = {
                    "action": "mongolian"
                };
            }else if($("#selectedUpdate").val() == "khmer"){

                var data = {
                    "action": "khmer"
                };
            }

            data = $(this).serialize() + "&" + $.param(data);

            $.ajax({
                type: "POST",
                url: "languageUpdate.php",
                dataType : "json",
                data : data,
                success: function(data) {
                    $(".the-return").addClass(data.status).fadeIn('slow').animate({opacity: 1.0}, 1500).text(data.message).show();
                    $(".loading").hide();
                    if(data.status=="success"){
                        location.reload();
                    }
                }
            });
            return false;
        });
    });
</script>