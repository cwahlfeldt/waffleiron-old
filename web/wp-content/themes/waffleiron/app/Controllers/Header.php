<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Header extends Controller {
  // get menu items for header
  public function get_menu_items($menu_slug) {
    if (isset($menu_slug)) {
      $locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object($locations[$menu_slug]);
      $menu_items = wp_get_nav_menu_items($menu->term_id);
      return $menu_items;
    } else {
      error_log('No menu slug');
      return 'No Slug';
    }
  }
}
