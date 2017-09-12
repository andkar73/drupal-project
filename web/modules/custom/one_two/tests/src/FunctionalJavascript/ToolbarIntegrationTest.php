<?php

namespace Drupal\Tests\one_two\FunctionalJavascript;

/**
 * Created by PhpStorm.
 * User: ldc-aks
 * Date: 2017-09-12
 * Time: 11:16
 */

use \Drupal\FunctionalJavascriptTests\JavascriptTestBase;


/**
 * Tests the JavaScript functionality of the toolbar.
 *
 * @group one_two
 */
class ToolbarIntegrationTest extends JavascriptTestBase {
  /**
   * {@inheritdoc}
   */
  public static $modules = ['toolbar', 'node'];

  /**
   *
   */
  public function testToolbarToggling() {
    $admin_user = $this->drupalCreateUser([
      'access toolbar',
      'administer site configuration',
      'access content overview',
    ]);
    $this->drupalLogin($admin_user);
    $this->drupalGet('<front>');

    // Test that it is possible to toggle the toolbar tray.
    $this->assertElementVisible('#toolbar-link-system-admin_content', 'Toolbar tray is open by default.');
    $this->click('#toolbar-item-administration');
    $this->assertElementNotVisible('#toolbar-link-system-admin_content', 'Toolbar tray is closed after clicking the "Manage" button.');
    $this->click('#toolbar-item-administration');
    $this->assertElementVisible('#toolbar-link-system-admin_content', 'Toolbar tray is visible again after clicking the "Manage" button a second time.');
  }

}