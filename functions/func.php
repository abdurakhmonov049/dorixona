<?php

function shortText($text, $maxLength)
{
      if (strlen($text) > $maxLength) {
            return substr($text, 0, $maxLength) . '...'; // Belgilangan uzunlikdan kesib olish
      }
      return $text;
}
?>