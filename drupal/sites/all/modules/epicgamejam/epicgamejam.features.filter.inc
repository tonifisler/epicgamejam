<?php
/**
 * @file
 * epicgamejam.features.filter.inc
 */

/**
 * Implements hook_filter_default_formats().
 */
function epicgamejam_filter_default_formats() {
  $formats = array();

  // Exported format: HTML.
  $formats['full_html_custom'] = array(
    'format' => 'full_html_custom',
    'name' => 'HTML',
    'cache' => 1,
    'status' => 1,
    'weight' => 0,
    'filters' => array(
      'filter_htmlcorrector' => array(
        'weight' => 10,
        'status' => 1,
        'settings' => array(),
      ),
    ),
  );

  // Exported format: Normal.
  $formats['plain_text'] = array(
    'format' => 'plain_text',
    'name' => 'Normal',
    'cache' => 1,
    'status' => 1,
    'weight' => 10,
    'filters' => array(
      'filter_url' => array(
        'weight' => 1,
        'status' => 1,
        'settings' => array(
          'filter_url_length' => 72,
        ),
      ),
      'filter_autop' => array(
        'weight' => 2,
        'status' => 1,
        'settings' => array(),
      ),
      'filter_htmlcorrector' => array(
        'weight' => 10,
        'status' => 1,
        'settings' => array(),
      ),
    ),
  );

  return $formats;
}
