<?php
/**
 * Class Theme_Review_Helper_Test
 *
 * @package theme-review-helper
 */

class Theme_Review_Helper_Test extends WP_UnitTestCase
{
	/**
	 * @test
	 */
	public function endpoints_should_exists()
	{
		$this->assertContains( "theme-features", $GLOBALS['wp']->public_query_vars );
		$this->assertContains( "theme-tags", $GLOBALS['wp']->public_query_vars );
		$this->assertContains( "theme-meta", $GLOBALS['wp']->public_query_vars );
	}
}
