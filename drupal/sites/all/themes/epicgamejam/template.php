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

  // dpm(rate_get_results('node', $variables['nid'], 1));
}

/**
 * template_preprocess_page
 */
function epicgamejam_preprocess_page(&$variables) {
  if ($variables['theme_hook_suggestions'][0] === 'page__user') {
    $variables['is_user_profile'] = true;
  }
}

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function epicgamejam_menu_tree__secondary(&$variables) {
  return '<div class="container"><ul class="list-inline pull-right">' . $variables['tree'] . '</ul></div>';
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
      drupal_set_title(t('SUBMIT a GAME'));
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
    if (isset($variables['attributes']['class']) && $variables['attributes']['class'][0] != 'badge-sm') {
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
      $image = $item['taxonomy_term']->field_svg;
      if ($image) {
        $image_uri = $image['und'][0]['uri'];
        $image_vars = array(
          'path' => $image_uri,
          'alt' => $item['taxonomy_term']->description,
          'style_name' => 'badge-thumbnail',
          'attributes' => array(
            'class' => 'badge-sm',
          )
        );
        $image_html = theme('image', $image_vars);
        $href = $variables['element'][$delta]['#href'];
        $output .= '<li class="badge-element">' . l($image_html, $href, array(
          'html' => true,
          'attributes' => array(
            'title' => $item['taxonomy_term']->name,
            'data-toggle' => 'tooltip',
            'data-placement' => 'top'
          ))) . '</li>';
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
    $link_options['attributes']['class'] = array('btn', 'btn-white');
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

/**
 * Implements hook_preprocess_views_view_table().
 */
function epicgamejam_preprocess_views_view_table(&$variables) {
  $variables['attributes_array']['data-tablesaw-mode'] = 'stack';

}

/**
 * Alter the vote before it is saved.
 *
 * @param array $vote
 *   array(
 *     'entity_type' => $content_type,
 *     'entity_id' => $content_id,
 *     'value_type' => $widget->value_type,
 *     'value' => $value,
 *     'tag' => $widget->tag,
 *   );
 * @param array $context
 *   array(
 *     'redirect' => &$redirect, // Path. Alter to redirect the user.
 *     'save' => &$save, // Boolean indicating whether the vote must be saved.
 *     'widget' => $widget, // Widget object, unalterable.
 *   );
 */
function epicgamejam_rate_vote_alter(&$vote, $context) {
  if ($context['widget']->name == 'epic_points') {
    $vote['value'] = 150;
  }
}

/**
 * Preprocess function for the thumbs_up_down template.
 */
function epicgamejam_preprocess_rate_template_number_up_down(&$variables) {
  extract($variables);

  $up_classes = 'rate-number-up-down-btn-up asdf';
  $down_classes = 'rate-number-up-down-btn-down';
  if (isset($results['user_vote'])) {
    switch ($results['user_vote']) {
      case $links[0]['value']:
        $up_classes .= ' rate-voted';
        break;
      case $links[1]['value']:
        $down_classes .= ' rate-voted';
        break;
    }
  }

  $variables['up_button_epic'] = theme('rate_button', array('text' => $links[0]['text'], 'href' => $links[0]['href'], 'class' => $up_classes));
  $variables['down_button_epic'] = theme('rate_button', array('text' => $links[1]['text'], 'href' => $links[1]['href'], 'class' => $down_classes));
  if ($results['rating'] > 0) {
    $score = '+' . $results['rating'];
    $score_class = 'positive';
  }
  elseif ($results['rating'] < 0) {
    $score = $results['rating'];
    $score_class = 'negative';
  }
  else {
    $score = 0;
    $score_class = 'neutral';
  }
  $variables['score'] = $score;
  $variables['score_class'] = $score_class;

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('Voting is closed.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = t('You voted \'@option\'.', array('@option' => $results['user_vote'] == 1 ? $links[0]['text'] : $links[1]['text']));
    }
  }
  $variables['info'] = implode(' ', $info);
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
      $text .
      '</span>';
  }
  else {
    return '<a class="' . $classes . '" id="rate-button-' . $id . '" rel="nofollow" href="' . htmlentities($href) . '">' . $text . '</a>';
  }
}

function epicgamejam_theme() {
  $items['game_node_form'] = array(
          'render element' => 'form',
          'template' => 'add-game',
          'path' => drupal_get_path('theme', 'epicgamejam') . '/templates/form',
      );
  return $items;
}
