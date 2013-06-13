<?php

function specialEscape($message) {
    $se = new SpecialEscape();
    return $se->specialEscape($message);
}
