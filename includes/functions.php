<?php

/**
 * Escape dữ liệu trước khi đưa vào HTML.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
