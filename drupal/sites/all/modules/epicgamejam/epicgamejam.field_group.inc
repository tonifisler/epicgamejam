<?php
/**
 * @file
 * epicgamejam.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function epicgamejam_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_content|node|game|form';
  $field_group->group_name = 'group_content';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'game';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Content',
    'weight' => '4',
    'children' => array(
      0 => 'body',
      1 => 'title_field',
      2 => 'field_genre',
      3 => 'field_screenshots',
      4 => 'field_links',
      5 => 'field_image',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-content field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_content|node|game|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_epic|node|game|form';
  $field_group->group_name = 'group_epic';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'game';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Epic',
    'weight' => '3',
    'children' => array(
      0 => 'field_badges',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-epic field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_epic|node|game|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_team|node|game|form';
  $field_group->group_name = 'group_team';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'game';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Team',
    'weight' => '5',
    'children' => array(
      0 => 'field_members',
      1 => 'field_country',
      2 => 'field_city',
      3 => 'field_contact_email',
      4 => 'field_team_name',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-team field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_team|node|game|form'] = $field_group;

  return $export;
}
