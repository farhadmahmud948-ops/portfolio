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

/**
 * Milliseconds this visitor has left to view the page. Call before any output.
 *
 * The start time is in a cookie, not a PHP session, because hosts like Vercel
 * run several copies of the site that do not share session files.
 */
function view_time_left($seconds)
{
    $now = (int) round(microtime(true) * 1000);
    $cookie = isset($_COOKIE['view_started']) ? (string) $_COOKIE['view_started'] : '';
    $started = preg_match('/^\d{13}$/', $cookie) ? (int) $cookie : 0;

    // First visit, or a start time that makes no sense.
    if ($started === 0 || $started > $now + 5000) {
        $started = $now;
        $proto = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : '';
        setcookie('view_started', (string) $started, [
            'path' => '/',
            'secure' => $proto === 'https' || !empty($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
    header('Cache-Control: no-store');

    return max(0, $seconds * 1000 - max(0, $now - $started));
}
