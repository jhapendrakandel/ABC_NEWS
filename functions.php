<?php
/**
 * ABC Nepal TV — Theme Bootstrap
 *
 * WordPress auto-loads this file. All runtime logic lives in function.php
 * and inc/ modules. This file is intentionally minimal.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Shared runtime helpers (single source of truth).
require_once get_template_directory() . '/function.php';

// Feature: Breaking / Featured / Hero post toggles.
require_once get_template_directory() . '/inc/news-toggles.php';
