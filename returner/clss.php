<?php
date_default_timezone_set('Asia/Yekaterinburg');
class CLoader
{
    private $url = 'http://46.48.48.66/pivzavoz_new/odata/standard.odata/';
    private $url2 = 'https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/';
    private $user_tbl = 'https://pivzavoz.amocrm.ru/private/api/v2/json/accounts/current';
    private $tasks_tbl = 'https://pivzavoz.amocrm.ru/private/api/v2/json/tasks/list';
    private $leads_tbl = 'https://pivzavoz.amocrm.ru/private/api/v2/json/leads/list';
    private $contacts_tbl = 'https://pivzavoz.amocrm.ru/private/api/v2/json/contacts/list';
    private $shop_tbl = 'Catalog_МагазиныКомпании';
    private $shop_tbl_f = 'Catalog_Магазины';
    private $price_tbl = 'InformationRegister_ЦеныНоменклатуры_RecordType/SliceLast()';
    private $acc_tbl = 'Catalog_ГруппыДоступа';
    private $goods_tbl = 'Catalog_Номенклатура';
    private $rules_tbl = 'Catalog_ПравилаЦенообразования';
    public $login_upp = 'Администратор';
    public $login = 'RoznUser';
    public $pass = 'CbvCbvJnrhjqcz';
    public $pass_upp = '911';
    private $login2 = 'Администратор';
    private $pass2 = 'RfptvbhVftdbx007';
    private $dbconnect = array('host' => 'localhost', 'login' => 'u59462', 'pass' => 'Y0dgygYzrt', 'db' => 'u59462_mcrm');
    private $amoconnect = array('USER_LOGIN' => 'kpg@pivzavoz.ru', 'USER_HASH' => 'e35f06460e84c54af86bb1e517ee51b2');
    private $bitrix_hash = '8uau4m37va48ejei';
    private $head = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <![endif]--><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width" initial-scale="1.0" user-scalable="yes"><meta name="format-detection" content="telephone=no"><meta name="format-detection" content="date=no"><meta name="format-detection" content="address=no"><meta name="format-detection" content="email=no"><meta name="robots" content="noindex,nofollow"><title>Презентация и бизнес план</title> <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet" type="text/css"> <!--<![endif]--> <!--[if mso]><style type="text/css">.h1,.h2,.h3,a,p,li,.mlContentContainer,.mlContentContainer .h1,.mlContentContainer .h2,.mlContentContainer .h3,.mlContentContainer a,.mlContentContainer p,.mlContentContainer li,.mlContentContainer p,.mlContentContainer .mlContentRSS{font-family:Arial,Helvetica,sans-serif}</style><![endif]--><link href="https://static1.mailerlite.com/css/fb.css" rel="stylesheet" type="text/css"> <script type="text/javascript" src="https://static1.mailerlite.com/js/jquery.js"></script> <script type="text/javascript" src="https://static1.mailerlite.com/js/jquery.fzoom.js?v2"></script> <script type="text/javascript">var lang="ru";var url="8087537//";var mail_link="http://preview.mailerlite.com/t9v0s9";var mail_title="Презентация и бизнес план";</script> <script type="text/javascript" src="https://static1.mailerlite.com/js/email.js"></script> <style type="text/css">.ReadMsgBody{width:100%}.ExternalClass{width:100%}.ExternalClass *{line-height:100%}.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{line-height:100%}body{margin:0;padding:0}body,table,td,p,a,li{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table td{border-collapse:collapse}table{border-spacing:0;border-collapse:collapse}p,a,li,td,blockquote{mso-line-height-rule:exactly}p,a,li,td,body,table,blockquote{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}img,a img{border:0;outline:none;text-decoration:none}img{-ms-interpolation-mode:bicubic}a[href^=tel],a[href^=sms]{color:inherit;cursor:default;text-decoration:none}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.mlEmailContainer{max-width:640px!important}@media only screen and (min-width:768px){.mlEmailContainer{width:640px!important}}@media only screen and (max-width: 640px){.mlTemplateContainer{padding:10px 10px 0 10px}.mlContentTable{width:100%!important;min-width:200px!important}.mlContentBlock{float:none!important;width:100%!important}.mlContentOuter{padding-bottom:0px!important;padding-left:25px!important;padding-right:25px!important;padding-top:25px!important}.mlBottomContentOuter{padding-bottom:25px !important}.mlLeftRightContentOuter{padding-left:5px!important;padding-right:5px!important}.mlContentContainerOuter{padding-left:0px!important;padding-right:0px!important}.mlContentContainer{padding-left:25px!important;padding-right:25px!important}.mlContentButton a, .mlContentButton span{width:auto!important}.mlContentImage img, .mlContentRSS img{height:auto!important;width:100%!important}.mlContentImage{height:100%!important;width:auto!important}.mlContentLogo img{height:auto!important;width:100%!important}.mlContentContainer h1{font-size:24px!important;line-height:125%!important;margin-bottom:0px!important}.mlContentContainer h2{font-size:18px!important;line-height:125%!important;margin-bottom:0px!important}.mlContentContainer h3{font-size:16px!important;line-height:125%!important;margin-bottom:0px!important}.mlContentContainer p, .mlContentContainer .mlContentRSS{font-size:16px!important;line-height:150%!important}.mobileHide{display:none!important}.alignCenter{height:auto!important;text-align:center!important}.marginBottom{margin-bottom:25px!important}.mlContentHeight{height:auto!important}.mlContentGap{height:25px!important}.mlDisplayInline{display:inline-block!important;float:none!important}body{margin:0px!important;padding:0px!important}body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:none!important}}</style><style type="text/css">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande",tahoma,verdana,arial,sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}.fb_link img{border:none}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_reset .fb_dialog_legacy{overflow:visible}.fb_dialog_advanced{padding:10px;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px}.fb_dialog_content{background:#fff;color:#333}.fb_dialog_close_icon{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{top:5px;left:5px;right:auto}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_loader{background-color:#f6f7f9;border:1px solid #606060;font-size:24px;padding:20px}.fb_dialog_top_left,.fb_dialog_top_right,.fb_dialog_bottom_left,.fb_dialog_bottom_right{height:10px;width:10px;overflow:hidden;position:absolute}.fb_dialog_top_left{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/8YeTNIlTZjm.png) no-repeat 0 0;left:-10px;top:-10px}.fb_dialog_top_right{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/8YeTNIlTZjm.png) no-repeat 0 -10px;right:-10px;top:-10px}.fb_dialog_bottom_left{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/8YeTNIlTZjm.png) no-repeat 0 -20px;bottom:-10px;left:-10px}.fb_dialog_bottom_right{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ye/r/8YeTNIlTZjm.png) no-repeat 0 -30px;right:-10px;bottom:-10px}.fb_dialog_vert_left,.fb_dialog_vert_right,.fb_dialog_horiz_top,.fb_dialog_horiz_bottom{position:absolute;background:#525252;filter:alpha(opacity=70);opacity:.7}.fb_dialog_vert_left,.fb_dialog_vert_right{width:10px;height:100%}.fb_dialog_vert_left{margin-left:-10px}.fb_dialog_vert_right{right:0;margin-right:-10px}.fb_dialog_horiz_top,.fb_dialog_horiz_bottom{width:100%;height:10px}.fb_dialog_horiz_top{margin-top:-10px}.fb_dialog_horiz_bottom{bottom:0;margin-bottom:-10px}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{-webkit-transform:none;height:100%;margin:0;overflow:visible;position:absolute;top:-10000px;left:0;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{width:auto;height:auto;min-height:initial;min-width:initial;background:none}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{color:#fff;display:block;padding-top:20px;clear:both;font-size:18px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .45);position:absolute;bottom:0;left:0;right:0;top:0;width:100%;min-height:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_content .dialog_header{-webkit-box-shadow:white 0 1px 1px -1px inset;background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#738ABA), to(#2C4987));border-bottom:1px solid;border-color:#1d4088;color:#fff;font:14px Helvetica, sans-serif;font-weight:bold;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{-webkit-font-smoothing:subpixel-antialiased;height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#4966A6), color-stop(.5, #355492), to(#2A4887));border:1px solid #29487d;-webkit-background-clip:padding-box;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0, 0, 0, .117188) 0 1px 1px inset, rgba(255, 255, 255, .167969) 0 1px 0;display:inline-block;margin-top:3px;max-width:85px;line-height:18px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{border:none;background:none;color:#fff;font:12px Helvetica, sans-serif;font-weight:bold;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #555;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f6f7f9;border:1px solid #555;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_button{text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-repeat:no-repeat;background-position:50% 50%;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_hide_iframes iframe{position:relative;left:-10000px}.fb_iframe_widget_loader{position:relative;display:inline-block}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}.fb_iframe_widget_loader iframe{min-height:32px;z-index:2;zoom:1}.fb_iframe_widget_loader .FB_Loader{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat;height:32px;width:32px;margin-left:-16px;position:absolute;left:50%;z-index:4}</style></head><body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" dir="ltr" style="padding: 0; margin: 0; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; background: #ECF0F1;" bgcolor="#ECF0F1">';
    public function connect($table, $filter = '', $top = '')
    {
        if ($top) {
            $top = '&$top=' . $top;
        }
        if ($filter) {
            $filter = '&$filter=' . $filter;
        }
        //echo $fil;
        $curl = curl_init();
        $url = $this->url . urlencode($table) . '?$format=json;odata=nometadata' . $top . $filter;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->login . ":" . $this->pass);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }
    public function connect2($link)
    {

        $username = $this->login2;
        $password = $this->pass2;
        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password"),
            ),
        ));
        $result = file_get_contents($link, false, $context);
        //print_r(json_decode($result));
        return json_decode($result);
    }

    public function connect_torg($link, $torg = false)
    {
       
        if (!$torg) {

            $username = $this->login2;
            $password = $this->pass2;
        
        } else {
            
            $username = $this->login;
            $password = $this->pass;
            $link = iconv('utf-8', 'windows-1251', $link);
           
        }
        
        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password"),
            ),
        ));
        $result = file_get_contents($link, false, $context);
     
        return json_decode($result);
    }

    public function connect_upp($link)
    {
        $username = $this->login_upp;
        $password = $this->pass_upp;
        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password"),
            ),
        ));
        $result = file_get_contents($link, false, $context);
        return json_decode($result);
    }

    public function db_connect()
    {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false];
        $this->dbh = new PDO('mysql:host=' . $this->dbconnect['host'] . ';charset=utf8;dbname=' . $this->dbconnect['db'], $this->dbconnect['login'], $this->dbconnect['pass'], $opt);
        $this->dbh->exec("set names utf8");
        if ($this->dbh) {
            // echo 'Подключене с БД установлено';
        }
    }
    public function get_shops()
    {
        $this->shops = [];
        $result = $this->connect2($this->shop_tbl_f);
        foreach ($result->value as $ndx => $stok) {
            $hide = $stok->НеВыгружатьНаСайт ? true : false;
            if (!array_key_exists($stok->Склад_Key, $this->shops) and !$stok->НеВыгружатьНаСайт) {
                $this->shops[$stok->Склад_Key] = [];
                $this->shops[$stok->Склад_Key]['refkey'] = $stok->Склад_Key;
                $this->shops[$stok->Склад_Key]['Description'] = $stok->Description;
                $this->shops[$stok->Склад_Key]['fields']['adress'] = $stok->Адрес;
                $this->shops[$stok->Склад_Key]['fields']['coord0'] = $stok->Долгота;
                $this->shops[$stok->Склад_Key]['fields']['coord1'] = $stok->Широта;
                $this->shops[$stok->Склад_Key]['fields']['city'] = $stok->Город;
                $this->shops[$stok->Склад_Key]['fields']['shedule'] = $stok->ВремяРаботы;
            }
        }
    }
    public function getshops()
    {
        $this->shops = [];
        $filter = "DeletionMark%20eq%20false";
        $result = $this->connect($this->shop_tbl, $filter);
        print_r($result->value);
        foreach ($result->value as $ndx => $shop) {
            if (!array_key_exists($shop->Ref_Key, $this->shops)) {
                $this->shops[$shop->Ref_Key] = [];
            }
            $this->shops[$shop->Ref_Key]['fields'] = [];
            $this->shops[$shop->Ref_Key]['ref-key'] = $shop->Ref_Key;
            $this->shops[$shop->Ref_Key]['login'] = $shop->Code;
            $this->shops[$shop->Ref_Key]['name'] = $shop->Description;
            $this->shops[$shop->Ref_Key]['fields']['adress'] = $shop->Адрес;
            $this->shops[$shop->Ref_Key]['fields']['region'] = $shop->Регион;
            $this->shops[$shop->Ref_Key]['fields']['city'] = $shop->Город;
            $this->shops[$shop->Ref_Key]['fields']['regim'] = $shop->ВремяРаботы;
            $this->shops[$shop->Ref_Key]['fields']['stock_key'] = $shop->Склад_Key;
            $this->shops[$shop->Ref_Key]['fields']['subdivision_key'] = $shop->Подразделение_Key;
            $this->shops[$shop->Ref_Key]['hash'] = md5(json_encode($this->shops[$shop->Ref_Key]));
            $this->shops[$shop->Ref_Key]['pass'] = $this->p_gen(6);
        }
        print_r($this->shops);
    }
    public function siteusers()
    {
        $this->siteusers = array();
        $siteusers = $this->dbh->query('SELECT Ref_Key, hash, name, user_id, fields, login FROM  `mc_users_tbl` ');
        $siteusers = $siteusers->fetchAll(PDO::FETCH_ASSOC);
        foreach ($siteusers as $su) {
            if (!array_key_exists($su['Ref_Key'], $this->siteusers)) {
                $this->siteusers[$su['Ref_Key']] = array();
            }
            $this->siteusers[$su['Ref_Key']]['hash'] = $su['hash'];
            $this->siteusers[$su['Ref_Key']]['name'] = $su['name'];
            $this->siteusers[$su['Ref_Key']]['user_id'] = $su['user_id'];
            $this->siteusers[$su['Ref_Key']]['login'] = $su['login'];
            $this->siteusers[$su['Ref_Key']]['fields'] = $su['fields'];
        }
        //print_r($this->siteusers);
    }
    public function sitetasks()
    {
        $this->sitetasks = array();
        $sitetasks = $this->dbh->query("SELECT Ref_Key, hash, doc_id FROM  `mc_doc_tbl` WHERE `nodeType`= 'article'");
        $sitetasks = $sitetasks->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sitetasks as $su) {
            if (!array_key_exists($su['Ref_Key'], $this->sitetasks)) {
                $this->sitetasks[$su['Ref_Key']] = array();
            }
            $this->sitetasks[$su['Ref_Key']]['hash'] = $su['hash'];
            $this->sitetasks[$su['Ref_Key']]['id'] = $su['doc_id'];
        }
        // print_r($this->sitetasks);
    }
    public function mails()
    {
        $this->mails = array();
        $mails = $this->dbh->query("SELECT Ref_Key, document, fields, doc_id, title FROM  `mc_doc_tbl` WHERE `nodeType`= 'article' AND `parent_id` = 502");
        $mails = $mails->fetchAll(PDO::FETCH_ASSOC);
        foreach ($mails as $su) {
            if (!array_key_exists($su['doc_id'], $this->mails)) {
                $this->mails[$su['doc_id']] = array();
            }
            $this->mails[$su['doc_id']]['title'] = $su['title'];
            $this->mails[$su['doc_id']]['document'] = $su['document'];
            $this->mails[$su['doc_id']]['fields'] = $su['fields'];
            $this->mails[$su['doc_id']]['ref'] = $su['Ref_Key'];
        }
    }
    public function cleargroup($id)
    {
        $mails = $this->apipost('http://api.mailerlite.com/api/v2/groups/' . $id . '/subscribers', '', 'get');
        $answer = [];
        foreach ($mails as $mail) {
            $this->apipost('https://api.mailerlite.com/api/v2/groups/' . $id . '/subscribers/' . $mail->id, '', 'delete');
        }
    }
    public function addmail($adr, $group)
    {
        return $this->apipost('https://api.mailerlite.com/api/v2/groups/' . $group . '/subscribers', ['email' => $adr]);
    }
    public function delcamp($camp)
    {
        return $this->apipost('https://api.mailerlite.com/api/v2/campaigns/' . $camp, '', 'delete');
    }
    public function makecamp($params)
    {
        return $this->apipost('https://api.mailerlite.com/api/v2/campaigns', $params, 'post');
    }
    public function send($camp_ref)
    {
        return $this->apipost('http://api.mailerlite.com/api/v2/campaigns/' . $camp_ref . '/actions/send');
    }
    public function setsign($doc_id, $user_ref, $name)
    {
        $sign = $this->makesign($user_ref);
        $html = explode('{{sign}}', $this->mails[$doc_id]['document']);
        $html = $this->head . $html[0] . $sign . $html[1] . '</body></html>';
        $html = str_replace("{{name}}", $name, $html);
        return $html;
        // $plain='Your email client does not support HTML emails. Open newsletter here: {$url}. If you do not want to receive emails from us, click here: {$unsubscribe}';
        // $contentData = ['html'=>$html,'plain'=>$plain];
        // return $this->apipost('http://api.mailerlite.com/api/v2/campaigns/'.$camp.'/content',$contentData,'put');
    }
    public function makesign($user_ref)
    {
        $user_id = $this->siteusers[$user_ref]['user_id'];
        $fields = unserialize($this->siteusers[$user_ref]['fields']);
        if (file_exists('../images/user/' . $user_id . '/Image/title.png')) {$face = 'http://mcrm.pivzavoz24.ru/images/user/' . $user_id . '/Image/title.png';}
        if (file_exists('../images/user/' . $user_id . '/Image/title.jpg')) {$face = 'http://mcrm.pivzavoz24.ru/images/user/' . $user_id . '/Image/title.jpg';}
        $phone = $fields['phone'];
        $post = $fields['person']['post'];
        $name = $this->siteusers[$user_ref]['name'];
        $mail = $this->siteusers[$user_ref]['login'];
        return '<table align="center" border="0" bgcolor="#fafafa" class="mlContentTable" cellspacing="0" cellpadding="0" style="background: #fafafa; min-width: 640px; width: 640px;" width="640" id="ml-block-54148677"> <tbody><tr> <td> <table width="640" class="mlContentTable" bgcolor="#fafafa" cellspacing="0" cellpadding="0" border="0" align="center" style="background: #fafafa; width: 640px;"> <tbody><tr> <td class="mlContentContainer" style="padding: 15px 50px 10px 50px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td><table align="left" border="0" cellpadding="0" cellspacing="0" width="100" class="mlContentBlock marginBottom"> <tbody><tr> <td align="center" height="100"> <img border="0" class="mlDisplayInline" src="' . $face . '" width="100" height="100" alt="" style="display: block;border-radius: 50px;"></td></tr></tbody></table> <table align="left" border="0" cellpadding="0" cellspacing="0" width="20" class="mobileHide"><tbody><tr><td height="100" class="h20"></td></tr></tbody></table> <table align="left" border="0" cellpadding="0" cellspacing="0" width="420" class="mlContentBlock"><tbody><tr><td height="100" valign="middle" class="mlContentHeight"> <table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="left" class="alignCenter" style="font-family: Open Sans, Sans-Serif; font-size: 15px; line-height: 20px; color: #464646;"><span>Ваш менеджер,</span> </td></tr><tr> <td align="left" class="alignCenter" style="font-family: Open Sans, Sans-Serif; font-size: 15px; line-height: 20px; color: #464646;"> <span style="font-weight: bold;">' . $name . '</span><span>, ' . $post . '</span> </td></tr><tr> <td align="left" class="alignCenter"> <table align="left" border="0" cellpadding="0" cellspacing="0" class="mlDisplayInline"> <tbody><tr> <td style="padding-right: 10px;" width="15"><img src="http://mcrm.pivzavoz24.ru/design/email.png" width="15" style="display: block;"> </td><td style="font-family: Open Sans, Sans-Serif; font-size: 15px; line-height: 20px; color: #464646;"> <a style="color: #000000; text-decoration: none;" href="mailto:' . $mail . '">' . $mail . '</a> </td><td width="10"></td></tr></tbody></table> <table align="left" border="0" cellpadding="0" cellspacing="0" class="mlDisplayInline"> <tbody><tr> <td style="padding-right: 10px;" width="15"><img src="http://mcrm.pivzavoz24.ru/design/tel.png" width="15" style="display: block;"> </td><td style="font-family: Open Sans,Sans-Serif;font-size:15px;line-height:20px;color:#464646;"><a style="color:#464646;text-decoration:none;" href="tel:' . $phone . '">' . $phone . '</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
    }
    public function sitegoods()
    {
        $this->sitegoods = array();
        $sitegoods = $this->dbh->query("SELECT Ref_Key, hash, doc_id FROM  `wr_doc_tbl` WHERE `nodeType`= 'article'");
        $sitegoods = $sitegoods->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sitegoods as $su) {
            if (!array_key_exists($su['Ref_Key'], $this->sitegoods)) {
                $this->sitegoods[$su['Ref_Key']] = array();
            }
            $this->sitegoods[$su['Ref_Key']]['hash'] = $su['hash'];
            $this->sitegoods[$su['Ref_Key']]['id'] = $su['doc_id'];
        }
        //print_r($this->sitegoods);
    }
    public function siteprices()
    {
        $this->siteprices = array();
        $siteprices = $this->dbh->query("SELECT good_key, pricetype_key, hash FROM  `wr_prices_tbl`");
        $siteprices = $siteprices->fetchAll(PDO::FETCH_ASSOC);
        foreach ($siteprices as $su) {
            if (!array_key_exists($su['good_key'] . $su['pricetype_key'], $this->siteprices)) {
                $this->siteprices[$su['good_key'] . $su['pricetype_key']] = [];
            }
            $this->siteprices[$su['good_key'] . $su['pricetype_key']] = $su['hash'];
        }
        print_r($this->siteprices);
    }
    public function users_sync()
    {
        foreach ($this->users as $ref => $user) {
            if (!array_key_exists($ref, $this->siteusers)) {
                $this->adduser($user);
                echo "На добавление: " . $user['name'] . " (" . $ref . ")<br>";
            }
            if (array_key_exists($ref, $this->siteusers) and $this->siteusers[$ref]['hash'] != $user['hash']) {
                $this->updateuser($user);
                echo "На обновление: " . $user['name'] . " (" . $ref . ")<br>";
            }
        }
    }
    public function tasks_sync()
    {
        foreach ($this->tasks as $ref => $dir) {
            if (!array_key_exists($ref, $this->sitetasks)) {
                $this->addtask($dir);
                echo "На добавление: " . $dir['title'] . " (" . $ref . ")/n";
            }
            if (array_key_exists($ref, $this->sitetasks) and $this->sitetasks[$ref]['hash'] != $dir['hash']) {
                $this->updatetask($dir);
                echo "На обновление: " . $dir['title'] . " (" . $ref . ")/n";
            }
        }
        unset($this->sitecats);
    }
    public function price_sync()
    {
        foreach ($this->prices as $ndx => $price) {
            if (!array_key_exists($price['good_key'] . $price['pricetype_key'], $this->siteprices)) {
                $this->addprice($price);
            }
            if (array_key_exists($price['good_key'] . $price['pricetype_key'], $this->siteprices) and $this->siteprices[$price['good_key'] . $price['pricetype_key']] != $price['hash']) {
                $this->updateprice($price);
            }
        }
        unset($this->prices);
        unset($this->siteprices);
    }
    public function goods_sync()
    {
        foreach ($this->goods as $ref => $good) {
            if (!array_key_exists($ref, $this->sitegoods)) {
                $this->addgood($good);
            }
            if (array_key_exists($ref, $this->sitegoods) and $this->sitegoods[$ref]['hash'] != $good['hash']) {
                $this->updategood($good);
            }
        }
        unset($this->goods);
        unset($this->sitegoods);
    }
    public function updateuser($row)
    {
        $query = "UPDATE `mc_users_tbl`
        SET `name`= :name
        , `login`= :login
        , `group`= :group
        , `passw`= :passw
        , `fields`= :fields
        , `lastUpdate`= CURRENT_TIMESTAMP
        , `hash`= :hash
        WHERE `Ref_Key`= :Ref_Key";
        $add = $this->dbh->prepare($query);
        $add->bindParam(':Ref_Key', $row['ref-key']);
        $add->bindParam(':name', $row['name']);
        $add->bindParam(':login', $row['login']);
        $add->bindParam(':group', $row['group']);
        $add->bindParam(':passw', $row['pass']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function adduser($row)
    {
        $add = $this->dbh->prepare('INSERT INTO `mc_users_tbl` (Ref_Key, name, login, `group`, passw, fields, dateCreate, hash) VALUES (:Ref_Key ,:name ,:login, :group ,:passw, :fields ,CURRENT_TIMESTAMP,:hash)');
        $add->bindParam(':Ref_Key', $row['ref-key']);
        $add->bindParam(':name', $row['name']);
        $add->bindParam(':login', $row['login']);
        $add->bindParam(':group', $row['group']);
        $add->bindParam(':passw', $row['pass']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function addprice($row)
    {
        $add = $this->dbh->prepare('INSERT INTO `wr_prices_tbl` (id, price, good_key , pricetype_key, fields, dateCreate, period, hash) VALUES (:id ,:price ,:good_key, :pricetype_key, :fields, CURRENT_TIMESTAMP, :period ,:hash)');
        $add->bindParam(':id', $row['id']);
        $add->bindParam(':price', $row['price']);
        $add->bindParam(':good_key', $row['good_key']);
        $add->bindParam(':pricetype_key', $row['pricetype_key']);
        $add->bindParam(':period', $row['period']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function addtask($row)
    {
        $add = $this->dbh->prepare("INSERT INTO `mc_doc_tbl` (Ref_Key, user_id, parent_id, nodeType, template, autor, datePublish, lastUpdate, title, fields, note, hash)
                VALUES (:Ref_Key, :user, 1, 'article', 'task', :autor, :datePublish, :last_modified, :title, :fields, :note, :hash)");
        $add->bindParam(':Ref_Key', $row['ref-key']);
        $add->bindParam(':user', $row['created_user_id']);
        $add->bindParam(':title', $row['title']);
        $add->bindParam(':note', $row['note']);
        $add->bindParam(':datePublish', $row['date_create']);
        $add->bindParam(':autor', $row['autor']);
        $add->bindParam(':last_modified', $row['last_modified']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function updatetask($row)
    {
        $query = "UPDATE `mc_doc_tbl`
        SET `parent_id`= 1
        , `user_id`= :user
        , `title`= :title
        , `note`= :note
        , `autor`= :autor
        , `fields`= :fields
        , `nodeType`= 'article'
        , `template`= 'task'
        , `lastUpdate`= :last_modified
        , `hash`= :hash
        WHERE `Ref_Key`= :Ref_Key";
        $add = $this->dbh->prepare($query);
        $add->bindParam(':Ref_Key', $row['ref-key']);
        $add->bindParam(':user', $row['created_user_id']);
        $add->bindParam(':title', $row['title']);
        $add->bindParam(':note', $row['note']);
        $add->bindParam(':autor', $row['autor']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':last_modified', $row['last_modified']);
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function updateprice($row)
    {
        $query = "UPDATE `wr_prices_tbl`
        SET `price`= :price
        , `period`= :period
        , `fields`= :fields
        , `lastUpdate`= CURRENT_TIMESTAMP
        , `hash`= :hash
        WHERE `good_key`= :good_key AND `pricetype_key`= :pricetype_key";
        $add = $this->dbh->prepare($query);
        $add->bindParam(':good_key', $row['good_key']);
        $add->bindParam(':pricetype_key', $row['pricetype_key']);
        $add->bindParam(':price', $row['price']);
        $add->bindParam(':period', $row['period']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
    public function addgood($row)
    {
        $add = $this->dbh->prepare("INSERT INTO `wr_doc_tbl` (Ref_Key, parent_id, user_id, nodeType, template, fields, datePublish, title, hash)
                VALUES (:Ref_Key ,:pid ,1, 'article', 'product', :fields, CURRENT_TIMESTAMP, :name, :hash)");
        $add->bindParam(':Ref_Key', $row['ref-key']);
        $add->bindParam(':name', $row['name']);
        $add->bindParam(':pid', $row['parent_id']);
        $add->bindParam(':fields', serialize($row['fields']));
        $add->bindParam(':hash', $row['hash']);
        $add->execute();
    }
//    function updateuser($ref,$row){
    //
    //    }
    public function getrules()
    {
        $this->rules = array();
        $result = $this->connect($this->rules_tbl);
        foreach ($result->value as $ndx => $rule) {
            if (!array_key_exists($rule->Ref_Key, $this->rules)) {
                $this->rules[$rule->Ref_Key] = $rule->ВидЦен_Key;
            }
        }
        //print_r($this->rules);
    }
    public function getprice()
    {
        $this->prices = [];
        $result = $this->connect($this->price_tbl);
        foreach ($result->value as $ndx => $price) {
            if (in_array($price->ВидЦены_Key, $this->pricetypes)) {
                if (!array_key_exists($ndx, $this->prices)) {
                    $this->prices[$ndx] = [];
                }
                $this->prices[$ndx]['fields'] = [];
                $this->prices[$ndx]['price'] = $price->Цена;
                $this->prices[$ndx]['pricetype_key'] = $price->ВидЦены_Key;
                $this->prices[$ndx]['good_key'] = $price->Номенклатура_Key;
                $this->prices[$ndx]['period'] = $price->Period;
                $this->prices[$ndx]['fields']['char_key'] = $price->Характеристика_Key;
                $this->prices[$ndx]['fields']['box_key'] = $price->Упаковка_Key;
                $this->prices[$ndx]['fields']['currency'] = $price->Валюта;
                $this->prices[$ndx]['hash'] = md5(json_encode($this->prices[$ndx]));
                //unset($result->value[$ndx]);
            }
        }
        // echo count($this->prices);
        // print_r($this->prices[102385]);
    }
    public function getusers()
    {
        $users = array();
        $groups = array();
        $result = $this->apiamo($this->user_tbl, '', '');
        $result = $result->response->account;
        foreach ($result->groups as $ndx => $group) {
            if (!array_key_exists($group->id, $groups)) {
                $groups[$group->id] = $group->name;
            }
        }
        foreach ($result->users as $ndx => $u) {
            if (!array_key_exists($u->id, $users)) {
                $users[$u->id] = array();
            }
            $users[$u->id]['name'] = $u->name;
            $users[$u->id]['login'] = $u->login;
            $users[$u->id]['ref-key'] = $u->id;
            $users[$u->id]['fields'] = array();
            $users[$u->id]['fields']['phone'] = $u->phone_number;
            if ($u->photo_url) {
                $users[$u->id]['fields']['photo'] = $u->photo_url;
            }
            $users[$u->id]['fields']['email'] = $u->login;
            $users[$u->id]['group'] = $groups[$u->group_id];
            $users[$u->id]['hash'] = md5(json_encode($users[$u->id]));
            $users[$u->id]['pass'] = $this->p_gen(6);
        }
        echo count($users);
        $this->users = $users;
        print_r($this->users);
        print_r($groups);
    }
    public function gettasks()
    {
        $tasks = [];
        $status = [0 => 'Не выполнено', 1 => 'Выполнено'];
        $elem = [1 => 'Контакт', 2 => 'Сделка'];
        $headers = ['if-modified-since' => 'Sat, 01 Jul 2017 00:00:00'];
        $result = $this->apiamo($this->tasks_tbl, $headers, '');
        foreach ($result->response->tasks as $ndx => $task) {
            if (!array_key_exists($task->id, $tasks)) {
                $tasks[$task->id] = [];
            }
            $tasks[$task->id]['ref-key'] = $task->id;
            $tasks[$task->id]['title'] = "Задача #" . $task->id;
            $tasks[$task->id]['note'] = $task->text;
            $tasks[$task->id]['date_create'] = date('Y-m-d H:i:s', $task->date_create);
            $tasks[$task->id]['last_modified'] = date('Y-m-d H:i:s', $task->last_modified);
            if ($task->created_user_id and $task->created_user_id != 0) {
                $tasks[$task->id]['created_user_id'] = $this->siteusers[$task->created_user_id]['user_id'];
            } else {
                $tasks[$task->id]['created_user_id'] = $this->siteusers[$task->responsible_user_id]['user_id'];
            }
            $tasks[$task->id]['fields'] = [];
            $tasks[$task->id]['fields']['status'] = $status[$task->status];
            $tasks[$task->id]['fields']['propsdoc']['p0'][] = $status[$task->status];
            $tasks[$task->id]['fields']['propsdoc']['p1'][] = $task->task_type;
            $tasks[$task->id]['fields']['propsdoc']['p2'][] = $this->siteusers[$task->responsible_user_id]['name'];
            $tasks[$task->id]['fields']['propsdoc']['p3'][] = $this->siteusers[$task->created_user_id]['name'];
            $tasks[$task->id]['fields']['type'] = $task->task_type;
            $tasks[$task->id]['fields']['complete_till'] = date('Y-m-d H:i:s', $task->complete_till);
            $tasks[$task->id]['fields']['responsible'] = $this->siteusers[$task->responsible_user_id]['user_id'];
            $tasks[$task->id]['autor'] = $this->siteusers[$task->responsible_user_id]['user_id'];
            $tasks[$task->id]['fields']['linked']['type'] = $elem[$task->element_type];
            $tasks[$task->id]['fields']['linked']['id'] = $task->element_id;
            // if($task->element_type=='1'){
            // $params=array('id'=>$task->element_id);
            // $result2 =$this->apiamo($this->contacts_tbl.'?'.http_build_query($params),'','');
            //$tasks[$task->id]['fields']['linked']=$result2->response->contacts;
            // }
            // else if($task->element_type=='2'){
            // $params=array('id'=>$task->element_id);
            // $result2 =$this->apiamo($this->leads_tbl.'?'.http_build_query($params),'','');
            //$tasks[$task->id]['fields']['linked']=$result2->response->leads;
            // }
            $tasks[$task->id]['hash'] = md5(json_encode($tasks[$task->id]));
        }
        $this->tasks = $tasks;
    }
    public function getleads()
    {
        $leads = [];
        $contacts = [];
        $result = $this->apiamo($this->contacts_tbl, '', '');
        foreach ($result->response->contacts as $ndx => $contact) {
            if (!array_key_exists($contact->id, $contacts)) {
                $contacts[$contact->id] = [];
            }
            $contacts[$contact->id]['ref-key'] = $contact->id;
            $contacts[$contact->id]['title'] = $contact->company_name;
            $contacts[$contact->id]['date_create'] = date('Y-m-d H:i:s', $contact->date_create);
            $contacts[$contact->id]['last_modified'] = date('Y-m-d H:i:s', $contact->last_modified);
            $contacts[$contact->id]['created_user_id'] = $this->siteusers[$contact->created_user_id]['name'];
            $contacts[$contact->id]['fields'] = [];
            $contacts[$contact->id]['fields']['type'] = $contact->type;
            $contacts[$contact->id]['fields']['tags'] = $contact->tags;
            $contacts[$contact->id]['fields']['custom'] = $contact->custom_fields;
        }
        $this->contacts = $contacts;
        $result = $this->apiamo($this->leads_tbl, '', '');
        foreach ($result->response->leads as $ndx => $lead) {
            if (!array_key_exists($lead->id, $leads)) {
                $leads[$lead->id] = [];
            }
            $leads[$lead->id]['ref-key'] = $lead->id;
            $leads[$lead->id]['title'] = $lead->name;
            $leads[$lead->id]['date_create'] = date('Y-m-d H:i:s', $lead->date_create);
            $leads[$lead->id]['last_modified'] = date('Y-m-d H:i:s', $lead->last_modified);
            if ($lead->created_user_id and $lead->created_user_id != 0) {
                $leads[$lead->id]['created_user_id'] = $this->siteusers[$lead->created_user_id]['name'];
            } else {
                $leads[$lead->id]['created_user_id'] = $this->siteusers[$lead->responsible_user_id]['name'];
            }
            $leads[$lead->id]['fields'] = [];
            $leads[$lead->id]['fields']['price'] = $lead->price;
            $leads[$lead->id]['fields']['responsible'] = $this->siteusers[$lead->responsible_user_id]['name'];
            //if($this->contacts[$lead->main_contact_id]){
            $leads[$lead->id]['fields']['linkedcontact']['name'] = $this->contacts[$lead->main_contact_id]['title'];
            //}
            //$leads[$lead->id]['fields']['linkedcontact']['name']=$this->contacts[$lead->main_contact_id]['title'];
            //print_r($this->contacts[$lead->main_contact_id]['fields']['custom']);
            foreach ($this->contacts[$lead->main_contact_id]['fields']['custom'] as $ndx => $cont) {
                if ($cont->name == 'Телефон') {
                    foreach ($cont->values as $val) {
                        $leads[$lead->id]['fields']['linkedcontact']['phone'] = $val->value;
                    }
                }
                if ($cont->name == 'Email') {
                    foreach ($cont->values as $val) {
                        $leads[$lead->id]['fields']['linkedcontact']['email'] = $val->value;
                    }
                }
            }
        }
        $this->leads = $leads;
        print_r($this->leads);
    }
    public function getgoods()
    {
        $this->goods = array();
        $filter = "IsFolder%20eq%20%27false%27%20and%20DeletionMark%20ne%20true%20and%20ТипНоменклатуры%20eq%20%27Товар%27"; //Для товаров
        $result = $this->connect($this->goods_tbl, $filter);
        echo count($result->value) . "\n";
        foreach ($result->value as $ndx => $cat) {
            if (array_key_exists($cat->Parent_Key, $this->cats)) {
                if (!array_key_exists($cat->Ref_Key, $this->goods)) {
                    $this->goods[$cat->Ref_Key] = array();
                }
                $this->goods[$cat->Ref_Key]['name'] = $cat->НаименованиеПолное;
                $this->goods[$cat->Ref_Key]['desc'] = $cat->Описание;
                $this->goods[$cat->Ref_Key]['ref-key'] = $cat->Ref_Key;
                $this->goods[$cat->Ref_Key]['parent_key'] = $cat->Parent_Key;
                $this->goods[$cat->Ref_Key]['parent_id'] = $this->sitecats[$cat->Parent_Key]['id'];
                $this->goods[$cat->Ref_Key]['fields'] = [];
                $this->goods[$cat->Ref_Key]['fields']['alco'] = $cat->АлкогольнаяПродукция;
                $this->goods[$cat->Ref_Key]['fields']['vol'] = $cat->Крепость;
                $this->goods[$cat->Ref_Key]['fields']['article'] = $cat->Артикул;
                $this->goods[$cat->Ref_Key]['fields']['manu_key'] = $cat->Производитель_Key;
                $this->goods[$cat->Ref_Key]['fields']['code'] = $cat->Code;
                $this->goods[$cat->Ref_Key]['hash'] = md5(json_encode($this->goods[$cat->Ref_Key]));
            }
        }
        unset($result);
    }
    public function apiamo($link, $headers, $params)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        if ($params) {
            print_r($params);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        if ($headers) {
            foreach ($headers as $header => $val) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array($header . ':' . $val));
            }

        }
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        //print_r( json_decode($result) );
        return (json_decode($result));
    }
    public function amoauth()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, 'https://pivzavoz.amocrm.ru/private/api/auth.php?type=json');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->amoconnect));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        // print_r (json_decode($result));
        return (json_decode($result));
    }
    public function apipost($link, $params = array(), $method = 'post')
    {
        $params['apiKey'] = 'cd10adb89894e414266771948a553960';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if ($method == 'delete') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_URL, $link);
            //curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-MailerLite-ApiKey: cd10adb89894e414266771948a553960',
            ));
        }
        if ($method == 'put') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-MailerLite-ApiKey: cd10adb89894e414266771948a553960',
            ));
        }
        if ($method == 'get') {
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-MailerLite-ApiKey: cd10adb89894e414266771948a553960',
            ));
        }
        if ($method == 'post') {
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-MailerLite-ApiKey: cd10adb89894e414266771948a553960',
            ));
        }
        $result = curl_exec($curl);
        curl_close($curl);
        //print_r(json_decode($result));
        return (json_decode($result));
    }
    public function p_gen($len)
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $len);
    }
    public function translit($string)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
    public function getbtasks($method, $params)
    {
        $link = 'https://pivzavoz.bitrix24.ru/rest/3590/';
        $link .= $this->bitrix_hash . "/";
        $link .= $method . "?";
        $link .= http_build_query($params);
        $appRequestUrl = 'https://pivzavoz.bitrix24.ru/rest/1832/8uau4m37va48ejei/' . $method . '?' . http_build_query($params);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $appRequestUrl);
        $result = curl_exec($curl);
        curl_close($curl);

        return (json_decode($result));
    }
    public function getbtasks2($method, $params)
    {
        $link = 'https://pivzavoz.bitrix24.ru/rest/3590/';
        $link .= $this->bitrix_hash . "/";
        $link .= $method . "?";
        $link .= http_build_query($params);
        $appRequestUrl = 'https://pivzavoz.bitrix24.ru/rest/3714/nqbt21tuhak285jf/' . $method;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $appRequestUrl);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($curl);
        curl_close($curl);
        return (json_decode($result));
    }
    public function writeToLog($data, $title = '')
    {
        $log = "\n------------------------\n\r";
        $log .= date("Y.m.d G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n\r";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n\r";
        file_put_contents(getcwd() . '/hook1.txt', $log, FILE_APPEND);
        return true;
    }
}
