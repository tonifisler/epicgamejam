<?php
/**
 * @file
 * egj_rules.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function egj_rules_default_rules_configuration() {
  $items = array();
  $items['rules_slack_new_games'] = entity_import('rules_config', '{ "rules_slack_new_games" : {
      "LABEL" : "Slack new games",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "REQUIRES" : [ "rules", "slack" ],
      "ON" : { "node_insert--game" : { "bundle" : "game" } },
      "DO" : [
        { "slack_send_message" : {
            "username" : "New game ALERT",
            "message" : "[node:title] - by team [node:field_team_name]\\r\\n[node:url] "
          }
        }
      ]
    }
  }');
  $items['rules_slack_new_themes'] = entity_import('rules_config', '{ "rules_slack_new_themes" : {
      "LABEL" : "Slack new themes",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "REQUIRES" : [ "rules", "slack" ],
      "ON" : { "node_insert--subtheme" : { "bundle" : "subtheme" } },
      "DO" : [
        { "slack_send_message" : { "message" : "[node:title]\\r\\n[node:body]" } }
      ]
    }
  }');
  return $items;
}
