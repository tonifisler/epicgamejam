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
  $items['epic_theme_node_form'] = array(
          'render element' => 'form',
          'template' => 'add-theme',
          'path' => drupal_get_path('theme', 'epicgamejam') . '/templates/form',
      );

  return $items;
}

/**
 * Alter the rate widget before display.
 *
 * @param object $widget Widget object
 * @param array $context
 *   array(
 *     'content_type' => $content_type,
 *     'content_id' => $content_id,
 *   );
 */
function epicgamejam_rate_widget_alter(&$widget, $context) {
  $widget->css = '';
  $widget->options[0][1] = '<i class="fa fa-chevron-up"></i>';
  $widget->options[1][1] = '<i class="fa fa-chevron-down"></i>';
}

/**
 * Theme rate button.
 *
 * @param array $variables
 * @return string
 */
function epicgamejam_rate_button($variables) {
  $text = $variables['text'];
  $href = $variables['href'];
  $class = $variables['class'];
  static $id = 0;
  $id++;

  $classes = 'rate-button';
  if ($class) {
    $classes .= ' text-center ' . $class;
  }
  if (empty($href)) {
    // Widget is disabled or closed.
    return '<span class="' . $classes . '" id="rate-button-' . $id . '">' .
      check_plain($text) .
      '</span>';
  }
  else {
    return '<a class="' . $classes . '" id="rate-button-' . $id . '" rel="nofollow" href="' . htmlentities($href) . '" title="' . check_plain($text) . '">' .
      $text .
      '</a>';
  }
}

/**
 * Overrides theme_menu_local_tasks().
 */
function epicgamejam_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs--primary nav nav-pills">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }

  return $output;
}

/**
 * Implements hook_preprocess_block().
 */
function epicgamejam_preprocess_block(&$variables) {
  $variables['title_attributes_array']['class'][] = 'text-center';
}

function epicgamejam_preprocess_image(&$variables) {
  if (isset($variables['style_name']) && $variables['style_name'] == 'badge_thumbnail') {
    if ($variables['attributes']['class'][0] != 'badge-sm') {
      $variables['attributes']['class'] = array('media-object');
      $variables['attributes']['style'][] = 'width: 50px; height: auto;';
    }
  }
}

function epicgamejam_field__taxonomy_term_reference(&$variables) {
  if ($variables['element']['#field_name'] === 'field_badges') {
    $output = '<ul class="list-badges list-inline">';
    $array = $variables['element']['#object']->field_badges['und'];
    foreach ($array as $delta => $item) {
      $image = $item['taxonomy_term']->field_badge_image;
      if ($image) {
        $image_uri = $image['und'][0]['uri'];
        $image_for_sizing = image_style_path('badge_thumbnail', $image_uri);
        $image_vars = array(
          'path' => $image_for_sizing,
          'alt' => $item['taxonomy_term']->description,
          'title' => $item['taxonomy_term']->name,
          'style_name' => 'badge-thumbnail',
          'attributes' => array(
            'class' => 'badge-sm',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-trigger' => 'hover',
            'data-html' => true
          )
        );
        $image_html = theme('image', $image_vars);
        $href = $variables['element'][$delta]['#href'];
        $output .= '<li class="badge-element">' . l($image_html, $href, array( 'html' => true )) . '</li>';
      }
    }
    $output .= '</ul>';
    return $output;
  }
}

function epicgamejam_preprocess_field(&$variables) {
  if ($variables['element']['#field_name'] == 'field_image' && $variables['element']['#view_mode'] == 'reddit') {
    $variables['items'][0]['#item']['attributes']['class'] = array('media-object');
    $variables['items'][0]['#item']['attributes']['width'] = '150px';
    $variables['items'][0]['#item']['attributes']['height'] = 'auto';
  }
}

/**
 * Formats a link.
 */
function epicgamejam_link_formatter_link_default($vars) {
  $link_options = $vars['element'];
  unset($link_options['title']);
  unset($link_options['url']);


  if (isset($link_options['attributes']['class'])) {
    $link_options['attributes']['class'] = array($link_options['attributes']['class']);
  }

  // this is ugly as hell but I could not set this in the preprocess_field.....
  if ($vars['field']['field_name'] == 'field_links') {
    $link_options['attributes']['class'] = array('btn', 'btn-primary');
  }

  // Display a normal link if both title and URL are available.
  if (!empty($vars['element']['title']) && !empty($vars['element']['url'])) {
    return l($vars['element']['title'], $vars['element']['url'], $link_options);
  }
  // If only a title, display the title.
  elseif (!empty($vars['element']['title'])) {
    return $link_options['html'] ? $vars['element']['title'] : check_plain($vars['element']['title']);
  }
  elseif (!empty($vars['element']['url'])) {
    return l($vars['element']['title'], $vars['element']['url'], $link_options);
  }
}
