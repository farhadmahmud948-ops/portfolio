<?php
/*
 * Everything shown on the page comes from this file.
 *
 * - Text in [square brackets] is treated as a placeholder and highlighted.
 * - Leave a value as '' (or a list as []) to hide it. Empty sections
 *   disappear from the page and from the menu.
 */

return [
    'first_name' => 'Farhad',
    'last_name' => 'Mahmud',
    'role' => 'Full-stack developer',
    'tagline' => 'I build web and mobile apps with React, React Native and Node.js.',

    // How many seconds one visitor can view the page. Use '0' for no limit.
    'view_seconds' => '10',

    'photo' => 'assets/img/farhad-mahmud-cutout.png',
    'photo_full' => 'assets/img/farhad-mahmud.jpg',

    'email' => 'rixonahmed@gmail.com',
    'phone' => '',
    'cv' => '', // for example assets/farhad-mahmud-cv.pdf
    'links' => [
        ['label' => 'GitHub', 'url' => 'https://github.com/farhad-mahmud'],
        ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/farhad-mahmud-rixon-a24753264/'],
        ['label' => 'Codeforces', 'url' => 'https://codeforces.com/profile/_farhad_'],
    ],

    'about' => 'I’m a full-stack developer with hands-on experience in JavaScript, React.js, React Native and REST APIs, and a competitive programmer with 1000+ problems solved. I’ve also deployed multiple projects independently.',
    'facts' => [
        ['label' => 'Studying', 'value' => 'B.Sc. in Computer Science and Engineering, BUBT'],
        ['label' => 'Building for', 'value' => 'Web, Android and iOS'],
        ['label' => 'Problems solved', 'value' => '1000+'],
    ],

    'projects' => [
        [
            'name' => 'AI ResQPlus',
            'text' => 'Automated real-time threat detection (fire, accident, robbery) across vehicles, homes and industries, dispatching live GPS alerts through a mobile app and REST API, with a community road-threat feed.',
            'tags' => 'IoT, AI, React Native, REST API',
            'url' => 'https://github.com/farhad-mahmud/resqplus_app-watch',
            'link_label' => 'GitHub',
        ],
        [
            'name' => 'Competitive Programming Resources',
            'text' => 'Brings 100+ curated resources into a leveled competitive programming roadmap, with full CRUD and a Git-managed workflow.',
            'tags' => 'Next.js, Node.js, Express, PostgreSQL',
            'url' => 'https://cp-station.vercel.app/',
            'link_label' => 'Live site',
        ],
        [
            'name' => 'Edu Connect Hub',
            'text' => 'Connects students with experts through real-time messaging and a post feed, across Android and iOS.',
            'tags' => 'React Native, Firebase Auth, Firestore, REST API',
            'url' => 'https://github.com/farhad-mahmud/Edu-Connect-Hub.git',
            'link_label' => 'GitHub',
        ],
        [
            'name' => 'AI Flashcards & Quiz Generator',
            'text' => 'Generates quizzes and flashcards from study material using NLP, with a REST API layer for the front end.',
            'tags' => 'Java, NLP, REST API',
            'url' => 'https://github.com/farhad-mahmud/AI-FlashCard.git',
            'link_label' => 'GitHub',
        ],
    ],

    // Newest first. Add 'period' dates here if you want them shown.
    'experience' => [
        [
            'title' => 'Junior Software Engineer',
            'place' => 'ResearchBuddy AI Ltd',
            'period' => '',
            'points' => [],
        ],
        [
            'title' => 'Software Engineer Intern',
            'place' => 'ResearchBuddy AI Ltd',
            'period' => '',
            'points' => [
                'Worked on the official ResearchBuddy AI mobile app (React Native) and company website, both powered by a Firebase backend.',
                'Built Al-Jabir, a Crossref-compliant academic journal publishing platform, handling DOI registration, editorial workflow and the Crossref metadata deposit pipeline.',
            ],
        ],
        [
            'title' => 'Software Engineer Intern',
            'place' => 'Shohoj Coding',
            'period' => '',
            'points' => [
                'Built the company’s complete website and CRM platform (Node.js/Express, Prisma, PostgreSQL, Next.js), designing the database schema, authentication, role-based access, and a UTM-driven lead capture pipeline from Facebook ad campaigns.',
            ],
        ],
    ],

    'contests_intro' => 'CodeChef 2 star, with 1000+ problems solved across Codeforces, CodeChef, CSES, UVA and AtCoder. Took part in the BAPS National Programming Camp 2025.',
    'contests' => [
        ['name' => 'AUST IEEE Oscillion IUPC', 'place' => '40th'],
        ['name' => 'BUBT Collaborative Contest', 'place' => '53rd'],
        ['name' => 'NWU IUPC', 'place' => '57th'],
    ],

    'skills' => [
        ['group' => 'Languages', 'items' => ['C', 'C++', 'Java', 'Python (Django)', 'JavaScript']],
        ['group' => 'Frontend', 'items' => ['React.js', 'Next.js', 'HTML', 'CSS', 'Responsive design', 'UI/UX basics']],
        ['group' => 'Mobile', 'items' => ['React Native', 'Redux', 'Firebase Auth', 'Firestore']],
        ['group' => 'Backend and databases', 'items' => ['Node.js', 'Express.js', 'REST APIs', 'PostgreSQL', 'MongoDB', 'Firebase']],
        ['group' => 'ML and AI', 'items' => ['YOLOv8', 'PyTorch', 'TensorFlow', 'NumPy', 'Pandas']],
        ['group' => 'Tools', 'items' => ['Git', 'GitHub', 'Agile/Scrum']],
    ],

    'education' => [
        ['period' => '2023 – present', 'title' => 'B.Sc. in Computer Science and Engineering', 'place' => 'BUBT', 'result' => 'CGPA 3.60 / 4.0'],
        ['period' => '2019 – 2021', 'title' => 'Higher Secondary Certificate (HSC)', 'place' => 'Govt Science College', 'result' => 'GPA 5.00 / 5.00'],
        ['period' => '2017 – 2019', 'title' => 'Secondary School Certificate (SSC)', 'place' => 'Noakhali Zilla School', 'result' => 'GPA 5.00 / 5.00'],
    ],
];
