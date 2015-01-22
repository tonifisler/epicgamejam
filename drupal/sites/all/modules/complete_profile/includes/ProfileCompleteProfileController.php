<?php

class ProfileCompleteProfileController implements CompleteProfileControllerInterface {
  public static function isFieldEmpty($account, $field) {
    if (!isset($account->{$field->name})) {
      return TRUE;
    }

    $value = $account->{$field->name};
    switch ($field->type) {
      case _profile_field_serialize($field->type):
      case 'checkbox':
        return empty($value);
      default;
        return !drupal_strlen(trim($value));
    }
  }

  public static function hasEmptyRequiredFields($account) {
    return (bool) db_query("SELECT 1 FROM {profile_field} f LEFT JOIN {profile_value} v ON f.fid = v.fid WHERE uid = :uid AND f.required = 1 AND f.register = 1 AND (v.value IS NULL OR v.value = '' OR (f.type = 'checkbox' AND v.value = '0'))", array(':uid' => $account->uid))->fetchField();
  }

  public static function getFieldsForm($account, array &$form_state) {
    $form = array();
    $form['#user'] = $account;
    $form['#user_category'] = 'register';

    profile_form_alter($form, $form_state, 'user_register_form');
    // Determine if each profile field should actually be shown or not.
    foreach (_profile_get_fields($form['#user_category'], TRUE) as $profile_field) {
      if (!self::isFieldEmpty($account, $profile_field)) {
        $form[$profile_field->category][$profile_field->name]['#access'] = FALSE;
        $form[$profile_field->category]['#access'] = (bool) element_get_visible_children($form[$profile_field->category]);
      }
    }

    return $form;
  }
}
