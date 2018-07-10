<?php

$keywords = implode(':', explode(':', 'isim:goster:@user_id'));
if (strpos($keywords, '@')) {
    $user_id = explode(':@', $keywords)[1];
    $keywords = stristr($keywords, ':@', true);
}

print_r($keywords);


