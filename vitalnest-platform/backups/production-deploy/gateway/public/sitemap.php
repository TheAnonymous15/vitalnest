<?php
/**
 * VitalNest - Dynamic Sitemap Generator
 * Generates XML sitemap for search engines
 */

header('Content-Type: application/xml; charset=UTF-8');

// Get the site URL from config or default
$siteUrl = defined('SITE_URL') ? SITE_URL : 'https://vitalnest.co.ke';

// Define site pages with their properties
$pages = [
    [
        'url' => '/',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'daily',
        'priority' => '1.0'
    ],
    [
        'url' => '/services',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'url' => '/packages',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'url' => '/about',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => '0.8'
    ],
    [
        'url' => '/contact',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => '0.8'
    ],
    [
        'url' => '/privacy-policy',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'yearly',
        'priority' => '0.3'
    ],
    [
        'url' => '/terms-of-service',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'yearly',
        'priority' => '0.3'
    ],
    [
        'url' => '/cookie-policy',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'yearly',
        'priority' => '0.3'
    ]
];

// Generate XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($pages as $page) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($siteUrl . $page['url']) . "</loc>\n";
    echo "    <lastmod>" . $page['lastmod'] . "</lastmod>\n";
    echo "    <changefreq>" . $page['changefreq'] . "</changefreq>\n";
    echo "    <priority>" . $page['priority'] . "</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';

