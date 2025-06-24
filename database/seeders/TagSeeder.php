<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

define('tags', [
    [
        'label' => 'HTML5',
        'color' => '#FF0080'  // Rose néon vif
    ],
    [
        'label' => 'CSS3',
        'color' => '#00FFFF'  // Cyan électrique
    ],
    [
        'label' => 'JavaScript',
        'color' => '#FFFF00'  // Jaune néon
    ],
    [
        'label' => 'TypeScript',
        'color' => '#0080FF'  // Bleu électrique
    ],
    [
        'label' => 'React',
        'color' => '#FF6B00'  // Orange cyberpunk
    ],
    [
        'label' => 'Vue.js',
        'color' => '#00FF80'  // Vert néon
    ],
    [
        'label' => 'Angular',
        'color' => '#FF4080'  // Rouge néon
    ],
    [
        'label' => 'Svelte',
        'color' => '#8000FF'  // Violet électrique
    ],

    // Backend Technologies
    [
        'label' => 'PHP',
        'color' => '#FF0040'  // Rouge magenta
    ],
    [
        'label' => 'Laravel',
        'color' => '#FF8000'  // Orange vif
    ],
    [
        'label' => 'Symfony',
        'color' => '#40FF00'  // Vert lime
    ],
    [
        'label' => 'Node.js',
        'color' => '#00FF40'  // Vert néon clair
    ],
    [
        'label' => 'Express',
        'color' => '#FFFF80'  // Jaune pâle néon
    ],
    [
        'label' => 'Python',
        'color' => '#80FF00'  // Vert-jaune électrique
    ],
    [
        'label' => 'Django',
        'color' => '#00FFAA'  // Turquoise
    ],
    [
        'label' => 'FastAPI',
        'color' => '#AA00FF'  // Violet magenta
    ],

    // Databases
    [
        'label' => 'MySQL',
        'color' => '#FF8040'  // Orange saumon néon
    ],
    [
        'label' => 'PostgreSQL',
        'color' => '#4080FF'  // Bleu clair électrique
    ],
    [
        'label' => 'MongoDB',
        'color' => '#80FF40'  // Vert pomme néon
    ],
    [
        'label' => 'Redis',
        'color' => '#FF4040'  // Rouge corail
    ],
    [
        'label' => 'SQLite',
        'color' => '#FFAA00'  // Ambre électrique
    ],

    // DevOps & Tools
    [
        'label' => 'Docker',
        'color' => '#00AAFF'  // Bleu ciel néon
    ],
    [
        'label' => 'Git',
        'color' => '#FF00AA'  // Magenta vif
    ],
    [
        'label' => 'GitHub',
        'color' => '#80FFFF'  // Cyan pâle
    ],
    [
        'label' => 'GitLab',
        'color' => '#FF8080'  // Rose saumon
    ],
    [
        'label' => 'CI/CD',
        'color' => '#8080FF'  // Bleu lavande néon
    ],
    [
        'label' => 'Linux',
        'color' => '#00FF00'  // Vert Matrix
    ],
    [
        'label' => 'Nginx',
        'color' => '#AAFF00'  // Vert-jaune vif
    ],
    [
        'label' => 'Apache',
        'color' => '#FF00FF'  // Fuchsia électrique
    ],

    // Frontend Styling & Tools
    [
        'label' => 'Sass',
        'color' => '#FF6040'  // Orange-rouge
    ],
    [
        'label' => 'Tailwind',
        'color' => '#40FFFF'  // Cyan clair
    ],
    [
        'label' => 'Bootstrap',
        'color' => '#6040FF'  // Bleu-violet
    ],
    [
        'label' => 'Webpack',
        'color' => '#FFB000'  // Orange doré
    ],
    [
        'label' => 'Vite',
        'color' => '#B000FF'  // Violet profond
    ],

    // APIs & Architecture
    [
        'label' => 'REST API',
        'color' => '#00B0FF'  // Bleu azur
    ],
    [
        'label' => 'GraphQL',
        'color' => '#FF0060'  // Rose fuchsia
    ],
    [
        'label' => 'JWT',
        'color' => '#60FF00'  // Vert lime vif
    ],
    [
        'label' => 'WebSocket',
        'color' => '#0060FF'  // Bleu royal néon
    ],
    [
        'label' => 'Microservices',
        'color' => '#FF6080'  // Rose corail
    ],
    [
        'label' => 'MVC',
        'color' => '#80FF80'  // Vert menthe
    ],

    // Testing & Quality
    [
        'label' => 'PHPUnit',
        'color' => '#FFA000'  // Orange ambre
    ],
    [
        'label' => 'Jest',
        'color' => '#A000FF'  // Violet indigo
    ],
    [
        'label' => 'Cypress',
        'color' => '#00FFA0'  // Vert emeraude
    ],
    [
        'label' => 'ESLint',
        'color' => '#FFF000'  // Jaune citron
    ],
    [
        'label' => 'Prettier',
        'color' => '#F000FF'  // Magenta brillant
    ],

    // Security & Performance
    [
        'label' => 'SSL/TLS',
        'color' => '#FF4000'  // Rouge orangé
    ],
    [
        'label' => 'OAuth',
        'color' => '#4000FF'  // Bleu indigo
    ],
    [
        'label' => 'CORS',
        'color' => '#00FF60'  // Vert spring
    ],
    [
        'label' => 'Cache',
        'color' => '#FF0020'  // Rouge écarlate
    ],
    [
        'label' => 'SEO',
        'color' => '#20FF00'  // Vert électrique
    ],
    [
        'label' => 'PWA',
        'color' => '#0020FF'  // Bleu électrique profond
    ],

    // Soft Skills & Methodologies
    [
        'label' => 'Agile',
        'color' => '#FF2080'  // Rose vif
    ],
    [
        'label' => 'Scrum',
        'color' => '#80FF20'  // Vert-jaune
    ],
    [
        'label' => 'Debug',
        'color' => '#2080FF'  // Bleu ciel vif
    ],
    [
        'label' => 'Refactoring',
        'color' => '#FF8020'  // Orange brûlé
    ],
    [
        'label' => 'Documentation',
        'color' => '#8020FF'  // Violet améthyste
    ],
    [
        'label' => 'Code Review',
        'color' => '#20FF80'  // Vert jade
    ],

    // Emerging Tech
    [
        'label' => 'AI/ML',
        'color' => '#FF00C0'  // Magenta électrique
    ],
    [
        'label' => 'WebAssembly',
        'color' => '#C000FF'  // Violet royal
    ],
    [
        'label' => 'Blockchain',
        'color' => '#00C0FF'  // Cyan brillant
    ],
    [
        'label' => 'WebGL',
        'color' => '#FFC000'  // Or électrique
    ]
]);

class TagSeeder extends Seeder
{
    public function run()
    {
        foreach (tags as $tagData) {
            Tag::create([
                'label' => $tagData['label'],
                'color' => $tagData['color'],
            ]);
        }
    }
}