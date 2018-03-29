<?php
function encode($var) {
    return nl2br($var);
}
function decode($var) {
    return htmlspecialchars_decode($var);
}