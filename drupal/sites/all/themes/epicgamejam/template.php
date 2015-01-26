<?php

/**
 * @file
 * template.php
 */

/**
 * template_preprocess_node
 */
function epicgamejam_preprocess_node(&$variables) {

  // add theme sugestion for node--type--display-mode.tpl
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];

}