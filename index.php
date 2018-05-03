<?php

header('Content-Type: application/json');

require_once 'vendor/autoload.php';
require_once 'template_default.php';
require_once 'test_mail.php';

use Benhawker\Pipedrive\Pipedrive;
/*
$contentEmailText = json_encode($_POST);
$contentEmailText.="trash";
$contentEmailText.=json_encode($_GET);
$contentEmailText.="trash";
$contentEmailText.=json_encode($_REQUEST);
mailTotem("malacma@gmail.com", "Luis", "JSON POST", $contentEmailText);*/

/**
curl -d "first_name=Loius&email_lead=malacma@gmail.com&whats_lead=5548996004929&info_event=tese&first_name=moretto&last_name=Morettovixz&address=majorcosta&zip=88020100&city=floripa&state=sc&country=br&invited_event=1000&type_event=3&duration_event=3&date_event=11-11-2018" -X POST https://www.totemdefotos.com.br/wp-content/micro_service_totem/index.php
curl -d "first_name=Loius&email_lead=malacma@gmail.com&whats_lead=5548996004929&info_event=teste&first_name=moretto&last_name=Morettovixz&address=majorcosta&zip=88020100&city=floripa&state=sc&country=br&invited_event=100&type_event=3&duration_event=3&date_event=11-11-2018" -X POST http://www.totemdefotos.com.br/wp-content/micro_service_totem/index.php
 * 
 *  */

$pipedrive = new Pipedrive('e0566462c9ed9ecfa06c633fccf1871eba3670b6');
//var_dump($pipedrive);
//add user  
$person['name'] = $_POST['first_name'];
$person['email'] = $_POST['email_lead'];
$person['phone'] = $_POST['whats_lead'];
$person['first_name'] = $_POST['first_name'];
$person['last_name'] = $_POST['last_name'];
$person = $pipedrive->persons()->add($person);

//add note to user  
$note['content'] = 'Solicitação de orçamento | Chatbot';
$note['content'] .= "<p>";
$note['content'] .= $_POST['info_event'];
$note['content'] .= "</p>";
$note['person_id'] = $person['data']['id'];

$pipedrive->notes()->add($note);

//add deal to user  
$deal['title'] = 'CHATBOT | ORÇAMENTO';
$deal['stage_id'] = 1;
$deal['person_id'] = $person['data']['id'];
$deal['ad549abc066fe7e37d166ab287bba3a05ec6a90b'] = $_POST['address'] . " " . $_POST['zip'] . " " . $_POST['city'] . " " . $_POST['state'] . " " . $_POST['country'];
; //Endereço
$deal['4f4ae0c0c8c9c2d4009ef7d7b7bcb818404bed78'] = $_POST['invited_event'];
; //Numero de convidados
$deal['566461cd1070bf6b1a889f8be9ae759737f9d2fa'] = 3; //Como conheceu
$deal['c561fdde34ae30d237faeb41fd28849448740b6c'] = intval($_POST['type_event']) + 6; //tipo do evento;
$deal['fee947b450dfd921ca53b22debccf4957d608a9b'] = $_POST['duration_event']; //Hours for event
$deal['3bb67983f980954202061310bf890edfe5c9cc5a'] = $_POST['date_event']; //data do evento
$dealID = $pipedrive->deals()->add($deal);

//$note['deal_id'] = 
$to = $_POST['email_lead'];
$subject = 'Totem de Fotos | Pacotes para eventos';

//If total people invited higher than 300 send another template
$mailContent = ((int) $_POST['invited_event']) > 300 ? $emailContent2 : $emailContent1;
//Mail
mailTotem($to, $_POST['first_name'], $subject, $mailContent);
//mail($to, $subject, $mailContent, $headers);
?>
{
 "messages": [
   {"text": "Nosso muito obrigado!"}
 ]
}