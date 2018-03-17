<?php
function encode($var) {
    return htmlentities(htmlspecialchars(nl2br($var)));
}
function decode($var) {
    return htmlspecialchars_decode(html_entity_decode(htmlspecialchars_decode($var)));
}