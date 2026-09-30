<?php
/**
 * functions.php
 * Shared helper functions used across multiple pages.
 */

declare(strict_types=1);

/**
 * Escape a value for safe HTML output.
 */
function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}