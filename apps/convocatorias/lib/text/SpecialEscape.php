<?php

class SpecialEscape
{
    public function specialEscape($message = '') {
        return preg_replace(
            '/https?:\/\/[^\s<]+[a-z]/i',
            '<a target="_BLANK" href="\0">\0</a>',
            $message);
    }
}
