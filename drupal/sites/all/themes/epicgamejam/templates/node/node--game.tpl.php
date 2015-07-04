<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
hide($content['disqus']);
hide($content['links']);
hide($content['rate_epic_points']);

$epic_points = render($content['field_epic_points']) ? render($content['field_epic_points']) : '<span class="text-white text-epic">TBA</span>';

?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <div class="row">
      <div class="col-sm-4">
        <div class="thumbnail thumbnail-dark game-thumbnail">
          <?php print render($content['field_image']) ?>
          <div class="thumbnail-points bg-">
            <a href="<?php print $node_url; ?>">
              <span class="text-dimbo text-epic text-huge"></span> <?php print $epic_points; ?> <span class="text-epic text-dimbo text-uppercase text-middle"><span class="text-viking">e</span><span class="text-sunglow">p</span><span class="text-lightning-yellow">i</span><span class="text-viking">c</span> <span class="text-sunglow">p</span><span class="text-lightning-yellow">o</span><span class="text-viking">i</span><span class="text-sunglow">n</span><span class="text-lightning-yellow">t</span><span class="text-viking">s</span></span>
            </a>
          </div>
          <div class="caption">
            <?php if (!empty($content['field_badges'])): ?>
              <h5><?php print t('BADGEs PROUDLY EARNEd') ?></h5>
            <?php endif ?>
            <?php print render($content['field_badges']); ?><br>
            <p>—</p>
            <?php print render($content['field_genre']); ?><br>
            <?php print render($content['field_team_name']); ?><br>
            <?php print render($content['field_members']); ?><br>
            <?php if (!empty($content['field_2014_members'])) print t('<b>Members:</b>') . render($content['field_2014_members']) . '<br>'; ?>
            <?php print render($content['field_country']); ?><br>
            <?php print render($content['field_city']); ?><br>
            <?php print render($content['field_contact_email']); ?>
            <?php print render($content['field_live_event']); ?>
            <p>—</p>
            <?php print render($content['field_links']); ?>
            <?php if ($display_submitted): ?>
              <div class="spacer spacer-sm"></div>
              <div class="submitted">
                <small class="text-muted"><?php print $submitted; ?></small>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <div class="col-sm-8">
        <?php print render($content); ?>
        <div class="spacer spacer-sm"></div>
        <?php print render($content['disqus']); ?>
        <div class="spacer"></div>
      </div>
    </div>
  </div>

</div>
