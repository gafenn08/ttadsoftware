<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 */

/******************************************************************************
 * WARNING!!!! NEVER CHANGE ANYTHING IN THIS FOLDER!!! USE A CHILD THEME!
  CHECK OUT "STARTER-CHILD" FOLDER FOR INSTRUCTIONS  */
/******************************************************************************/

// Includes:
require_once 'includes/form.inc.php';

/**
 * Replaces any character not a digit, letter or dash with a dash.
 */
function _ttad_safe_settings($original) {
  return strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', theme_get_setting($original)));
}

/**
 * Changes the default meta content-type tag to the shorter HTML5 version.
 */
function ttad_html_head_alter(&$variables) {
  global $theme;
  global $base_path;

  // Cache path to theme for duration of this function:
  $path_to_ttad = "/" . drupal_get_path('theme', 'ttad') . '/images/icons/';
  $path_to_child = "/" . drupal_get_path('theme', $theme) . '/images/icons/';


  $variables['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );

  // We want to allow the theme to use copies of the foundation framework that're
  // installed in sites/all/libraries. Start with a couple of vars for figuring
  // out the library location:
  $path_to_ttad = drupal_get_path('theme', 'ttad');
  // The fallback path to the foundation library is here, in the theme:
  $ttad_theme_path = DRUPAL_ROOT . '/' . drupal_get_path('theme', 'ttad') . '/foundation';
  // But if the library module exists, we might find it elsewhere (and we'd
  // prefer to use that one):
  if (module_exists('libraries') && $path = libraries_get_path('foundation')) {
    // If the libraries module exists, here's one possiblity:
    $foundation_library_path = DRUPAL_ROOT . '/' . $path;
  }
  // Decide which--if either--to use:
  if (isset($foundation_library_path) && is_dir($foundation_library_path)) {
    $foundation_path = $path;
  }
  elseif (is_dir($ttad_theme_path)) {
    $foundation_path = $path_to_ttad;
  }
  // If it's just not available, display a message to the user:
  else {
    drupal_set_message(t('The Foundation framework could not be found. In order to use the ttad theme, you must download the framework from !foundation-url, and extract it to <em>sites/all/libraries/foundation</em> (if the !libraries-module is installed) or to %foundation-theme-path.', 
      array(
        '!foundation-url' => l(t('the Foundation project page'), 'http://foundation.zurb.com'), 
        '!libraries-module' => l(t('7.x-1.x version of the Libraries module'), 'http://drupal.org/project/libraries'), 
        '%foundation-theme-path' => $path_to_ttad . '/foundation')
      ), 'error');
  }
  
  // Add conditional stylesheets for lesser browsers
  for ($i = 6; $i <= 11; $i++){
    if( is_file( DRUPAL_ROOT . '/' . drupal_get_path('theme', $theme) . '/ie'.$i.'.css') ){
      drupal_add_css( drupal_get_path('theme', $theme) . '/ie'.$i.'.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE '. $i, '!IE' => FALSE), 'preprocess' => FALSE));  
    }
    elseif( is_file( DRUPAL_ROOT . '/' . drupal_get_path('theme', $theme) . '/css/ie'.$i.'.css') ){
      drupal_add_css( drupal_get_path('theme', $theme) . '/css/ie'.$i.'.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE '. $i, '!IE' => FALSE), 'preprocess' => FALSE));  
    }
  }


  // CSS
  drupal_add_css($foundation_path . '/foundation/stylesheets/app.css', array('media' => 'all'));
  // JS
  drupal_add_js($foundation_path . '/foundation/javascripts/foundation.min.js', array('scope' => 'footer'));

  if (_ttad_safe_settings('default_favicon')) {
    foreach ($variables as $key => $value) {
      if (strpos($key, 'misc/favicon.ico') !== FALSE) {

        $favicon = is_file(DRUPAL_ROOT . $path_to_child . 'favicon.ico') ? $path_to_child . 'favicon.ico' : $path_to_ttad . 'favicon.ico';

        $variables[$key]['#attributes']['href'] = $favicon;
      }
    }
  }
}



/**
 * Implements hook_preprocess_region().
 */
function ttad_preprocess_region(&$variables) {
}

/**
 * Implements hook_preprocess_region().
 */
// function ttad_preprocess_block(&$variables) {
//   if (isset($variables['block']->region) && $variables['block']->region == 'nav' ){
//     // do nav-like things
//     kpr($variables);
//   }
// }

/**
 * Implements hook_preprocess_html().
 */
function ttad_preprocess_html(&$variables) {
  global $theme;
  global $base_path;

  // Cache path to theme for duration of this function:
  $path_to_ttad = "/" . drupal_get_path('theme', 'ttad') . '/images/icons/';
  $path_to_child = "/" . drupal_get_path('theme', $theme) . '/images/icons/';

  $icon57 = is_file(DRUPAL_ROOT . $path_to_child . 'apple-57x57.png') ? $path_to_child . 'apple-57x57.png' : $path_to_ttad . 'apple-57x57.png';
  $icon72 = is_file(DRUPAL_ROOT . $path_to_child . 'apple-72x72.png') ? $path_to_child . 'apple-72x72.png' : $path_to_ttad . 'apple-72x72.png';
  $icon114 = is_file(DRUPAL_ROOT . $path_to_child . 'apple-114x114.png') ? $path_to_child . 'apple-114x114.png' : $path_to_ttad . 'apple-114x114.png';

  drupal_add_html_head_link(array('rel' => 'apple-touch-icon', 'href' => $icon57));
  drupal_add_html_head_link(array('rel' => 'apple-touch-icon', 'href' => $icon72));
  drupal_add_html_head_link(array('rel' => 'apple-touch-icon', 'href' => $icon114));

  // TODO: add detection here for SVG compatibility
  $variables['classes_array'][] = 'svg';

  // Classes related to admin_menu:
  if (user_access('Access administration menu')) {
    if (module_exists('admin_menu_toolbar')) {
      $variables['classes_array'][] = 'ttad-admin-menu-toolbar';
    }
    elseif (module_exists('admin_menu')) {
      $variables['classes_array'][] = 'ttad-admin-menu';
    }
  }

}

/**
 * Implements theme_status_messages().
 *
 * Squash drupal's status messages to fit with foundation
 */
function ttad_status_messages(&$variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );

  $equiv = array(
    'status' => 'success',
    'warning' => 'warning',
    'error' => 'error',
  );

  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"messages alert-box $equiv[$type]\">\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "<a href=\"#\" class=\"close\">&times;</a></div>\n";
  }
  return $output;
}


/**
 * Implements theme_pager().
 *
 * Drupal's pager system is questionbly useful so this is a first stab at a
 * rewrite. Basically we're squashing it into a shape that Foundation Pager
 * likes.
 */
function ttad_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // Current is the page we are currently paged to.
  $pager_current = $pager_page_array[$element] + 1;
  // First is the first page listed by this pager piece (re quantity).
  $pager_first = $pager_current - $pager_middle + 1;
  // Last is the last page listed by this pager piece (re quantity).
  $pager_last = $pager_current + $quantity - $pager_middle;
  // Max is the maximum page number.
  $pager_max = $pager_total[$element];

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  $li_first = theme('pager_first', array(
    'text' => (isset($tags[0]) ? $tags[0] : t('« first')),
    'element' => $element, 'parameters' => $parameters)
  );
  $li_previous = theme('pager_previous', array(
    'text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')),
    'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );
  $li_next = theme('pager_next', array(
    'text' => (isset($tags[3]) ? $tags[3] : t('next ›')),
    'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );
  $li_last = theme('pager_last', array(
    'text' => (isset($tags[4]) ? $tags[4] : t('last »')),
    'element' => $element, 'parameters' => $parameters)
  );

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for ($i = 1; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($pager_current - $i),
              'parameters' => $parameters)
            ),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('current'),
            'data' => "<a href='#'>$i</a>",
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($i - $pager_current),
              'parameters' => $parameters)
            ),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }

    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
    return '<div class="row ttad_paginate"><h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pagination')),
    )) . "</div>";
  }
}


/**
 * Implements theme_menu_link().
 */
function ttad_menu_link__main_menu($variables) {  
  // Store some values that'll be used more than once:

  $current_path = current_path();
  $element = $variables['element'];
  $sub_menu = '';

  if ($current_path == $element['#href'] || (drupal_is_front_page() && $element['#href'] == '<front>')) {
    $element['#attributes']['class'][] = 'active';
  }
  
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  
  // Classes for the list item:
  $element['#attributes']['class'][] = 'dropdown';

  // Add the dropdown's visual indicator:
  $element['#localized_options']['html'] = TRUE;

  // Attributes for the link itself:
  $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
  $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
  
  // Render the element--but do it differently:

  if (!empty($element['#below'])){
    $element['#below']['#theme_wrappers'] = array('menu_tree__ttad_dropdown');
    $sub_menu = drupal_render($element['#below']);
    $element['#attributes']['class'][] = 'has-flyout';
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . '<a href="#" class="flyout-toggle"></a>' .$sub_menu . "</li>\n";

  }

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . "</li>\n";
} // bh_foundation_menu_link()

/**
 * Implements theme_menu_tree().
 *
 * @see ttad_menu_link()
 */
function ttad_menu_tree($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';

} // ttad_menu_tree()

/**
 * Implements theme_menu_tree().
 *
 * This implementation is specific to submenus of the main menu.
 */
function ttad_menu_tree__ttad_dropdown($variables) {
  return '<ul class="flyout">' . $variables['tree'] . '</ul>';
} // ttad_menu_tree__dropdown_sub_menu()
