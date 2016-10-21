<?php
$observers = array(
    array(
        'eventname'   => '\mod_url\event\course_module_viewed',
        'callback'    => 'mod_mnettransparent_mnettransparent::mnettransparent',
    )
);