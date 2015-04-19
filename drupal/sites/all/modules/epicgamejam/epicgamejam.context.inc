<?php
/**
 * @file
 * epicgamejam.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function epicgamejam_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'all_games';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        'games' => 'games',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-games-block_2' => array(
          'module' => 'views',
          'delta' => 'games-block_2',
          'region' => 'content_bottom',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['all_games'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'game';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'node' => array(
      'values' => array(
        'game' => 'game',
      ),
      'options' => array(
        'node_form' => '0',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-games-block_3' => array(
          'module' => 'views',
          'delta' => 'games-block_3',
          'region' => 'content_bottom',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['game'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'homepage';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        '<front>' => '<front>',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'block-1' => array(
          'module' => 'block',
          'delta' => '1',
          'region' => 'highlighted',
          'weight' => '-10',
        ),
        'views-games-block' => array(
          'module' => 'views',
          'delta' => 'games-block',
          'region' => 'content_bottom',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['homepage'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'jammer';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'user_page' => array(
      'values' => array(
        'view' => 'view',
      ),
      'options' => array(
        'mode' => 'all',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-games-block_1' => array(
          'module' => 'views',
          'delta' => 'games-block_1',
          'region' => 'content_bottom',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['jammer'] = $context;

  return $export;
}
