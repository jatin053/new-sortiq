<?php

namespace App\Support\Seo;

use App\Models\Blog;
use Illuminate\Support\Str;

class Schema
{
    /**
     * Render the JSON-LD script tag with full schema graph.
     */
    public static function render(?string $routeName = null, ?string $path = null): string
    {
        $data = self::generate($routeName, $path);

        $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return "<script type=\"application/ld+json\">\n" . $json . "\n</script>";
    }

    /**
     * Generate the complete Schema.org @graph array.
     */
    public static function generate(?string $routeName = null, ?string $path = null): array
    {
        $baseUrl = rtrim(url('/'), '/');
        $currentUrl = url()->current();
        $logoUrl = asset('frontend-assets/media/final-logo.webp');
        $altLogoUrl = asset('frontend-assets/media/admin-use.png');

        $isHome = ($routeName === 'frontend.home') || empty(trim((string) $path, '/')) || $currentUrl === $baseUrl || $currentUrl === $baseUrl . '/';

        $graph = [];

        // 1. Organization Schema
        $graph[] = [
            '@type' => 'Organization',
            '@id' => $baseUrl . '/#organization',
            'name' => 'Sortiq Solutions Pvt. Ltd.',
            'alternateName' => 'Sortiq Solutions',
            'url' => $baseUrl . '/',
            'logo' => [
                '@type' => 'ImageObject',
                '@id' => $baseUrl . '/#logo',
                'url' => $logoUrl,
                'contentUrl' => $logoUrl,
                'caption' => 'Sortiq Solutions Logo',
            ],
            'image' => $altLogoUrl,
            'description' => 'Sortiq Solutions delivers high-performance web development, mobile applications, digital marketing, and IT consulting services.',
            'telephone' => '+91 9646522110',
            'email' => 'info@sortiqsolutions.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'E-51, Second Floor, Phase - 8, Industrial Area',
                'addressLocality' => 'S.A.S. Nagar, Mohali',
                'addressRegion' => 'Punjab',
                'postalCode' => '160071',
                'addressCountry' => 'IN',
            ],
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'telephone' => '+91 9646522110',
                    'contactType' => 'customer service',
                    'areaServed' => ['IN', 'US', 'GB', 'CA', 'AU'],
                    'availableLanguage' => ['English', 'Hindi', 'Punjabi'],
                ],
            ],
            'sameAs' => [
                'https://www.facebook.com/SortiqSolutions/',
                'https://x.com/SortiqSolutions',
                'https://www.linkedin.com/company/sortiq-solutions/',
                'https://www.instagram.com/sortiqsolutions/',
                'https://www.youtube.com/@SortiqSolutions',
                'https://in.pinterest.com/sortiqsolutions/',
                'https://medium.com/@sortiqsolutions',
                'https://www.goodfirms.co/company/sortiq-solutions',
                'https://www.upwork.com/ag/sortiqsolutions/',
                'https://wa.me/919646522110',
            ],
        ];

        // 2. LocalBusiness / ProfessionalService Schema
        $graph[] = [
            '@type' => ['LocalBusiness', 'ProfessionalService'],
            '@id' => $baseUrl . '/#localbusiness',
            'name' => 'Sortiq Solutions',
            'url' => $baseUrl . '/',
            'logo' => $logoUrl,
            'image' => $altLogoUrl,
            'telephone' => '+91 9646522110',
            'email' => 'info@sortiqsolutions.com',
            'priceRange' => '$$',
            'currenciesAccepted' => 'INR, USD, EUR, GBP, CAD, AUD',
            'paymentAccepted' => 'Cash, Credit Card, Bank Transfer, PayPal',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'E-51, Second Floor, Phase - 8, Industrial Area',
                'addressLocality' => 'S.A.S. Nagar, Mohali',
                'addressRegion' => 'Punjab',
                'postalCode' => '160071',
                'addressCountry' => 'IN',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 30.7046,
                'longitude' => 76.7179,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '09:30',
                    'closes' => '18:30',
                ],
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => '128',
                'bestRating' => '5',
                'worstRating' => '1',
            ],
            'areaServed' => [
                'Worldwide',
                'India',
                'United States',
                'United Kingdom',
                'Canada',
                'Australia',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Digital & IT Services',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Website Development Company',
                            'description' => 'Custom, responsive website development using Laravel, PHP, WordPress, React, and Node.js.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Website & UI/UX Designing Company',
                            'description' => 'Modern, mobile-responsive, conversion-optimized UI/UX web design.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Mobile Application Development Company',
                            'description' => 'Native and cross-platform Android and iOS mobile application development.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Digital Marketing & SEO Company',
                            'description' => 'Data-driven SEO, SMO, and digital marketing strategies to boost online rankings and business growth.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'eCommerce Development Company',
                            'description' => 'Scalable eCommerce store development on Shopify, WooCommerce, BigCommerce, and custom solutions.',
                        ],
                    ],
                ],
            ],
        ];

        // 3. WebSite Schema (with Sitelinks Searchbox)
        $graph[] = [
            '@type' => 'WebSite',
            '@id' => $baseUrl . '/#website',
            'url' => $baseUrl . '/',
            'name' => 'Sortiq Solutions',
            'description' => 'Sortiq Solutions delivers high-performance web development, mobile applications, digital marketing, and IT consulting services.',
            'publisher' => [
                '@id' => $baseUrl . '/#organization',
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $baseUrl . '/blog?search={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
            'inLanguage' => 'en-US',
        ];

        // 4. WebPage Schema
        $graph[] = [
            '@type' => 'WebPage',
            '@id' => $currentUrl . '#webpage',
            'url' => $currentUrl,
            'name' => $isHome ? 'Sortiq Solutions Pvt. Ltd.' : trim((string) PageMeta::titleForRoute($routeName, $path)),
            'isPartOf' => [
                '@id' => $baseUrl . '/#website',
            ],
            'about' => [
                '@id' => $baseUrl . '/#organization',
            ],
            'description' => trim((string) PageMeta::descriptionForRoute($routeName, $path)),
            'breadcrumb' => [
                '@id' => $currentUrl . '#breadcrumb',
            ],
            'inLanguage' => 'en-US',
        ];

        // 5. BreadcrumbList Schema
        $breadcrumbs = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $baseUrl . '/',
            ],
        ];

        if (! $isHome) {
            $pageTitle = trim((string) PageMeta::titleForRoute($routeName, $path)) ?: 'Page';
            // Strip brand suffix for clean breadcrumb name
            $cleanCrumbName = trim(explode('|', $pageTitle)[0]);
            $cleanCrumbName = trim(explode('-', $cleanCrumbName)[0]);

            $breadcrumbs[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $cleanCrumbName ?: 'Page',
                'item' => $currentUrl,
            ];
        }

        $graph[] = [
            '@type' => 'BreadcrumbList',
            '@id' => $currentUrl . '#breadcrumb',
            'itemListElement' => $breadcrumbs,
        ];

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }
}
