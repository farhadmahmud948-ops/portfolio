<?php
/** True while a value is still a [placeholder]. */
function is_todo($value)
{
    return strpos((string) $value, '[') !== false;
}

/** Escape text for HTML, and highlight [placeholders]. */
function e($value)
{
    $safe = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    return preg_replace('/\[(.+?)\]/u', '<span class="todo">$1</span>', $safe);
}

/** Escape a value for an HTML attribute. */
function attr($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Asset path with a version, so browsers pick up changes straight away. */
function asset($path)
{
    $file = dirname(__DIR__) . '/' . $path;
    return attr($path) . (is_file($file) ? '?v=' . filemtime($file) : '');
}

/** Milliseconds this visitor has left to view the page. Call before any output. */
function view_time_left($seconds)
{
    session_start([
        'use_strict_mode' => 1,
        'cookie_httponly' => 1,
        'cookie_samesite' => 'Lax',
        'cache_limiter' => 'nocache',
    ]);
    if (!isset($_SESSION['view_started'])) {
        $_SESSION['view_started'] = microtime(true);
    }
    $used = microtime(true) - $_SESSION['view_started'];
    session_write_close();

    return max(0, (int) round(($seconds - $used) * 1000));
}
