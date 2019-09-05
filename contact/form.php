<?php
error_reporting(0);
$HTTP_POST_VARS = &$_POST;
//設定ファイル読み込み
include("inc.php");

//POSTデータ読み込み
$empty = $POST = array();
foreach ($HTTP_POST_VARS as $varname => $varvalue) {
$$varname=$varvalue;
}

//メールアドレス書式チェック
function valid_mail($mail)
{
if(preg_match('/^(?:[^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff])|"[^\\\\\x80-\xff\n\015"]*(?:\\\\[^\x80-\xff][^\\\\\x80-\xff\n\015"]*)*")(?:\.(?:[^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff])|"[^\\\\\x80-\xff\n\015"]*(?:\\\\[^\x80-\xff][^\\\\\x80-\xff\n\015"]*)*"))*@(?:[^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\\\x80-\xff\n\015\[\]]|\\\\[^\x80-\xff])*\])(?:\.(?:[^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\\\x80-\xff\n\015\[\]]|\\\\[^\x80-\xff])*\]))*$/', $mail)) return 1;
}

//エラーチェック
if($_POST[name]==""){ $er.="■お名前が入力されていません。<br />"; }
if($_POST[kana]==""){ $er.="■ふりがなが入力されていません。<br />"; }
if($_POST[mail]==""){ $er.="■E-mailが入力されておりません。<br>"; }
if(valid_mail($_POST[mail])){ }else{ $er.="■E-mailの書式が正しくありません<br>"; }
if($_POST[ran]==""){ $er.="■お問い合わせ内容が入力されていません。<br />"; }



//送信画面
if($_POST[sousin_x]!=""){

	//※※※※※※※※※※※※※※※※※※※※※※※※※
	//お客様へメール
	//※※※※※※※※※※※※※※※※※※※※※※※※※

	$sendoto=$mail;

	$subject="【自動返信確認メール】エミューオイルショップへお問い合わせをありがとうございます。";
	$subject=mb_convert_encoding($subject,"JIS","utf-8");
	$subject=base64_encode($subject);
	$subject="=?iso-2022-jp?B?".$subject."?=";
	
	//* 内容
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.=$name."様\n";
	$body.="この度は、エミューオイルショップへ\n";
	$body.="お問い合わせを頂きまして、誠にありがとうございます。\n";
	$body.="下記の通りお問い合わせを承りましたのでご確認ください。\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$body.="お問い合わせ内容\n";
	$body.="**********************************************************************\n";
	$body.="■お名前：\n";
	$body.=$name."\n";
	$body.="■ふりがな：\n";
	$body.=$kana."\n";
	$body.="■電話番号：\n";
	$body.=$tel1."";
	$body.="-";
	$body.=$tel2."";
	$body.="-";
	$body.=$tel3."\n";
	$body.="■E-mail：\n";
	$body.=$mail."\n";
	$body.="■お問い合わせ内容：\n";
	$body.=$ran."\n\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.="エミューの雫公式ショッピングサイト「エミューオイルショップ」\n";
	$body.="株式会社ユーコネクト TEL:0120-799-100(平日9:30～18:30 土日祝祭日休み)\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.="※お電話の際は「エミューオイルショップお問い合わせの件」とお伝えください。\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body=mb_convert_encoding($body,"JIS","utf-8");

	/* ヘッダ */
	$headers="From:".$send."\n";
	$headers.="MIME-Version: 1.0\n";
	$headers.="Content-type: text/plain; charset=\"iso-2022-jp\"\n";
	$headers.="Content-Transfer-Encoding: 7bit\n";
	$headers=mb_convert_encoding($headers,"JIS","utf-8");
	
	mail($sendoto,$subject,$body,$headers);
	
	//※※※※※※※※※※※※※※※※※※※※※※※※※
	//担当者へメール
	//※※※※※※※※※※※※※※※※※※※※※※※※※

	$sendoto=$send;
	
	$subject="【お問い合わせ】エミューオイルショップへお問い合わせがありました！";
	$subject=mb_convert_encoding($subject,"JIS","utf-8");
	$subject=base64_encode($subject);
	$subject="=?iso-2022-jp?B?".$subject."?=";
	
	//* 内容
	$body="エミューオイルショップへのお問い合わせ内容は以下、\n\n";
	$body.="**********************************************************************\n";
	$body.="■お名前：\n";
	$body.=$name."\n";
	$body.="■ふりがな：\n";
	$body.=$kana."\n";
	$body.="■電話番号：\n";
	$body.=$tel1."";
	$body.="-";
	$body.=$tel2."";
	$body.="-";
	$body.=$tel3."\n";
	$body.="■E-mail：\n";
	$body.=$mail."\n";
	$body.="■お問い合わせ内容：\n";
	$body.=$ran."\n\n";
	$body.="**********************************************************************\n";

	$body=mb_convert_encoding($body,"JIS","utf-8");

	/* ヘッダ */
	$headers="From: ".$mail."\n";
	$headers.="MIME-Version: 1.0\n";
	$headers.="Content-type: text/plain; charset=\"iso-2022-jp\"\n";
	$headers.="Content-Transfer-Encoding: 7bit\n";
	$headers=mb_convert_encoding($headers,"JIS","utf-8");
	
	mail($sendoto,$subject,$body,$headers);

	header("Location: thankyou.html");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, maximum-scale=1.0, user-scalable=yes">
<link rel="stylesheet" href="../css/formcommon_sp.css" media="screen and (max-width:600px)" />
<link rel="stylesheet" href="../css/formcommon.css" media="screen and (min-width:601px)" />
<title>エミューオイルショップお問い合わせ画面 | 100％天然エミューオイル「エミューの雫」公式通販店</title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-30334537-2', 'emu-oil.asia');
  ga('send', 'pageview');

</script>
</head>
<body onload="javascript:scr();">
<form method="POST" name="n301" action="form.php">
  <input name="scroll" type="hidden">
  <?php
$empty = $POST = array();
foreach ($HTTP_POST_VARS as $varname => $varvalue) {

//カンマ抜き
//$varvalue=ereg_replace(",","",$varvalue);

	if(is_array($varvalue)){

		for($i=0;$i<sizeof($varvalue);$i++){
		$varvalue2.=$varvalue[$i];
		if($varvalue[$i]!="" and $varvalue[($i+1)]!=""){ $varvalue2.="---"; }
		}
		
		$varvalue=$varvalue2;
		$varvalue2="";
	}
	
	$$varname=$varvalue;
	
	if($_POST[kakunin_x]!=""){
	//hidden
	if($varname!="scroll" and $varname!="submit" and $varname!="kakunin_x" and $varname!="sousin_x"){
	echo "<input type=\"hidden\" name=\"".$varname."\" value=\"".$varvalue."\">\n";
	}
	}
}
?>
  <div class="bdy_bg">
    <div id="wrapper">
      <div id="header">
        <h1><img src="../img/contact/title.jpg" alt="エミューオイルショップ　お問い合わせ画面" /></h1>
        <div id="logo"><img src="../img/contact/logo.jpg" class="img100Non" /></div>
      </div>
      <div id="contents">
          <?php
  //入力画面用
  if($_POST[kakunin_x]=="" or $er!=""){
  ?>
          <h2>2.入力画面</h2>  
          <div class="order_txt01">
            <p class="fc-redb">お問い合せ時の諸注意</p>
            <p><span class="fc-redb">※</span>お手数ですが、【必須】の箇所は全てご入力をお願い致します。<br />
              ご入力情報は SSL暗号化通信により保護されます。</p>
          </div>
          <div class="step"><img src="../img/contact/step02.jpg" /></div>
          <?php
  }else{
  //確認画面用
  ?>
          <h2>3.確認画面</h2>
          <div class="order_txt01">
            <p>ご入力頂いた内容に間違いがないかをよくご確認ください。<br />
              間違いがなければ、下の「この内容で確定する」ボタンを押してください。</p>
          </div>
          <div class="step"><img src="../img/contact/step03.jpg" /></div>
          <?php
  }

if($_POST[kakunin_x]!="" and $er!=""){
?>
          <div class="order_txt02">
            <p><?php echo $er; ?></p>
          </div>
          <?php
}

//入力画面用
if($_POST[kakunin_x]=="" or $er!=""){
?>
        <div class="conbox900">
          <h3>お客様情報</h3>
          <div class="formbox">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <th><span class="fc-redb">【必須】</span>お名前</th>
                  <td><input name="name" type="text" class="text" value="<?php echo $name; ?>" /></td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>ふりがな</th>
                  <td><input name="kana" type="text" class="text" value="<?php echo $kana; ?>" /></td>
                </tr>
                <tr>
                  <th>電話番号</th>
                  <td><input type="text" name="tel1" class="text" value="<?php echo $tel1; ?>" size="5" maxlength="5" />
                    -
                    <input type="text" name="tel2" class="text" value="<?php echo $tel2; ?>" size="5" maxlength="5" />
                    -
                    <input type="text" name="tel3" class="text" value="<?php echo $tel3; ?>" size="5" maxlength="5" />
                    <br />
                    ※半角数字</td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>E-mail</th>
                  <td><input name="mail" type="text" id="mail" size="25" value="<?php echo $_POST[mail]; ?>" style="ime-mode:disabled;" />
　
                    <br />
                    ※半角英数                     </td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>お問い合わせ内容</th>
                  <td><textarea name="ran" id="ran" cols="25" rows="5"><?php echo $_POST[ran]; ?></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="btn_inner">
            <input type="image" width="100%" name="kakunin" src="../img/contact/order_btn01.png" alt="確認画面へ進む" />
          </div>
          <?php
  //確認画面用
  }else{
  ?>
          <h3>お客様情報</h3>
          <div class="formbox">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <th>お名前</th>
                  <td><?php echo $name; ?></td>
                </tr>
                <tr>
                  <th>ふりがな</th>
                  <td><?php echo $kana; ?></td>
                </tr>
                <tr>
                  <th>電話番号</th>
                  <td><?php echo $tel1; ?>-<?php echo $tel2; ?>-<?php echo $tel3; ?></td>
                </tr>
                <tr>
                  <th>E-mail</th>
                  <td><?php echo $mail; ?></td>
                </tr>
                <tr>
                  <th>お問い合わせ内容</th>
                  <td><?php echo $ran; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="btn_inner">
            <input type="image" width="100%" name="sousin" src="../img/contact/order_btn02.png" alt="この内容で確定する" />
          </div>
          <?php
  }
  ?>
        </div>
        <!--conbox900-->
      </div>
      <!--contents-->
    </div>
  </div>
  <!--wrapper-->
  </div>
  <div id="footer" class="ts_clear">
    <address>
    Copyright &copy; 株式会社ユーコネクト All Rights Reserved.
    </address>
  </div>
</form>
</body>
</html>
