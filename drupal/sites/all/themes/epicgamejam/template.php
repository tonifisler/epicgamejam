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

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function epicgamejam_menu_tree__secondary(&$variables) {
  return '<ul class="menu nav navbar-nav navbar-right">' . $variables['tree'] . '</ul>';
}

function epicgamejam_menu_link(&$variables) {
    $element = $variables['element'];
    $sub_menu = '';

    if ($element['#below']) {
      // Prevent dropdown functions from being added to management menu so it
      // does not affect the navbar module.
      if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
        $sub_menu = drupal_render($element['#below']);
      }
      elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
        // Add our own wrapper.
        unset($element['#below']['#theme_wrappers']);
        $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
        // Generate as standard dropdown.
        $element['#title'] .= ' <span class="caret"></span>';
        $element['#attributes']['class'][] = 'dropdown';
        $element['#localized_options']['html'] = TRUE;

        // Set dropdown trigger element to # to prevent inadvertant page loading
        // when a submenu link is clicked.
        $element['#localized_options']['attributes']['data-target'] = '#';
        $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
      }
    }
    // On primary navigation menu, class 'active' is not set on active menu item.
    // @see https://drupal.org/node/1896674
    if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
      $element['#attributes']['class'][] = 'active';
    }

    if (array_key_exists('class',$element['#attributes'])
      && is_array($element['#attributes']['class'])
      && in_array('active-trail',$element['#attributes']['class'])) {
        $element['#attributes']['class'][] = 'active';
    }

    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }

function epicgamejam_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id) {
    case 'epic_theme_node_form':
      $form['actions']['submit']['#submit'][] = '_theme_redirect';
      break;
    case 'game_node_form':
      $form['body']['format']['#access'] = FALSE;
      break;
  }
}

function _theme_redirect($form, &$form_state) {
  // reset callback message
  $messages = drupal_get_messages('status');
  drupal_set_message(t('Epic!'));
  // redirect on page to add new theme
  $form_state['redirect'] = 'epic-themer';
}

/*
 * Implements hook_theme().
 */
function epicgamejam_theme($existing, $type, $theme, $path) {
  $items['game_node_form'] = array(
          'render element' => 'form',
          'template' => 'add-game',
          'path' => drupal_get_path('theme', 'epicgamejam') . '/templates/form',
      );
  $items['epic_theme_node_form'] = array(
          'render element' => 'form',
          'template' => 'add-theme',
          'path' => drupal_get_path('theme', 'epicgamejam') . '/templates/form',
      );

  return $items;
}

// <form class="node-form node-epic_theme-form" action="/epic-themer" method="post" id="epic-theme-node-form" accept-charset="UTF-8"><div><div class="field-type-text field-name-title-field field-widget-text-textfield form-wrapper form-group" id="edit-title-field"><div id="title-field-add-more-wrapper"><div class="form-type-textfield form-item-title-field-und-0-value form-item form-group">
//   <label class="control-label" for="edit-title-field-und-0-value">Title <span class="form-required" title="This field is required.">*</span></label>
//   <input class="text-full form-control form-text required" type="text" id="edit-title-field-und-0-value" name="title_field[und][0][value]" value="" size="60" maxlength="255">
// </div>
// </div></div><input type="hidden" name="changed" value="">
// <input type="hidden" name="form_build_id" value="form-fWx7kUCFlE7dfjUXgPKQKM9m7fIsUiuPrhvOHXMNjB4">
// <input type="hidden" name="form_token" value="C_7X4Tdl4MNBTUZMIXOFrylkgX4dkxJy41RArpIUTI8">
// <input type="hidden" name="form_id" value="epic_theme_node_form">
// <h2 class="element-invisible">Vertical Tabs</h2><div class="tabbable tabs-left vertical-tabs clearfix bootstrap-tabs-processed"><ul class="nav nav-tabs vertical-tabs-list"><li class="vertical-tab-button first active selected" tabindex="-1"><a href="#edit-revision-information" data-toggle="tab" aria-expanded="true"><span>
// Revision information
// </span><div class="summary">No revision</div><span id="active-vertical-tab" class="element-invisible">(active tab)</span></a></li><li class="vertical-tab-button" tabindex="-1"><a href="#edit-path" data-toggle="tab"><span>
// URL path settings
// </span><div class="summary">Automatic alias</div></a></li><li class="vertical-tab-button" tabindex="-1"><a href="#edit-author" data-toggle="tab"><span>
// Authoring information
// </span><div class="summary">By admin</div></a></li><li class="vertical-tab-button last" tabindex="-1"><a href="#edit-options" data-toggle="tab"><span>
// Publishing options
// </span><div class="summary">Published</div></a></li></ul><div class="vertical-tabs-panes vertical-tabs-processed tab-content" style="min-height: 236px;"><fieldset class="node-form-revision-information form-wrapper tab-pane vertical-tabs-pane active" id="edit-revision-information">

// <div class="panel-body fade in">
//   <div class="form-type-checkbox form-item-revision form-item checkbox">
//     <label class="control-label" for="edit-revision"><input type="checkbox" id="edit-revision" name="revision" value="1" class="form-checkbox"> Create new revision </label>

//   </div>
//   <div class="form-type-textarea form-item-log form-item form-group">
//     <label class="control-label" for="edit-log">Revision log message </label>
//     <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea"><textarea class="form-control form-textarea" title="" data-toggle="tooltip" id="edit-log" name="log" cols="60" rows="4" data-original-title="Provide an explanation of the changes you are making. This will help other authors understand your motivations."></textarea><div class="grippie"></div></div>
//   </div>
// </div>
// </fieldset>
// <fieldset class="path-form form-wrapper tab-pane vertical-tabs-pane" id="edit-path">

//   <div class="panel-body fade">
//     <div class="form-type-checkbox form-item-path-pathauto form-item checkbox">
//       <label class="control-label" for="edit-path-pathauto"><input type="checkbox" id="edit-path-pathauto" name="path[pathauto]" value="1" checked="checked" class="form-checkbox"> Generate automatic URL alias </label>

//       <p class="help-block">Uncheck this to create a custom alias below. <a href="/admin/config/search/path/patterns">Configure URL alias patterns.</a></p>
//     </div>
//     <div class="form-type-textfield form-item-path-alias form-item form-group form-disabled">
//       <label class="control-label" for="edit-path-alias">URL alias </label>
//       <input class="form-control form-text" type="text" id="edit-path-alias" name="path[alias]" value="" size="60" maxlength="255" disabled="disabled">
//       <p class="help-block">Optionally specify an alternative URL by which this content can be accessed. For example, type "about" when writing an about page. Use a relative path and don't add a trailing slash or the URL alias won't work.</p>
//     </div>
//   </div>
// </fieldset>
// <fieldset class="node-form-author form-wrapper tab-pane vertical-tabs-pane" id="edit-author">

//   <div class="panel-body fade">
//     <div class="form-type-textfield form-item-name form-autocomplete form-item form-group" role="application">
//       <label class="control-label" for="edit-name">Authored by </label>
//       <div class="input-group"><input class="form-control form-text" type="text" id="edit-name" name="name" value="admin" size="60" maxlength="60" autocomplete="OFF" aria-autocomplete="list"><span class="input-group-addon"><span class="icon glyphicon glyphicon-refresh" aria-hidden="true"></span></span></div><input type="hidden" id="edit-name-autocomplete" value="http://epicgamejam.dev/user/autocomplete" disabled="disabled" class="autocomplete autocomplete-processed">
//       <p class="help-block">Leave blank for <em class="placeholder">Anonymous</em>.</p>
//       <span class="element-invisible" aria-live="assertive" id="edit-name-autocomplete-aria-live"></span></div>
//       <div class="form-type-textfield form-item-date form-item form-group">
//         <label class="control-label" for="edit-date">Authored on </label>
//         <input class="form-control form-text" type="text" id="edit-date" name="date" value="" size="60" maxlength="25">
//         <p class="help-block">Format: <em class="placeholder">2015-02-24 22:58:14 +0100</em>. The date format is YYYY-MM-DD and <em class="placeholder">+0100</em> is the time zone offset from UTC. Leave blank to use the time of form submission.</p>
//       </div>
//     </div>
//   </fieldset>
//   <fieldset class="node-form-options form-wrapper tab-pane vertical-tabs-pane" id="edit-options">

//     <div class="panel-body fade">
//       <div class="form-type-checkbox form-item-status form-item checkbox">
//         <label class="control-label" for="edit-status"><input type="checkbox" id="edit-status" name="status" value="1" checked="checked" class="form-checkbox"> Published </label>

//       </div>
//       <div class="form-type-checkbox form-item-promote form-item checkbox">
//         <label class="control-label" for="edit-promote"><input type="checkbox" id="edit-promote" name="promote" value="1" class="form-checkbox"> Promoted to front page </label>

//       </div>
//       <div class="form-type-checkbox form-item-sticky form-item checkbox">
//         <label class="control-label" for="edit-sticky"><input type="checkbox" id="edit-sticky" name="sticky" value="1" class="form-checkbox"> Sticky at top of lists </label>

//       </div>
//     </div>
//   </fieldset>
//   <input class="vertical-tabs-active-tab" type="hidden" name="additional_settings__active_tab" value="edit-revision-information">
// </div></div><div class="form-actions form-wrapper form-group" id="edit-actions"><button id="edit-submit" name="op" value="Save" type="submit" class="btn btn-success form-submit"><span class="icon glyphicon glyphicon-ok" aria-hidden="true"></span> Save</button>
// </div></div></form>