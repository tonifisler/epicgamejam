<?php
/**
 * @file
 * Views definitions for epictitle module.
 */

/**
 * Implements hook_views_data().
 */
function epictitle_views_data() {
  $data = array();
  $data['node']['handlername'] = array(
    'title' => t('Title Length'),
    'help' => t('Sort by number of characters in field.'),
    'field' => array(
      'handler' => 'epictitle_handler_handlername',
    ),
  );
  return $data;
}
