<?php
if($input->get->lang){
    $lang = $input->get->lang;
    $input->whitelist('lang', $lang);
}
else if($user->lang){ $input->whitelist('lang', $user->lang); }

if($input->get->blog){
    $input->whitelist('blog', $input->get->blog);
}
else if($session->blog){ $blog = $session->blog; }

if($input->get->country){
    $input->whitelist('country', $input->get->country);
    $session->country = $input->get->country;
}
if($input->get->cat){
    $input->whitelist('cat', $input->get->cat);
    $session->cat = $input->get->cat;
}
?>
