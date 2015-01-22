<?php

class UserCompleteProfileController implements CompleteProfileControllerInterface {

  public static function isFieldEmpty($account, $field_name) {
    if ($field = field_info_field($field_name)) {
      return EntityCompleteProfileController::isFieldEmpty('user', $account, $field);
    }
  }

  public static function hasEmptyRequiredFields($account) {
    return EntityCompleteProfileController::hasEmptyRequiredFields('user', $account);
  }

  /**
   * This is essentially a duplicate of user_profile_form().
   */
  public static function getFieldsForm($account, array &$form_state) {
    form_load_include($form_state, 'inc', 'user', 'user.pages');
    $form = user_profile_form(array(), $form_state, $account);

    // Ensure the user can provide a name, mail, or picture if they haven't
    // already.
    $form['account']['name']['#access'] &= empty($account->name);
    $form['account']['mail']['#access'] = empty($account->mail);
    $form['account']['pass']['#access'] = FALSE;
    $form['account']['current_pass']['#access'] = FALSE;
    $form['account']['status']['#access'] = FALSE;
    $form['account']['roles']['#access'] &= empty($account->roles);
    $form['signature_settings']['#access'] = FALSE;
    $form['picture']['#access'] &= empty($account->picture);

    $instances = field_info_instances('user', 'user');
    foreach ($instances as $field_name => $instance) {
      if (isset($form[$field_name])) {
        if (!empty($instance['required'])) {
          // If the user has already filled out a value for this field, hide it.
          if (!self::isFieldEmpty($account, $field_name)) {
            $form[$field_name]['#access'] = FALSE;
          }
        }
        elseif (empty($instance['user_register_form'])) {
          // Hide any fields not configured to show up on the registration form.
          $form[$field_name]['#access'] = FALSE;
        }
      }
    }

    // Switch the form category manually back to 'register'
    $form['#user_category'] = 'register';

    // Remove action buttons.
    unset($form['actions']);

    return $form;
  }
}
