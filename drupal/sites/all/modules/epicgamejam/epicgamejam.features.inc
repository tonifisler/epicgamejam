<?php
/**
 * @file
 * epicgamejam.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function epicgamejam_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "captcha" && $api == "captcha") {
    return array("version" => "1");
  }
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
  if ($module == "taxonomy_display" && $api == "taxonomy_display") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function epicgamejam_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function epicgamejam_image_default_styles() {
  $styles = array();

  // Exported image style: badge_thumbnail.
  $styles['badge_thumbnail'] = array(
    'label' => 'Badge Thumbnail (150x150)',
    'effects' => array(
      6 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 150,
          'height' => 150,
        ),
        'weight' => -9,
      ),
    ),
  );

  // Exported image style: reddit.
  $styles['reddit'] = array(
    'label' => 'reddit (1200x150)',
    'effects' => array(
      7 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 1200,
          'height' => 150,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: teaser.
  $styles['teaser'] = array(
    'label' => 'Teaser image (350x100)',
    'effects' => array(
      3 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 350,
          'height' => 100,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_default_mailchimp_activity_entity().
 */
function epicgamejam_default_mailchimp_activity_entity() {
  $items = array();
  $items['user_emails'] = entity_import('mailchimp_activity_entity', '{
    "name" : "user_emails",
    "label" : "User Emails",
    "entity_type" : "user",
    "bundle" : "user",
    "email_property" : "mail",
    "entity_path" : "user\\/",
    "enabled" : "1",
    "locked" : "0",
    "rdf_mapping" : []
  }');
  return $items;
}

/**
 * Implements hook_node_info().
 */
function epicgamejam_node_info() {
  $items = array(
    'game' => array(
      'name' => t('Game'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'page' => array(
      'name' => t('Basic page'),
      'base' => 'node_content',
      'description' => t('Use <em>basic pages</em> for your static content, such as an \'About us\' page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'webform' => array(
      'name' => t('Webform'),
      'base' => 'node_content',
      'description' => t('Create a new form or questionnaire accessible to users. Submission results and statistics are recorded and accessible to privileged users.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
