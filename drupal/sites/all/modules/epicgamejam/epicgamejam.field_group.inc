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
  $field_group->parent_name = 'group_group';
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
    'format_type' => 'bootstrap_fieldgroup_nav_item',
    'format_settings' => array(
      'label' => 'Content',
      'instance_settings' => array(
        'required_fields' => 0,
        'classes' => '',
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
  $field_group->parent_name = 'group_group';
  $field_group->data = array(
    'label' => 'Epic',
    'weight' => '3',
    'children' => array(
      0 => 'field_badges',
      1 => 'field_epic_points',
    ),
    'format_type' => 'bootstrap_fieldgroup_nav_item',
    'format_settings' => array(
      'label' => 'Epic',
      'instance_settings' => array(
        'required_fields' => 0,
        'classes' => '',
      ),
    ),
  );
  $export['group_epic|node|game|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_group|node|game|form';
  $field_group->group_name = 'group_group';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'game';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Groupe',
    'weight' => '2',
    'children' => array(
      0 => 'group_content',
      1 => 'group_team',
      2 => 'group_epic',
    ),
    'format_type' => 'bootstrap_fieldgroup_nav',
    'format_settings' => array(
      'label' => 'Groupe',
      'instance_settings' => array(
        'bootstrap_nav_type' => 'pills',
        'bootstrap_stacked' => '0',
        'bootstrap_orientation' => '0',
        'required_fields' => 1,
        'classes' => '',
      ),
    ),
  );
  $export['group_group|node|game|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_team|node|game|form';
  $field_group->group_name = 'group_team';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'game';
  $field_group->mode = 'form';
  $field_group->parent_name = 'group_group';
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
    'format_type' => 'bootstrap_fieldgroup_nav_item',
    'format_settings' => array(
      'label' => 'Team',
      'instance_settings' => array(
        'required_fields' => 0,
        'classes' => '',
      ),
    ),
  );
  $export['group_team|node|game|form'] = $field_group;

  return $export;
}
