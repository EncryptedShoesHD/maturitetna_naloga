<?php

function prettifySeconds($seconds) {
    $years = intval($seconds / 31536000);
    $seconds = $seconds % 31536000;
    $months = intval($seconds / 2628000);
    $seconds = $seconds % 2628000;
    $weeks = intval($seconds / 604800);
    $seconds = $seconds % 604800;
    $days = intval($seconds / 86400);
    $seconds = $seconds % 86400;
    $hours = intval($seconds / 3600);
    $seconds = $seconds % 3600;
    $minutes = intval($seconds / 60);
    $seconds = $seconds % 60;

    $years = ($years > 0 ?
      ($years == 1 ? "1 leto, " :
      ($years == 2 ? "2 leti, " :
      ($years == 3  || $years == 4 ? $years . " leta, " : $years . " let, ")))
    : "");

    $months = ($months > 0 ?
      ($months == 1 ? "1 mesec, " :
      ($months == 2 ? "2 meseca, " :
      ($months == 3  || $months == 4 ? $months . " mesece, " : $months . " mesecev, ")))
    : "");

    $weeks = ($weeks > 0 ?
      ($weeks == 1 ? "1 teden, " :
      ($weeks == 2 ? "2 tedna, " :
      ($weeks == 3  || $weeks == 4 ? $weeks . " tedne, " : $weeks . " tednov, ")))
    : "");

    $days = ($days > 0 ?
      ($days == 1 ? "1 dan, " :
      ($days == 2 ? "2 dneva, " : $days . " dni, "))
    : "");

    $hours = ($hours > 0 ?
      ($hours == 1 ? "1 ura, " :
      ($hours == 2 ? "2 uri, " :
      ($hours == 3  || $hours == 4 ? $hours . " ure, " : $hours . " ur, ")))
    : "");

    $minutes = ($minutes > 0 ?
      ($minutes == 1 ? "1 minuta, " :
      ($minutes == 2 ? "2 minuti, " :
      ($minutes == 3  || $minutes == 4 ? $minutes . " minute, " : $minutes . " minut, ")))
    : "");

    $seconds = ($seconds > 0 ?
      ($seconds == 1 ? "1 sekunda, " :
      ($seconds == 2 ? "2 sekundi, " :
      ($seconds == 3  || $seconds == 4 ? $seconds . " sekunde, " : $seconds . " sekund, ")))
    : "");

    $izpis = sprintf(
      "%s%s%s%s%s%s%s",
      $years,
      $months,
      $weeks,
      $days,
      $hours,
      $minutes,
      $seconds
    );

    return substr($izpis, 0, -2);
}

?>
