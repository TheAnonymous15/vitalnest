<?php
/**
 * VitalNest - Robots.txt Generator
 * Dynamically generates robots.txt for search engine crawlers
 */

header('Content-Type: text/plain');

// Get the site URL from config or default
$siteUrl = defined('SITE_URL') ? SITE_URL : 'https://vitalnest.co.ke';

echo "# VitalNest - Robots.txt\n";
echo "# Professional Home Healthcare Services\n\n";

echo "User-agent: *\n";
echo "Allow: /\n\n";

// Disallow admin and sensitive directories
echo "# Disallow sensitive areas\n";
echo "Disallow: /app/\n";
echo "Disallow: /includes/\n";
echo "Disallow: /data/\n";
echo "Disallow: /config.php\n";
echo "Disallow: /*.log$\n";
echo "Disallow: /*.bak$\n\n";

// Allow CSS, JS, and images for proper rendering
echo "# Allow resources for rendering\n";
echo "Allow: /resources/\n";
echo "Allow: /*.css$\n";
echo "Allow: /*.js$\n";
echo "Allow: /*.jpg$\n";
echo "Allow: /*.jpeg$\n";
echo "Allow: /*.png$\n";
echo "Allow: /*.gif$\n";
echo "Allow: /*.svg$\n";
echo "Allow: /*.webp$\n\n";

// Sitemap reference
echo "# Sitemap\n";
echo "Sitemap: {$siteUrl}/sitemap.xml\n";

