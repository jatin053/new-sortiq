<?php

namespace App\Support\Seo;

class SeoPageCatalog
{
    public static function pages(): array
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $dbPages = \App\Models\Page::all();
                if ($dbPages->count() > 0) {
                    $result = [];
                    foreach ($dbPages as $p) {
                        $result[] = [
                            'section' => $p->section,
                            'label' => $p->label,
                            'route_name' => $p->route_name,
                            'url_path' => $p->url_path,
                            'title' => $p->title ?? '',
                            'description' => $p->description ?? '',
                            'keywords' => $p->keywords ?? '',
                            'status' => $p->status ?? 'published',
                            'view_name' => $p->view_name,
                            'social_image' => $p->social_image,
                        ];
                    }
                    return $result;
                }
            }
        } catch (\Throwable $e) {}

        $static = [
            self::page(
                section: 'Company Pages',
                label: 'Home',
                routeName: 'frontend.home',
                title: 'Sortiq Solutions | Web Development, Apps & Digital Marketing',
                description: 'Sortiq Solutions provides web development, mobile app development, digital marketing, and IT services to help businesses grow with reliable digital solutions.',
                keywords: 'web development, mobile apps, digital marketing, IT services, Sortiq Solutions, software development company'
            ),
            self::page(
                section: 'Company Pages',
                label: 'About',
                routeName: 'frontend.about',
                title: 'About Sortiq Solutions | Web, App & Digital Experts',
                description: 'Learn about Sortiq Solutions, our mission, expertise, and client-focused approach to web development, software, and digital growth services.',
                keywords: 'about Sortiq Solutions, IT company, digital agency, web development experts, software agency'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Products',
                routeName: 'frontend.products',
                title: 'Our Products & Digital SaaS Platforms | Sortiq Solutions',
                description: 'Explore Sortiq Solutions enterprise-grade software products, SaaS platforms, ERP systems, and ready-to-deploy digital solutions tailored for high-growth businesses.',
                keywords: 'software products, enterprise ERP, SaaS platforms, ready-to-deploy solutions, Sortiq products, digital products Chandigarh Mohali'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Why Us',
                routeName: 'frontend.why-us',
                title: 'Why Choose Sortiq Solutions | Web & App Development Partner',
                description: 'Learn why businesses choose Sortiq Solutions for web development, app development, digital marketing, and reliable long-term support.',
                keywords: 'why choose Sortiq, best IT company, reliable digital partner, web development partner'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Expertise',
                routeName: 'frontend.expertise',
                title: 'Our Expertise | Web, Apps, Design & Digital Solutions',
                description: 'Discover Sortiq Solutions expertise in web development, digital marketing, mobile apps, design, and scalable IT solutions for modern businesses.',
                keywords: 'IT expertise, web development skills, mobile app experts, scalable digital solutions'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Case Studies',
                routeName: 'frontend.cases',
                title: 'Case Studies | Sortiq Solutions Project Results',
                description: 'Explore Sortiq Solutions case studies to see how our web, app, and digital solutions solve business challenges and support long-term growth.',
                keywords: 'case studies, IT project portfolio, web development success stories, digital solutions results'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Careers',
                routeName: 'frontend.careers',
                title: 'Careers at Sortiq Solutions | Join Our Digital Team',
                description: 'Explore career opportunities at Sortiq Solutions and join our team building websites, software, apps, and digital experiences for growing businesses.',
                keywords: 'IT careers, jobs at Sortiq Solutions, web developer jobs, software engineer positions'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Internship',
                routeName: 'frontend.internship',
                title: 'Internship Opportunities in Chandigarh Mohali | Sortiq Solutions',
                description: 'Start your career with internship opportunities at Sortiq Solutions in Chandigarh Mohali and gain practical experience in digital and IT work.',
                keywords: 'IT internships Chandigarh, web development internship, Sortiq Solutions internship, software training'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Best IT Internship',
                routeName: 'frontend.best-it-internship',
                title: 'Best IT Internship Company in Mohali Chandigarh | Sortiq Solutions',
                description: 'Join Sortiq Solutions Pvt. Ltd. for industry-oriented internship and industrial training programs in Mohali Chandigarh. Gain practical experience through live projects and professional mentorship.',
                keywords: 'Best IT Internship Company in Mohali Chandigarh, IT internship Mohali, internship in Chandigarh, industrial training Mohali, web development internship'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Best IT Company in Chandigarh',
                routeName: 'frontend.best-it-company-chandigarh',
                title: 'Best IT Company in Chandigarh | Sortiq Solutions',
                description: 'At Sortiq Solutions Pvt. Ltd., we offer end-to-end IT solutions that simplify and strengthen your business operations with web development, software solutions, and digital transformation.',
                keywords: 'Best IT Company in Chandigarh, IT Company Chandigarh, software company Chandigarh, web development Chandigarh, IT solutions Mohali'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Best IT Company in Mohali',
                routeName: 'frontend.best-it-company-mohali',
                title: 'Best IT Company in Mohali | Sortiq Solutions',
                description: 'At Sortiq Solutions Pvt. Ltd., we provide comprehensive IT solutions designed to simplify and strengthen your business operations with web development, software development, and digital transformation in Mohali.',
                keywords: 'Best IT Company in Mohali, IT Company Mohali, IT services Mohali, software company Mohali, web development Mohali'
            ),
            self::page(
                section: 'Landing Pages',
                label: 'Ads Landing Page',
                routeName: 'frontend.ads-landing-page',
                title: 'Inquiry | Sortiq Solutions Pvt Ltd',
                description: 'Web Development, Design & Digital Marketing Services - Scalable Digital Solutions for USA, Canada, UK, Australia & Israel',
                keywords: 'Web Development, Design, Digital Marketing, Sortiq Solutions, Scalable Digital Solutions'
            ),
            self::page(
                section: 'Company Pages',
                label: 'FAQ',
                routeName: 'frontend.faq',
                title: 'FAQ | Sortiq Solutions Services & Support',
                description: 'Find answers to common questions about Sortiq Solutions services, project workflows, support, and digital delivery process.',
                keywords: 'FAQ, Sortiq Solutions questions, IT services FAQ, project workflow'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Support',
                routeName: 'frontend.support',
                title: 'Support | Sortiq Solutions Help & Assistance',
                description: 'Get support from Sortiq Solutions for website, software, and digital service questions, updates, and ongoing assistance.',
                keywords: 'IT support, Sortiq Solutions help, website maintenance, software assistance'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Terms',
                routeName: 'frontend.terms',
                title: 'Terms & Service Policies | Sortiq Solutions',
                description: 'Read the terms and service policies for using Sortiq Solutions websites, support, and digital services.',
                keywords: 'terms of service, Sortiq Solutions policies, IT service terms'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Privacy Policy',
                routeName: 'frontend.privacy-policy',
                title: 'Privacy Policy | Sortiq Solutions Pvt. Ltd.',
                description: 'Read the official Privacy Policy of Sortiq Solutions Pvt. Ltd. to learn how we collect, use, and protect your personal and business information.',
                keywords: 'privacy policy, Sortiq Solutions privacy, data protection, security, privacy terms'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Contact',
                routeName: 'frontend.contact',
                title: 'Contact Sortiq Solutions | Start Your Digital Project',
                description: 'Contact Sortiq Solutions for web development, mobile apps, digital marketing, and IT support tailored to your business goals.',
                keywords: 'contact Sortiq Solutions, hire web developers, IT services contact'
            ),

            self::page(
                section: 'Content Pages',
                label: 'Blog',
                routeName: 'frontend.blog.index',
                title: 'IT, Web Design & Digital Marketing Blog | Sortiq Solutions',
                description: 'Read the latest Sortiq Solutions blog posts on web design, development, digital marketing, and practical IT insights for growing businesses.',
                keywords: 'IT blog, web development blog, digital marketing tips, Sortiq Solutions blog'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Portfolio',
                routeName: 'frontend.portfolio',
                title: 'Portfolio | Web Design & Development Work by Sortiq Solutions',
                description: 'Explore Sortiq Solutions portfolio of web design, development, branding, and digital projects built for growing businesses.',
                keywords: 'web design portfolio, digital marketing projects, app development work, Sortiq Solutions portfolio'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Reviews',
                routeName: 'frontend.reviews',
                title: 'Client Reviews & Testimonials | Sortiq Solutions',
                description: 'Read client reviews and testimonials for Sortiq Solutions and see how our digital services support real business growth.',
                keywords: 'client reviews, Sortiq Solutions testimonials, IT company reviews'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Clients',
                routeName: 'frontend.clients',
                title: 'Trusted Clients & Partners | Sortiq Solutions',
                description: 'Explore the trusted client network of Sortiq Solutions and see the brands that rely on our web, software, and digital services.',
                keywords: 'Sortiq Solutions clients, trusted IT partners, brands we work with'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Videos',
                routeName: 'frontend.videos',
                title: 'Videos & IT Insights | Sortiq Solutions',
                description: 'Watch Sortiq Solutions videos on web development, digital marketing, design, and business-focused IT insights.',
                keywords: 'IT insights videos, web development tutorials, digital marketing videos, Sortiq Solutions media'
            ),

            self::page(
                section: 'Service Pages',
                label: 'Web Development',
                routeName: 'frontend.services.web',
                title: 'Website Development Company in Chandigarh | Sortiq Solutions',
                description: 'Website development services from Sortiq Solutions for custom, responsive, and business-focused websites that perform.',
                keywords: 'website development company Chandigarh, custom web development, responsive website design'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Website Design',
                routeName: 'frontend.services.design',
                title: 'Website Designing Company in Chandigarh | Sortiq Solutions',
                description: 'Website designing services from Sortiq Solutions that combine modern UI, strong branding, and user-focused conversion journeys.',
                keywords: 'website designing company Chandigarh, UI UX design, custom web design services'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Laravel',
                routeName: 'frontend.services.laravel',
                title: 'Laravel Development Company in Chandigarh | Sortiq Solutions',
                description: 'Laravel development services from Sortiq Solutions for secure, scalable, and custom web applications built for growth.',
                keywords: 'Laravel development company, custom PHP development, Laravel experts Chandigarh'
            ),
            self::page(
                section: 'Service Pages',
                label: 'WordPress',
                routeName: 'frontend.services.wordpress',
                title: 'WordPress Development Company in Chandigarh | Sortiq Solutions',
                description: 'WordPress development services from Sortiq Solutions for flexible, scalable, and easy-to-manage business websites.',
                keywords: 'WordPress development company, custom WP themes, WordPress experts Chandigarh'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Ecommerce',
                routeName: 'frontend.services.ecommerce',
                title: 'Ecommerce Development Company in Chandigarh | Sortiq Solutions',
                description: 'E-commerce development services from Sortiq Solutions for custom online stores, better shopping experiences, and business growth.',
                keywords: 'ecommerce development company, online store design, custom ecommerce solutions'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Digital Marketing',
                routeName: 'frontend.services.marketing',
                title: 'Digital Marketing Company in Chandigarh | Sortiq Solutions',
                description: 'Digital marketing services from Sortiq Solutions to improve reach, lead generation, conversions, and long-term brand growth.',
                keywords: 'digital marketing company Chandigarh, online marketing services, lead generation agency'
            ),
            self::page(
                section: 'Service Pages',
                label: 'SEO',
                routeName: 'frontend.services.seo',
                title: 'SEO Company in Chandigarh | Sortiq Solutions',
                description: 'SEO services from Sortiq Solutions to improve search visibility, rankings, organic traffic, and long-term digital growth.',
                keywords: 'SEO company Chandigarh, search engine optimization, organic traffic growth, SEO experts'
            ),
            self::page(
                section: 'Service Pages',
                label: 'SMO',
                routeName: 'frontend.services.smo',
                title: 'SMO Services in Chandigarh | Sortiq Solutions',
                description: 'Social media optimization services from Sortiq Solutions to improve visibility, engagement, and brand reach across digital channels.',
                keywords: 'SMO services Chandigarh, social media optimization, brand engagement, social media marketing'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Graphics',
                routeName: 'frontend.services.graphics',
                title: 'Graphic Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Graphic designing services from Sortiq Solutions for brand visuals, marketing creatives, and digital assets that make an impact.',
                keywords: 'graphic designing services, custom branding, marketing creatives, digital asset design'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Banners',
                routeName: 'frontend.services.banners',
                title: 'Banner Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Get banner designing services from Sortiq Solutions for digital campaigns, websites, ads, and brand promotions that stand out.',
                keywords: 'banner designing services, ad creatives, website banners, digital campaign design'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Logos',
                routeName: 'frontend.services.logos',
                title: 'Logo Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Logo designing services from Sortiq Solutions to create memorable brand identities for startups, businesses, and digital products.',
                keywords: 'logo designing services, custom brand identity, business logo design'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Maintenance',
                routeName: 'frontend.services.maintenance',
                title: 'Website Maintenance Services in Chandigarh | Sortiq Solutions',
                description: 'Website maintenance services from Sortiq Solutions for updates, security, performance checks, and reliable ongoing support.',
                keywords: 'website maintenance services, ongoing IT support, security updates, website performance checks'
            ),
            self::page(
                section: 'Service Pages',
                label: 'BigCommerce',
                routeName: 'frontend.services.bigcommerce',
                title: 'BigCommerce Development Services | Sortiq Solutions',
                description: 'BigCommerce development services from Sortiq Solutions to build scalable e-commerce stores with better performance and conversions.',
                keywords: 'BigCommerce development services, custom BigCommerce stores, scalable ecommerce'
            ),
            self::page(
                section: 'Service Pages',
                label: 'MERN Stack',
                routeName: 'frontend.services.mern',
                title: 'MERN Stack Development Services | Sortiq Solutions',
                description: 'MERN stack development services from Sortiq Solutions for modern, high-performance web applications with scalable architecture.',
                keywords: 'MERN stack development, custom React Node applications, high-performance web apps'
            ),
            self::page(
                section: 'Service Pages',
                label: 'App Development',
                routeName: 'frontend.services.apps',
                title: 'Mobile App Development Services | Sortiq Solutions',
                description: 'Build custom mobile and app solutions with Sortiq Solutions to improve user experience, business efficiency, and digital growth.',
                keywords: 'mobile app development services, custom iOS Android apps, business app solutions'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Testing',
                routeName: 'frontend.services.testing',
                title: 'Software Testing Services in Chandigarh | Sortiq Solutions',
                description: 'Software testing services from Sortiq Solutions to improve quality, performance, reliability, and release confidence.',
                keywords: 'software testing services, QA testing, application reliability, performance testing'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Cyber Security',
                routeName: 'frontend.services.security',
                title: 'Cyber Security Services | Sortiq Solutions',
                description: 'Cyber security services from Sortiq Solutions to help protect websites, applications, and business data from modern threats.',
                keywords: 'cyber security services, website protection, data security, application security'
            ),
            self::page(
                section: 'Service Pages',
                label: 'HubSpot',
                routeName: 'frontend.services.hubspot',
                title: 'HubSpot CRM Services | Sortiq Solutions',
                description: 'HubSpot CRM services from Sortiq Solutions to improve lead management, automation, sales workflows, and customer communication.',
                keywords: 'HubSpot CRM services, sales automation, lead management, HubSpot integration'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Zoho',
                routeName: 'frontend.services.zoho',
                title: 'Zoho CRM Services in Chandigarh | Sortiq Solutions',
                description: 'Zoho CRM services from Sortiq Solutions to streamline sales, automation, customer tracking, and business workflows.',
                keywords: 'Zoho CRM services, Zoho automation, customer tracking solutions, Zoho experts'
            ),
            self::page(
                section: 'Service Pages',
                label: 'PHP',
                routeName: 'frontend.services.php',
                title: 'PHP Development Services | Sortiq Solutions',
                description: 'PHP development services from Sortiq Solutions for custom websites, web apps, and reliable business platforms.',
                keywords: 'PHP development services, custom PHP apps, reliable business platforms'
            ),
            self::page(
                section: 'Service Pages',
                label: 'CodeIgniter',
                routeName: 'frontend.services.codeigniter',
                title: 'CodeIgniter Development Services | Sortiq Solutions',
                description: 'CodeIgniter development services from Sortiq Solutions for fast, secure, and scalable web applications tailored to business needs.',
                keywords: 'CodeIgniter development services, custom MVC apps, secure web applications'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Shopify',
                routeName: 'frontend.services.shopify',
                title: 'Shopify Development Services | Sortiq Solutions',
                description: 'Shopify development services from Sortiq Solutions for custom online stores, better conversions, and flexible e-commerce growth.',
                keywords: 'Shopify development services, custom Shopify stores, flexible ecommerce'
            ),
            self::page(
                section: 'Service Pages',
                label: 'React',
                routeName: 'frontend.services.react',
                title: 'React JS Development Services | Sortiq Solutions',
                description: 'React JS development services from Sortiq Solutions for interactive, responsive, and high-performance digital experiences.',
                keywords: 'React JS development services, interactive UI design, high-performance front-end'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Node',
                routeName: 'frontend.services.node',
                title: 'Node.js Development Services | Sortiq Solutions',
                description: 'Node.js development services from Sortiq Solutions for fast, scalable backend systems and web applications.',
                keywords: 'Node.js development services, scalable backend systems, custom APIs'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Vue',
                routeName: 'frontend.services.vue',
                title: 'Vue JS Development Services | Sortiq Solutions',
                description: 'Vue JS development services from Sortiq Solutions for modern interfaces, responsive apps, and scalable front-end experiences.',
                keywords: 'Vue JS development services, modern front-end interfaces, responsive web apps'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Data Science',
                routeName: 'frontend.services.data-science',
                title: 'Data Science Development Services | Sortiq Solutions',
                description: 'Data science development and machine learning services from Sortiq Solutions to drive smart business decisions and automation.',
                keywords: 'Data science development services, machine learning, AI solutions, predictive modeling'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Next.js',
                routeName: 'frontend.services.next',
                title: 'Next.js Development Company | Sortiq Solutions',
                description: 'High-performance Next.js development services from Sortiq Solutions for blazing-fast SSR, SSG, and React web applications.',
                keywords: 'Next.js development services, Next.js company, Server-Side Rendering, static site generation, React web apps'
            ),
        ];

        return array_merge($static, self::customPages());
    }

    public static function customPages(): array
    {
        try {
            $setting = \App\Models\SiteLayoutSetting::where('key', 'main')->first();
            $data = $setting && is_array($setting->data) ? $setting->data : [];
            $customPages = $data['custom_pages'] ?? [];
            $pages = [];

            foreach ($customPages as $routeName => $page) {
                $pages[] = [
                    'section' => $page['section'] ?? 'Custom Pages',
                    'label' => $page['label'] ?? 'Custom Page',
                    'route_name' => $routeName,
                    'title' => $page['title'] ?? '',
                    'description' => $page['description'] ?? '',
                    'keywords' => $page['keywords'] ?? '',
                    'status' => $page['status'] ?? 'published',
                ];
            }

            return $pages;
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function routeNames(): array
    {
        return array_column(self::pages(), 'route_name');
    }

    public static function defaultPathForRoute(string $routeName): string
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $dbPage = \App\Models\Page::where('route_name', $routeName)->first();
                if ($dbPage && !empty($dbPage->url_path)) {
                    return '/' . ltrim($dbPage->url_path, '/');
                }
            }
        } catch (\Throwable $e) {}

        if ($routeName === 'frontend.home') {
            return '/';
        }
        if ($routeName === 'frontend.blog.index') {
            return '/blog';
        }

        $routes = config('frontend-routes');
        if (is_array($routes) && isset($routes['pages']) && is_array($routes['pages'])) {
            foreach ($routes['pages'] as $uri => $view) {
                if ("frontend.{$uri}" === $routeName) {
                    return '/' . $uri;
                }
            }
        }

        if (is_array($routes) && isset($routes['services']) && is_array($routes['services'])) {
            foreach ($routes['services'] as $uri => $viewName) {
                if ("frontend.services.{$viewName}" === $routeName) {
                    return '/' . $uri;
                }
            }
        }

        return '/' . ltrim(str_replace(['frontend.', '.'], ['', '/'], $routeName), '/');
    }

    public static function defaultMetaMap(): array
    {
        $meta = [];

        foreach (self::pages() as $page) {
            $meta[$page['route_name']] = [
                'title' => $page['title'],
                'description' => $page['description'],
                'keywords' => $page['keywords'],
            ];
        }

        return $meta;
    }

    private static function page(
        string $section,
        string $label,
        string $routeName,
        string $title,
        string $description,
        string $keywords = '',
    ): array {
        return [
            'section' => $section,
            'label' => $label,
            'route_name' => $routeName,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }
}
