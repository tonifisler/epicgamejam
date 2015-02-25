<?php
/**
 * @file
 * epicgamejam.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function epicgamejam_user_default_roles() {
  $roles = array();

  // Exported role: administrator.
  $roles['administrator'] = array(
    'name' => 'administrator',
    'weight' => 2,
  );

  // Exported role: jammer.
  $roles['jammer'] = array(
    'name' => 'jammer',
    'weight' => 3,
  );

  return $roles;
}
