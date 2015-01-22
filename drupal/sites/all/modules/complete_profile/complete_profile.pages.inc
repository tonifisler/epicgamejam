<?php

function complete_profile_form($form, &$form_state, $account) {
  $form['help'] = array(
    '#markup' => '<p>' . t('Fill out the following fields to complete your profile.') . '</p>',
    '#weight' => -100,
  );

  $controllers = profile_complete_get_controllers();
  foreach ($controllers as $controller) {
    $result = $controller::getFieldsForm($account, $form_state);
    $form = drupal_array_merge_deep($form, $result);
  }

  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  //$form['actions']['logoff'] = array(
  //  '#type' => 'link',
  //  '#title' => t('Log out'),
  //  '#href' => 'user/logout',
  //);

  // Track which fields are visible now, so that we can hide any extra fields
  // that are pre-rendered in.
  //$form['#visible_elements'] = array_merge(element_get_visible_children($form), array('form_build_id', 'form_token', 'form_id'));
  //array_unshift($form['#pre_render'], 'complete_profile_hide_fields');

  return $form;
}

function complete_profile_hide_fields($elements) {
  $visible_elements = $elements['#visible_elements'];
  foreach (element_get_visible_children($elements) as $key) {
    if (!in_array($key, $visible_elements)) {
      $elements[$key]['#access'] = FALSE;
    }
  }
  return $elements;
}
