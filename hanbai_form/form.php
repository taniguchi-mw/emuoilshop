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

if($_POST[coname]==""){ $er.="■法人名又は店舗名等が入力されておりません。<br />"; }
if($_POST[cokana]==""){ $er.="■法人名又は店舗名等（ふりがな）が入力されておりません。<br />"; }
if($_POST[name]==""){ $er.="■ご担当者氏名が入力されておりません。<br />"; }
if($_POST[kana]==""){ $er.="■ご担当者氏名（ふりがな）が入力されておりません。<br />"; }
if($_POST[tel1]==""){ $er.="■電話番号(１枠目)が入力されておりません。<br>"; }
if($_POST[tel2]==""){ $er.="■電話番号(２枠目)が入力されておりません。<br>"; }
if($_POST[tel3]==""){ $er.="■電話番号(３枠目)が入力されておりません。<br>"; }
if($_POST[mail]==""){ $er.="■E-mailが入力されておりません。<br>"; }
if(valid_mail($_POST[mail])){ }else{ $er.="■E-mailの書式が正しくありません<br>"; }
if($_POST[ran]==""){ $er.="■お問い合わせ内容が入力されておりません。<br />"; }



//送信画面
if($_POST[sousin_x]!=""){

	//※※※※※※※※※※※※※※※※※※※※※※※※※
	//お客様へメール
	//※※※※※※※※※※※※※※※※※※※※※※※※※

	$sendoto=$mail;

	$subject="【自動返信確認メール】エミューオイルショップへ販売代理店のお問い合わせをありがとうございます。";
	$subject=mb_convert_encoding($subject,"JIS","utf-8");
	$subject=base64_encode($subject);
	$subject="=?iso-2022-jp?B?".$subject."?=";
	
	//* 内容
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.=$coname."　";
	$body.=$name."様\n";
	$body.="この度は、エミューオイルショップへ販売代理店の\n";
	$body.="お問い合わせを頂きまして、誠にありがとうございます。\n";
	$body.="下記の通り承りましたのでご確認ください。\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$body.="お問い合わせ内容\n";
	$body.="**********************************************************************\n";
	$body.="■法人名又は店舗名等：\n";
	$body.=$coname."\n";
	$body.="■法人名又は店舗名等（ふりがな）：\n";
	$body.=$cokana."\n";
	$body.="■ご担当者氏名：\n";
	$body.=$name."\n";
	$body.="■ご担当者氏名（ふりがな）：\n";
	$body.=$kana."\n";
	$body.="■電話番号：\n";
	$body.=$tel1."";
	$body.="-";
	$body.=$tel2."";
	$body.="-";
	$body.=$tel3."\n";
	$body.="■E-mail：\n";
	$body.=$mail."\n";
	$body.="■郵便番号：\n";
	$body.=$yubin1."";
	$body.="-";
	$body.=$yubin2."\n";
	$body.="■都道府県：\n";
	$body.=$todou."\n";
	$body.="■住所：\n";
	$body.=$jyusyo1."\n";
	$body.="■建物名・フロア名など：\n";
	$body.=$jyusyo2."\n";
	$body.="■備考欄：\n";
	$body.=$ran."\n\n";
	$body.="------------------------------------------------------------------\n";
	$body.="■販売店募集に関する諸注意\n";
	$body.="※法人様限定での募集です。\n";
	$body.="------------------------------------------------------------------\n\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.="エミューの雫公式ショッピングサイト「エミューオイルショップ」\n";
	$body.="株式会社ユーコネクト TEL:0120-799-100(平日9:30～18:30 土日祝祭日休み)\n";
	$body.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$body.="※お電話の際は「エミューオイルショップ販売代理店の件」とお伝えください。\n";
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
	
	$subject="【販売代理店募集】エミューオイルショップへ販売代理店のお問い合わせがありました！";
	$subject=mb_convert_encoding($subject,"JIS","utf-8");
	$subject=base64_encode($subject);
	$subject="=?iso-2022-jp?B?".$subject."?=";
	
	//* 内容
	$body="エミューオイルショップへ販売代理店のお問い合わせ内容は以下、\n\n";
	$body.="**********************************************************************\n";
	$body.="■法人名又は店舗名等：\n";
	$body.=$coname."\n";
	$body.="■法人名又は店舗名等（ふりがな）：\n";
	$body.=$cokana."\n";
	$body.="■ご担当者氏名：\n";
	$body.=$name."\n";
	$body.="■ご担当者氏名（ふりがな）：\n";
	$body.=$kana."\n";
	$body.="■電話番号：\n";
	$body.=$tel1."";
	$body.="-";
	$body.=$tel2."";
	$body.="-";
	$body.=$tel3."\n";
	$body.="■E-mail：\n";
	$body.=$mail."\n";
	$body.="■郵便番号：\n";
	$body.=$yubin1."";
	$body.="-";
	$body.=$yubin2."\n";
	$body.="■都道府県：\n";
	$body.=$todou."\n";
	$body.="■住所：\n";
	$body.=$jyusyo1."\n";
	$body.="■建物名・フロア名など：\n";
	$body.=$jyusyo2."\n";
	$body.="■備考欄：\n";
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
<title>販売代理店のお問い合わせ画面 | 100％天然エミューオイル「エミューの雫」公式通販店</title>
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
        <h1><img src="../img/hanbai/title.jpg" alt="販売代理店のお問い合わせ画面" /></h1>
        <div id="logo"><img src="../img/contact/logo.jpg" class="img100Non" /></div>
      </div>
      <div id="contents">
        <?php
  //入力画面用
  if($_POST[kakunin_x]=="" or $er!=""){
  ?>
        <h2>2.入力画面</h2>
        <div class="order_txt01">
          <p class="fc-redb">お問い合わせ時の諸注意</p>
          <p>※お手数ですが、【必須】の箇所は全てご入力をお願い致します。<br />
            ご入力情報は SSL暗号化通信により保護されます。 </p>
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
          <h3>販売代理店様情報</h3>
          <div class="formbox">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <th><span class="fc-redb">【必須】</span>法人名又は店舗名等</th>
                  <td><input name="coname" type="text" class="text" value="<?php echo $coname; ?>" size="25" /></td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>法人名又は店舗名等<br />
                    （ふりがな）</th>
                  <td><input name="cokana" type="text" class="text" value="<?php echo $cokana; ?>" size="25" /></td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>ご担当者氏名</th>
                  <td><input name="name" type="text" class="text" value="<?php echo $name; ?>" size="25" /></td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>ご担当者氏名<br />
                    （ふりがな）</th>
                  <td><input name="kana" type="text" class="text" value="<?php echo $kana; ?>" size="25" /></td>
                </tr>
                <tr>
                  <th><span class="fc-redb">【必須】</span>電話番号</th>
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
                    ※半角英数</td>
                </tr>
                <tr>
                  <th>郵便番号</th>
                  <td><input name="yubin1" type="text" class="text" value="<?php echo $yubin1; ?>" size="3" maxlength="3" />
                    -
                    <input name="yubin2" type="text" class="text" value="<?php echo $yubin2; ?>" size="4" maxlength="4" />
                    <br />
                    <span class="fs-12 fc-grb">※住所のご記入は必須ではございませんが、ご記入いただいたきますと、卸値・注文書以外の詳しい紙資料をお送りすることが可能です。</span><span class="fs-12">ご記入のない場合は、メールにて注文書等をお送りさせていただきます。 </span></td>
                </tr>
                <tr>
                  <th>都道府県</th>
                  <td><select name="todou" id="todou">
                      <option value="">選択してください</option>
                      <option value="北海道"<?php if($_POST[todou]=="北海道"){ echo " selected"; } ?>>北海道</option>
                      <option value="青森県"<?php if($_POST[todou]=="青森県"){ echo " selected"; } ?>>青森県</option>
                      <option value="秋田県"<?php if($_POST[todou]=="秋田県"){ echo " selected"; } ?>>秋田県</option>
                      <option value="岩手県"<?php if($_POST[todou]=="岩手県"){ echo " selected"; } ?>>岩手県</option>
                      <option value="宮城県"<?php if($_POST[todou]=="宮城県"){ echo " selected"; } ?>>宮城県</option>
                      <option value="山形県"<?php if($_POST[todou]=="山形県"){ echo " selected"; } ?>>山形県</option>
                      <option value="福島県"<?php if($_POST[todou]=="福島県"){ echo " selected"; } ?>>福島県</option>
                      <option value="茨城県"<?php if($_POST[todou]=="茨城県"){ echo " selected"; } ?>>茨城県</option>
                      <option value="栃木県"<?php if($_POST[todou]=="栃木県"){ echo " selected"; } ?>>栃木県</option>
                      <option value="群馬県"<?php if($_POST[todou]=="群馬県"){ echo " selected"; } ?>>群馬県</option>
                      <option value="埼玉県"<?php if($_POST[todou]=="埼玉県"){ echo " selected"; } ?>>埼玉県</option>
                      <option value="千葉県"<?php if($_POST[todou]=="千葉県"){ echo " selected"; } ?>>千葉県</option>
                      <option value="東京都"<?php if($_POST[todou]=="東京都"){ echo " selected"; } ?>>東京都</option>
                      <option value="神奈川県"<?php if($_POST[todou]=="神奈川県"){ echo " selected"; } ?>>神奈川県</option>
                      <option value="山梨県"<?php if($_POST[todou]=="山梨県"){ echo " selected"; } ?>>山梨県</option>
                      <option value="長野県"<?php if($_POST[todou]=="長野県"){ echo " selected"; } ?>>長野県</option>
                      <option value="新潟県"<?php if($_POST[todou]=="新潟県"){ echo " selected"; } ?>>新潟県</option>
                      <option value="富山県"<?php if($_POST[todou]=="富山県"){ echo " selected"; } ?>>富山県</option>
                      <option value="石川県"<?php if($_POST[todou]=="石川県"){ echo " selected"; } ?>>石川県</option>
                      <option value="福井県"<?php if($_POST[todou]=="福井県"){ echo " selected"; } ?>>福井県</option>
                      <option value="岐阜県"<?php if($_POST[todou]=="岐阜県"){ echo " selected"; } ?>>岐阜県</option>
                      <option value="静岡県"<?php if($_POST[todou]=="静岡県"){ echo " selected"; } ?>>静岡県</option>
                      <option value="愛知県"<?php if($_POST[todou]=="愛知県"){ echo " selected"; } ?>>愛知県</option>
                      <option value="三重県"<?php if($_POST[todou]=="三重県"){ echo " selected"; } ?>>三重県</option>
                      <option value="滋賀県"<?php if($_POST[todou]=="滋賀県"){ echo " selected"; } ?>>滋賀県</option>
                      <option value="京都府"<?php if($_POST[todou]=="京都府"){ echo " selected"; } ?>>京都府</option>
                      <option value="大阪府"<?php if($_POST[todou]=="大阪府"){ echo " selected"; } ?>>大阪府</option>
                      <option value="兵庫県"<?php if($_POST[todou]=="兵庫県"){ echo " selected"; } ?>>兵庫県</option>
                      <option value="奈良県"<?php if($_POST[todou]=="奈良県"){ echo " selected"; } ?>>奈良県</option>
                      <option value="和歌山県"<?php if($_POST[todou]=="和歌山県"){ echo " selected"; } ?>>和歌山県</option>
                      <option value="鳥取県"<?php if($_POST[todou]=="鳥取県"){ echo " selected"; } ?>>鳥取県</option>
                      <option value="島根県"<?php if($_POST[todou]=="島根県"){ echo " selected"; } ?>>島根県</option>
                      <option value="岡山県"<?php if($_POST[todou]=="岡山県"){ echo " selected"; } ?>>岡山県</option>
                      <option value="広島県"<?php if($_POST[todou]=="広島県"){ echo " selected"; } ?>>広島県</option>
                      <option value="山口県"<?php if($_POST[todou]=="山口県"){ echo " selected"; } ?>>山口県</option>
                      <option value="徳島県"<?php if($_POST[todou]=="徳島県"){ echo " selected"; } ?>>徳島県</option>
                      <option value="香川県"<?php if($_POST[todou]=="香川県"){ echo " selected"; } ?>>香川県</option>
                      <option value="愛媛県"<?php if($_POST[todou]=="愛媛県"){ echo " selected"; } ?>>愛媛県</option>
                      <option value="高知県"<?php if($_POST[todou]=="高知県"){ echo " selected"; } ?>>高知県</option>
                      <option value="福岡県"<?php if($_POST[todou]=="福岡県"){ echo " selected"; } ?>>福岡県</option>
                      <option value="佐賀県"<?php if($_POST[todou]=="佐賀県"){ echo " selected"; } ?>>佐賀県</option>
                      <option value="長崎県"<?php if($_POST[todou]=="長崎県"){ echo " selected"; } ?>>長崎県</option>
                      <option value="熊本県"<?php if($_POST[todou]=="熊本県"){ echo " selected"; } ?>>熊本県</option>
                      <option value="大分県"<?php if($_POST[todou]=="大分県"){ echo " selected"; } ?>>大分県</option>
                      <option value="宮崎県"<?php if($_POST[todou]=="宮崎県"){ echo " selected"; } ?>>宮崎県</option>
                      <option value="鹿児島県"<?php if($_POST[todou]=="鹿児島県"){ echo " selected"; } ?>>鹿児島県</option>
                      <option value="沖縄県"<?php if($_POST[todou]=="沖縄県"){ echo " selected"; } ?>>沖縄県</option>
                    </select></td>
                </tr>
                <tr>
                  <th>住所</th>
                  <td><input name="jyusyo1" type="text" class="text" value="<?php echo $jyusyo1; ?>" size="25" />
                  </td>
                </tr>
                <tr>
                  <th> 建物名・フロア名など </th>
                  <td><input name="jyusyo2" type="text" class="text" value="<?php echo $jyusyo2; ?>" size="25" />
                  </td>
                </tr>
                <tr>
                  <th>備考欄</th>
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
          <h3>販売代理店様情報</h3>
          <div class="formbox">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <th>法人名又は店舗名等</th>
                  <td><?php echo $coname; ?></td>
                </tr>
                <tr>
                  <th>法人名又は店舗名等<br />
                    （ふりがな）</th>
                  <td><?php echo $cokana; ?></td>
                </tr>
                <tr>
                  <th>ご担当者氏名</th>
                  <td><?php echo $name; ?></td>
                </tr>
                <tr>
                  <th>ご担当者氏名<br />
                    （ふりがな）</th>
                  <td><?php echo $kana; ?></td>
                </tr>
                <tr>
                  <th>電話番号</th>
                  <td><?php echo $tel1; ?> - <?php echo $tel2; ?> - <?php echo $tel3; ?></td>
                </tr>
                <tr>
                  <th>E-mail</th>
                  <td><?php echo $_POST[mail]; ?></td>
                </tr>
                <tr>
                  <th>郵便番号</th>
                  <td><?php echo $yubin1; ?> - <?php echo $yubin2; ?></td>
                </tr>
                <tr>
                  <th>都道府県</th>
                  <td><?php echo $todou; ?></td>
                </tr>
                <tr>
                  <th>住所</th>
                  <td><?php echo $jyusyo1; ?> </td>
                </tr>
                <tr>
                  <th> 建物名・フロア名など </th>
                  <td><?php echo $jyusyo2; ?> </td>
                </tr>
                <tr>
                  <th>備考欄</th>
                  <td><?php echo $_POST[ran]; ?></td>
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
