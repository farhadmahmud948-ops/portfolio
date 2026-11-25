<?php
require __DIR__ . '/includes/helpers.php';
$p = require __DIR__ . '/data/profile.php';
$name = $p['first_name'] . ' ' . $p['last_name'];

// Limit how long one visitor can view the page. The start time is kept on the
// server, so refreshing does not restart the clock.
$limit = (int) $p['view_seconds'];
$remaining = $limit > 0 ? view_time_left($limit) : 0;
$expired = $limit > 0 && $remaining <= 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= attr($name) ?> | <?= attr($p['role']) ?></title>
    <?php if (!is_todo($p['tagline'])): ?>
    <meta name="description" content="<?= attr($p['tagline']) ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= attr($name) ?>">
    <meta property="og:image" content="<?= attr($p['photo_full']) ?>">
    <meta name="theme-color" content="#e6edf5">
    <link rel="icon" href="<?= attr($p['photo_full']) ?>">
    <?php if ($limit > 0 && !$expired): ?>
    <noscript><meta http-equiv="refresh" content="<?= $limit ?>"></noscript>
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anybody:wdth,wght@50..150,100..900&amp;family=Hanken+Grotesk:wght@400..700&amp;display=swap">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
</head>
<body>
    <?php if (!$expired): ?>
    <a class="skip" href="#main">Skip to content</a>

    <header class="nav">
        <nav aria-label="Main">
            <a href="#about">About</a>
            <?php if (!empty($p['projects'])): ?>
            <a href="#work">Work</a>
            <?php endif; ?>
            <?php if (!empty($p['experience'])): ?>
            <a href="#experience">Experience</a>
            <?php endif; ?>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <main id="main">
        <section class="hero">
            <canvas class="threads" aria-hidden="true"></canvas>

            <div class="stage">
                <h1 aria-label="<?= attr($name) ?>">
                    <span class="word word-a" aria-hidden="true"><?= attr($p['first_name']) ?></span>
                    <span class="word word-b" aria-hidden="true"><?= attr($p['last_name']) ?></span>
                </h1>
                <img class="portrait" src="<?= asset($p['photo']) ?>" width="750" height="750" alt="Portrait of <?= attr($name) ?>">
            </div>

            <div class="intro">
                <div class="intro-text">
                    <p class="role"><?= e($p['role']) ?></p>
                    <p class="tagline"><?= e($p['tagline']) ?></p>
                </div>
                <div class="actions">
                    <a class="button" href="#contact">Get in touch</a>
                    <?php if (!empty($p['cv'])): ?>
                    <a class="button button-quiet" href="<?= attr($p['cv']) ?>" download>Download CV</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="about" id="about">
            <h2 class="sr-only">About</h2>
            <p class="statement"><?= e($p['about']) ?></p>
            <?php if (!empty($p['facts'])): ?>
            <dl class="facts">
                <?php foreach ($p['facts'] as $fact): ?>
                <div>
                    <dt><?= e($fact['label']) ?></dt>
                    <dd><?= e($fact['value']) ?></dd>
                </div>
                <?php endforeach; ?>
            </dl>
            <?php endif; ?>
        </section>

        <?php if (!empty($p['projects'])): ?>
        <section class="block" id="work">
            <h2>Work</h2>
            <ul class="projects">
                <?php foreach ($p['projects'] as $project): ?>
                <li class="project">
                    <div class="project-head">
                        <h3><?php if (!empty($project['url'])): ?><a href="<?= attr($project['url']) ?>" target="_blank" rel="noopener"><?= e($project['name']) ?></a><?php else: ?><?= e($project['name']) ?><?php endif; ?></h3>
                        <?php if (!empty($project['url'])): ?>
                        <span class="where"><?= e($project['link_label']) ?> <span aria-hidden="true">↗</span></span>
                        <?php endif; ?>
                    </div>
                    <p><?= e($project['text']) ?></p>
                    <p class="tags"><?= e($project['tags']) ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php endif; ?>

        <?php if (!empty($p['experience'])): ?>
        <section class="block" id="experience">
            <h2>Experience</h2>
            <ol class="timeline">
                <?php foreach ($p['experience'] as $job): ?>
                <li>
                    <span class="side"><?= e($job['place']) ?></span>
                    <div>
                        <h3><?= e($job['title']) ?></h3>
                        <?php if (!empty($job['period'])): ?>
                        <p class="meta"><?= e($job['period']) ?></p>
                        <?php endif; ?>
                        <?php foreach ($job['points'] as $point): ?>
                        <p class="point"><?= e($point) ?></p>
                        <?php endforeach; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </section>
        <?php endif; ?>

        <?php if (!empty($p['contests'])): ?>
        <section class="block" id="contests">
            <h2>Competitive programming</h2>
            <div>
                <p class="lead"><?= e($p['contests_intro']) ?></p>
                <ul class="contests">
                    <?php foreach ($p['contests'] as $contest): ?>
                    <li><span><?= e($contest['name']) ?></span> <strong><?= e($contest['place']) ?></strong></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <?php endif; ?>

        <?php if (!empty($p['skills'])): ?>
        <section class="block" id="skills">
            <h2>Skills</h2>
            <div class="skills">
                <?php foreach ($p['skills'] as $skill): ?>
                <div>
                    <h3><?= e($skill['group']) ?></h3>
                    <ul>
                        <?php foreach ($skill['items'] as $item): ?>
                        <li><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php if (!empty($p['education'])): ?>
        <section class="block" id="education">
            <h2>Education</h2>
            <ol class="timeline">
                <?php foreach ($p['education'] as $school): ?>
                <li>
                    <span class="side"><?= e($school['period']) ?></span>
                    <div>
                        <h3><?= e($school['title']) ?></h3>
                        <p class="meta"><?= e($school['place']) ?>, <?= e($school['result']) ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </section>
        <?php endif; ?>
    </main>

    <footer class="contact" id="contact">
        <h2>Let’s talk</h2>
        <?php if (!empty($p['email'])): ?>
        <p class="email"><?php if (is_todo($p['email'])): ?><?= e($p['email']) ?><?php else: ?><a href="mailto:<?= attr($p['email']) ?>"><?= e($p['email']) ?></a><?php endif; ?></p>
        <?php endif; ?>
        <div class="contact-foot">
            <p>© <?= date('Y') ?> <?= e($name) ?></p>
            <ul>
                <?php if (!empty($p['phone'])): ?>
                <li><a href="tel:<?= attr($p['phone']) ?>"><?= e($p['phone']) ?></a></li>
                <?php endif; ?>
                <?php foreach ($p['links'] as $link): ?>
                <?php if (!empty($link['url'])): ?>
                <li><a href="<?= attr($link['url']) ?>" target="_blank" rel="noopener"><?= e($link['label']) ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </footer>

    <script src="<?= asset('assets/js/main.js') ?>" defer></script>
    <?php endif; ?>

    <?php if ($limit > 0): ?>
    <section class="expired" id="expired" tabindex="-1" <?= $expired ? '' : 'hidden' ?>>
        <h1>Time’s up</h1>
        <p>Each visit to this page lasts <?= $limit ?> seconds. Thanks for stopping by.</p>
    </section>
    <?php endif; ?>
    <?php if ($limit > 0 && !$expired): ?>
    <p class="countdown" id="countdown" role="timer" data-ms="<?= $remaining ?>"></p>
    <script src="<?= asset('assets/js/session.js') ?>"></script>
    <?php endif; ?>
</body>
</html>
