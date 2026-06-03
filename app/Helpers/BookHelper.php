<?php

if (!function_exists('getBookCoverColor')) {
    /**
     * Generate warna cover buku berdasarkan ID
     */
    function getBookCoverColor($bookId) {
        $colors = [
            ['primary' => '#7c3aed', 'secondary' => '#a78bfa'],
            ['primary' => '#3b82f6', 'secondary' => '#93c5fd'],
            ['primary' => '#ec4899', 'secondary' => '#f472b6'],
            ['primary' => '#f59e0b', 'secondary' => '#fbbf24'],
            ['primary' => '#10b981', 'secondary' => '#6ee7b7'],
            ['primary' => '#06b6d4', 'secondary' => '#22d3ee'],
            ['primary' => '#8b5cf6', 'secondary' => '#c4b5fd'],
            ['primary' => '#ef4444', 'secondary' => '#fca5a5'],
            ['primary' => '#14b8a6', 'secondary' => '#99f6e4'],
            ['primary' => '#6366f1', 'secondary' => '#a5b4fc'],
        ];
        
        return $colors[($bookId - 1) % count($colors)];
    }
}

if (!function_exists('getCategoryIcon')) {
    /**
     * Get SVG icon untuk kategori buku
     */
    function getCategoryIcon($categoryId) {
        $icons = [
            1 => '<!-- Fiksi & Novel --><path d="M40 70 C 60 50, 90 50, 100 65 C 110 50, 140 50, 160 70 V 190 C 140 170, 110 170, 100 185 C 90 170, 60 170, 40 190 Z" fill="none" stroke="white" stroke-width="4" stroke-linejoin="round"/><path d="M100 65 V185" stroke="white" stroke-width="4"/>',
            2 => '<!-- Sains & Teknologi --><circle cx="100" cy="100" r="35" fill="none" stroke="white" stroke-width="2"/><line x1="70" y1="100" x2="130" y2="100" stroke="white" stroke-width="2"/><line x1="100" y1="70" x2="100" y2="130" stroke="white" stroke-width="2"/>',
            3 => '<!-- Sejarah --><rect x="70" y="70" width="60" height="60" fill="none" stroke="white" stroke-width="2" rx="4"/><line x1="85" y1="85" x2="115" y2="85" stroke="white" stroke-width="1.5"/><line x1="85" y1="95" x2="115" y2="95" stroke="white" stroke-width="1.5"/><line x1="85" y1="105" x2="115" y2="105" stroke="white" stroke-width="1.5"/><line x1="85" y1="115" x2="115" y2="115" stroke="white" stroke-width="1.5"/>',
            4 => '<!-- Bisnis & Ekonomi --><path d="M80 120 L100 80 L120 100 L100 120 Z" fill="white"/><line x1="100" y1="80" x2="100" y2="120" stroke="white" stroke-width="2"/><line x1="80" y1="100" x2="120" y2="100" stroke="white" stroke-width="2"/>',
            5 => '<!-- Agama & Spiritual --><path d="M100 70 L110 90 L130 90 L115 105 L120 125 L100 110 L80 125 L85 105 L70 90 L90 90 Z" fill="white"/>',
            6 => '<!-- Buku Anak --><circle cx="70" cy="80" r="10" fill="white"/><circle cx="130" cy="80" r="10" fill="white"/><path d="M100 100 Q80 110 70 120 Q100 130 130 120 Q120 110 100 100" fill="white"/>',
            7 => '<!-- Jurnal & Riset --><rect x="75" y="75" width="50" height="60" fill="none" stroke="white" stroke-width="2" rx="2"/><line x1="80" y1="85" x2="120" y2="85" stroke="white" stroke-width="1"/><line x1="80" y1="95" x2="120" y2="95" stroke="white" stroke-width="1"/><line x1="80" y1="105" x2="120" y2="105" stroke="white" stroke-width="1"/><line x1="80" y1="115" x2="100" y2="115" stroke="white" stroke-width="1"/><line x1="80" y1="125" x2="120" y2="125" stroke="white" stroke-width="1"/>'
        ];
        
        return $icons[$categoryId] ?? $icons[1];
    }
}

if (!function_exists('getBookCoverSVG')) {
    /**
     * Generate SVG cover buku dengan kategori specific icon
     */
    function getBookCoverSVG($bookId, $categoryId, $title) {
        $color = getBookCoverColor($bookId);
        $icon = getCategoryIcon($categoryId);
        
        return <<<SVG
            <svg width="100%" height="100%" viewBox="0 0 200 280" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="grad{$bookId}" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:{$color['primary']};stop-opacity:1" />
                        <stop offset="100%" style="stop-color:{$color['secondary']};stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect width="200" height="280" fill="url(#grad{$bookId})"/>
                <rect x="10" y="10" width="180" height="260" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2" rx="4"/>
                <g transform="translate(0, 30) scale(0.8)">
                    {$icon}
                </g>
                <text x="100" y="200" font-family="DM Sans, sans-serif" font-size="11" font-weight="600" fill="rgba(255,255,255,0.85)" text-anchor="middle">
                    <tspan x="100">Buku</tspan>
                </text>
                <text x="100" y="265" font-family="DM Sans, sans-serif" font-size="8" font-weight="400" fill="rgba(255,255,255,0.6)" text-anchor="middle">
                    <tspan x="100">ID: {$bookId}</tspan>
                </text>
            </svg>
        SVG;
    }
}
