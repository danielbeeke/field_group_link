<?php

/**
 * @file
 * Contains \Drupal\field_group\Plugin\field_group\FieldGroupFormatter\Link.
 */

namespace Drupal\field_group_link\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the 'link' formatter.
 *
 * @FieldGroupFormatter(
 *   id = "link",
 *   label = @Translation("Link"),
 *   description = @Translation("Field group as a link FTW!"),
 *   supported_contexts = {
 *     "view",
 *   }
 * )
 */
class Link extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function preRender(&$element) {
    $html_id = '';
    $html_class = 'field-group-link';

    $children = $this->group->children;

    $last_child_key = end($children);
    $entity = $element[$last_child_key]['#object'];
    $url_object = $entity->urlInfo();
    $url = $url_object->toString();

    if ($this->getSetting('id')) {
      $html_id = 'id="' . $this->getSetting('id') . '"';
    }

    $classes = $this->getClasses();
    if (!empty($classes)) {
      $html_class = 'class="' .  $html_class . ' ' . implode(' ', $classes) . '"';
    }

    $element += array(
      '#prefix' => '<a ' . $html_id . ' ' . $html_class . ' href="' . $url . '">',
      '#suffix' => '</a>'
    );
  }
}
