<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteLayoutSetting extends Model
{
    const MAIN_KEY = 'main';

    protected $fillable = [
        'key',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public static function main(): self
    {
        return self::query()->firstOrCreate(
            ['key' => self::MAIN_KEY],
            ['data' => self::defaults()]
        );
    }

    public static function defaults(): array
    {
        return [
            'custom_code' => [
                'head' => '',
                'body' => '',
            ],

            'header' => [
                'logo' => '',
                'logo_text' => 'Sortiq Solutions',
                'phone' => '+91 964522110',
                'email' => 'info@sortiqsolutions.com',
                'apply_label' => 'Apply Internship',
                'apply_url' => '#',
            ],

            'nav_links' => [
                ['label' => 'Home', 'url' => '/', 'has_dropdown' => '0'],
                ['label' => 'About Us', 'url' => '/about-us', 'has_dropdown' => '1'],
                ['label' => 'Services', 'url' => '/services', 'has_dropdown' => '1'],
                ['label' => 'Our Work', 'url' => '/our-work', 'has_dropdown' => '1'],
                ['label' => 'Blog', 'url' => '/blog', 'has_dropdown' => '0'],
                ['label' => 'Contact Us', 'url' => '/contact-us', 'has_dropdown' => '0'],
            ],

            'footer_badges' => [
                ['label' => 'Goodfirms', 'image' => ''],
                ['label' => 'Top Rated', 'image' => ''],
                ['label' => 'Upwork', 'image' => ''],
                ['label' => 'Wix Partner', 'image' => ''],
                ['label' => 'ISO 9001', 'image' => ''],
            ],

            'footer' => [
                'address' => 'E-51, Second Floor, Phase - 8, Industrial Area, S.A.S. Nagar, Mohali, Punjab 160071',
                'phone' => '+91 9646522110',
                'email' => 'sortiqsolutions@gmail.com',
                'certificate_text' => "Verify your certificate's authenticity now.",
                'certificate_button_label' => 'Verify Now',
                'certificate_url' => '#',
                'chat_label' => 'Chat with us',
                'chat_url' => '#',
            ],

            'footer_columns' => [
                'company' => [
                    'title' => 'Our Company',
                    'links' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'About Us', 'url' => '/about-us'],
                        ['label' => 'Why Choose Us', 'url' => '/why-choose-us'],
                        ['label' => 'Terms', 'url' => '/terms'],
                        ['label' => 'Portfolio', 'url' => '/portfolios'],
                        ['label' => 'Our Career', 'url' => '/career'],
                        ['label' => 'Our Clients', 'url' => '/clients'],
                        ['label' => 'Blog', 'url' => '/blog'],
                        ['label' => 'Contact Sortiq Solutions', 'url' => '/contact-us'],
                        ['label' => 'FAQ', 'url' => '/faq'],
                    ],
                ],

                'services' => [
                    'title' => 'Our Services',
                    'links' => [
                        ['label' => 'Web Designing', 'url' => '/services/web-designing'],
                        ['label' => 'Web Development', 'url' => '/services/web-development'],
                        ['label' => 'SEO', 'url' => '/services/seo'],
                        ['label' => 'SMO', 'url' => '/services/smo'],
                        ['label' => 'Digital Marketing', 'url' => '/services/digital-marketing'],
                        ['label' => 'eCommerce Development', 'url' => '/services/ecommerce-development'],
                        ['label' => 'App Development', 'url' => '/services/app-development'],
                        ['label' => 'Software Testing', 'url' => '/services/software-testing'],
                    ],
                ],

                'solutions' => [
                    'title' => 'Solutions',
                    'links' => [
                        ['label' => 'PHP Development', 'url' => '/solutions/php-development'],
                        ['label' => 'Laravel Development', 'url' => '/solutions/laravel-development'],
                        ['label' => 'CodeIgniter', 'url' => '/solutions/codeigniter'],
                        ['label' => 'Shopify Development', 'url' => '/solutions/shopify-development'],
                        ['label' => 'WordPress Development', 'url' => '/solutions/wordpress-development'],
                        ['label' => 'React JS Development', 'url' => '/solutions/react-js-development'],
                        ['label' => 'Node JS Development', 'url' => '/solutions/node-js-development'],
                        ['label' => 'Vue JS Development', 'url' => '/solutions/vue-js-development'],
                    ],
                ],
            ],
        ];
    }
}
