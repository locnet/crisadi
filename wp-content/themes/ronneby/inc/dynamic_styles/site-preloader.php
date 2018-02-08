<?php
$output .= 'body.admin-bar.dfd-custom-padding-html #qLoverlay #qLbar_wrap #qLbar.dfd-preloader-bar-top,';
$output .= 'body.dfd-custom-padding-html #qLoverlay #qLbar_wrap #qLbar.dfd-preloader-bar-top {';
	$output .= 'top: '. ($vars['layout_whitespace_size'] + 32) .'px;';
$output .= '}';
$output .= 'body.dfd-custom-padding-html #qLoverlay #qLbar_wrap #qLbar.dfd-preloader-bar-bottom {';
	$output .= 'bottom: '. $vars['layout_whitespace_size'] .'px; ';
$output .= '}';