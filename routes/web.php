<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FresherHiringController as AdminFresherHiringController;
use App\Http\Controllers\Admin\InternshipApplicationController as AdminInternshipApplicationController;
use App\Http\Controllers\Admin\PageMetaController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RobotsSettingController;
use App\Http\Controllers\Admin\SiteLayoutSettingController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\ClientController as FrontendClientController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PortfolioController as FrontendPortfolioController;
use App\Http\Controllers\Frontend\ReviewController as FrontendReviewController;
use App\Http\Controllers\Frontend\VideoController as FrontendVideoController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// System & Utilities
Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend.home');
Route::get('/robots.txt', RobotsController::class)->name('robots');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/sitemap_index.xml', SitemapController::class);
Route::get('/sortiqsolution', [FrontendHomeController::class, 'index']);
Route::get('/llms.txt', function () {
    $path = public_path('llms.txt');
    return file_exists($path)
        ? response(file_get_contents($path), 200)->header('Content-Type', 'text/plain; charset=UTF-8')
        : abort(404);
})->name('llms');

// Company Pages
Route::view('/about-us', 'frontend.pages.about')->name('frontend.about');
Route::view('/about', 'frontend.pages.about');

Route::view('/products', 'frontend.pages.products')->name('frontend.products');
Route::redirect('/our-products', '/products', 301);

Route::view('/why-choose-us', 'frontend.pages.why-us')->name('frontend.why-us');
Route::view('/why-us', 'frontend.pages.why-us');

Route::view('/our-career', 'frontend.pages.careers')->name('frontend.careers');
Route::view('/careers', 'frontend.pages.careers');
Route::view('/career', 'frontend.pages.careers');

Route::view('/our-expertise', 'frontend.pages.expertise')->name('frontend.expertise');
Route::view('/expertise', 'frontend.pages.expertise');

Route::view('/case-studies', 'frontend.pages.case-studies')->name('frontend.cases');
Route::view('/cases', 'frontend.pages.case-studies');

Route::get('/best-it-internship-company-mohali-chandigarh', [\App\Http\Controllers\Frontend\InternshipController::class, 'landing'])->name('frontend.best-it-internship');
Route::get('/it-internship', fn () => redirect()->route('frontend.best-it-internship', [], 301));
Route::get('/best-it-internship', fn () => redirect()->route('frontend.best-it-internship', [], 301));
Route::view('/internship', 'frontend.pages.internship')->name('frontend.internship');

Route::view('/faq', 'frontend.pages.faq')->name('frontend.faq');
Route::view('/faqs', 'frontend.pages.faq');

Route::view('/support', 'frontend.pages.support')->name('frontend.support');

Route::view('/terms', 'frontend.pages.terms')->name('frontend.terms');
Route::view('/terms-and-conditions', 'frontend.pages.terms');

Route::view('/privacy-policy', 'frontend.pages.privacy-policy')->name('frontend.privacy-policy');
Route::view('/privacy', 'frontend.pages.privacy-policy');

Route::view('/contact', 'frontend.pages.contact')->name('frontend.contact');
Route::view('/contact-us', 'frontend.pages.contact');
Route::get('/ads-landing-page', [\App\Http\Controllers\Frontend\AdsLandingController::class, 'show'])->name('frontend.ads-landing-page');
Route::post('/ads-landing-page/submit', [\App\Http\Controllers\Frontend\AdsLandingController::class, 'submit'])->name('frontend.ads-landing-page.submit');

// Service Pages (Direct Canonical and Alias Routes)
Route::view('/website-development-services', 'frontend.services.web')->name('frontend.services.web');

Route::view('/website-design-services', 'frontend.services.design')->name('frontend.services.design');

Route::view('/laravel-development-services', 'frontend.services.laravel')->name('frontend.services.laravel');

Route::view('/wordpress-development-services', 'frontend.services.wordpress')->name('frontend.services.wordpress');

Route::view('/ecommerce-development-services', 'frontend.services.ecommerce')->name('frontend.services.ecommerce');

Route::view('/digital-marketing', 'frontend.services.marketing')->name('frontend.services.marketing');

Route::view('/seo-services', 'frontend.services.seo')->name('frontend.services.seo');

Route::view('/smo-services', 'frontend.services.smo')->name('frontend.services.smo');

Route::view('/graphic-design-services', 'frontend.services.graphics')->name('frontend.services.graphics');

Route::view('/banner-design-services', 'frontend.services.banners')->name('frontend.services.banners');

Route::view('/logo-design-services', 'frontend.services.logos')->name('frontend.services.logos');

Route::view('/website-maintenance-services', 'frontend.services.maintenance')->name('frontend.services.maintenance');

Route::view('/bigcommerce-development-company', 'frontend.services.bigcommerce')->name('frontend.services.bigcommerce');
Route::view('/big-commerce', 'frontend.services.bigcommerce')->name('frontend.services.bigcommerce');
Route::view('/services/bigcommerce-development', 'frontend.services.bigcommerce');
Route::view('/services/bigcommerce', 'frontend.services.bigcommerce');

Route::view('/mern-stack-development-company', 'frontend.services.mern')->name('frontend.services.mern');
Route::view('/services/mern-stack-development', 'frontend.services.mern');
Route::view('/services/mern', 'frontend.services.mern');

Route::view('/app-development-company', 'frontend.services.apps')->name('frontend.services.apps');
Route::view('/services/app-development', 'frontend.services.apps');
Route::view('/services/apps', 'frontend.services.apps');

Route::view('/software-testing-company', 'frontend.services.testing')->name('frontend.services.testing');
Route::view('/services/software-testing', 'frontend.services.testing');
Route::view('/services/testing', 'frontend.services.testing');

Route::view('/cyber-security-development', 'frontend.services.security')->name('frontend.services.security');
Route::view('/services/cyber-security', 'frontend.services.security');
Route::view('/services/security', 'frontend.services.security');

Route::view('/hubspot-crm-services', 'frontend.services.hubspot')->name('frontend.services.hubspot');
Route::view('/services/hubspot-crm', 'frontend.services.hubspot');
Route::view('/services/hubspot', 'frontend.services.hubspot');

Route::view('/zoho', 'frontend.services.zoho')->name('frontend.services.zoho');
Route::redirect('/zoho-crm-services', '/zoho', 301);
Route::redirect('/services/zoho-crm', '/zoho', 301);
Route::redirect('/services/zoho', '/zoho', 301);

Route::view('/php-development-company', 'frontend.services.php')->name('frontend.services.php');
Route::view('/services/php-development', 'frontend.services.php');
Route::view('/services/php', 'frontend.services.php');

Route::view('/codeigniter-development-company', 'frontend.services.codeigniter')->name('frontend.services.codeigniter');
Route::view('/services/codeigniter-development', 'frontend.services.codeigniter');
Route::view('/services/codeigniter', 'frontend.services.codeigniter');

Route::view('/shopify-development-company', 'frontend.services.shopify')->name('frontend.services.shopify');
Route::view('/services/shopify-development', 'frontend.services.shopify');
Route::view('/services/shopify', 'frontend.services.shopify');

Route::view('/react-js-development-company', 'frontend.services.react')->name('frontend.services.react');
Route::view('/services/react-js-development', 'frontend.services.react');
Route::view('/services/react-development', 'frontend.services.react');
Route::view('/services/react', 'frontend.services.react');

Route::view('/node-js-development-company', 'frontend.services.node')->name('frontend.services.node');
Route::view('/services/node-js-development', 'frontend.services.node');
Route::view('/services/node-development', 'frontend.services.node');
Route::view('/services/node', 'frontend.services.node');

Route::view('/vue-js-development-company', 'frontend.services.vue')->name('frontend.services.vue');
Route::view('/services/vue-js-development', 'frontend.services.vue');
Route::view('/services/vue-development', 'frontend.services.vue');
Route::view('/services/vue', 'frontend.services.vue');

Route::view('/data-science-development', 'frontend.services.data-science')->name('frontend.services.data-science');
Route::view('/services/data-science-development', 'frontend.services.data-science');
Route::view('/services/data-science', 'frontend.services.data-science');

Route::view('/next-js-development', 'frontend.services.next')->name('frontend.services.next');
Route::view('/services/next-js-development', 'frontend.services.next');

// Dynamic Controller Pages
Route::get('/reviews', [FrontendReviewController::class, 'index'])->name('frontend.reviews');
Route::get('/reviews/{slug}', [FrontendReviewController::class, 'index'])->name('frontend.reviews.show');
Route::get('/reviews-old', [FrontendReviewController::class, 'index']);
Route::get('/reviews-latest', [FrontendReviewController::class, 'index']);
Route::get('/reviews-latest/{slug}', [FrontendReviewController::class, 'index']);

Route::get('/clients', [FrontendClientController::class, 'index'])->name('frontend.clients');
Route::get('/clients/page/{page}', [FrontendClientController::class, 'index'])->whereNumber('page')->name('frontend.clients.page');

Route::get('/videos', [FrontendVideoController::class, 'index'])->name('frontend.videos');
Route::get('/our_videos', [FrontendVideoController::class, 'index']);
Route::get('/our_videos/{slug}', [FrontendVideoController::class, 'index']);

Route::get('/portfolios', [FrontendPortfolioController::class, 'index'])->name('frontend.portfolio');
Route::get('/portfolios/{slug}', [FrontendPortfolioController::class, 'index']);
Route::get('/portfolio', [FrontendPortfolioController::class, 'index']);
Route::get('/portfolio/{slug}', [FrontendPortfolioController::class, 'index']);

Route::get('/blog', [FrontendBlogController::class, 'index'])->name('frontend.blog.index');
Route::redirect('/blogs', '/blog', 301);
Route::prefix('blog')->name('frontend.blog.')->group(function () {
    Route::get('/feed.json', [FrontendBlogController::class, 'feed'])->name('feed');
    Route::get('/{slug}', [FrontendBlogController::class, 'show'])->name('subshow');
});



// Case Study & Client Logo Direct Routes
Route::view('/case-study', 'frontend.pages.case-studies');
Route::view('/case-study/{slug}', 'frontend.pages.case-studies');
Route::get('/clients_logo', [FrontendClientController::class, 'index']);
Route::get('/clients_logo/{slug}', [FrontendClientController::class, 'index']);

// Miscellaneous URLs
Route::get('/best-it-company-in-chandigarh', [\App\Http\Controllers\Frontend\ItCompanyController::class, 'show'])->name('frontend.best-it-company-chandigarh');
Route::get('/best-it-company-in-mohali', [\App\Http\Controllers\Frontend\ItCompanyController::class, 'mohali'])->name('frontend.best-it-company-mohali');
Route::get('/slider-test', [FrontendHomeController::class, 'index']);
Route::get('/certificate-authenticate', [\App\Http\Controllers\Frontend\CertificateController::class, 'show'])->name('frontend.certificate-authenticate');
Route::get('/certificate-verify', fn () => redirect()->route('frontend.certificate-authenticate', [], 301));
Route::post('/certificate-authenticate/check', [\App\Http\Controllers\Frontend\CertificateController::class, 'check'])->name('frontend.certificate-authenticate.check');

// Admin Panel Routes
Route::get('/admin', fn () => redirect()->to('/sortiqadmin'));

$registerAdminResourceRoutes = function (string $prefix, string $name, string $controller, string $parameter): void {
    Route::prefix($prefix)
        ->name("{$name}.")
        ->controller($controller)
        ->group(function () use ($parameter) {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get("/{{$parameter}}", 'show')->name('show');
            Route::get("/{{$parameter}}/edit", 'edit')->name('edit');
            Route::put("/{{$parameter}}", 'update')->name('update');
            Route::delete("/{{$parameter}}", 'destroy')->name('destroy');
        });
};

Route::prefix('sortiqadmin')->name('admin.')->group(function () use ($registerAdminResourceRoutes) {
    Route::middleware('admin.guest')->controller(AuthController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('authenticate');
    });

    Route::middleware('admin.auth')->group(function () use ($registerAdminResourceRoutes) {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

        // Site Layout Settings
        Route::controller(SiteLayoutSettingController::class)->group(function () {
            Route::get('/site-layout', 'edit')->name('site-layout.edit');
            Route::put('/site-layout', 'update')->name('site-layout.update');
        });
        Route::get('/site-layout/custom-js-css', [SiteLayoutSettingController::class, 'editCustomCode'])->name('site-layout.custom-code.edit');
        Route::put('/site-layout/custom-js-css', [SiteLayoutSettingController::class, 'updateCustomCode'])->name('site-layout.custom-code.update');

        // Robots & Sitemap Settings
        Route::controller(RobotsSettingController::class)->group(function () {
            Route::get('/robots-settings', 'edit')->name('robots-settings.edit');
            Route::put('/robots-settings', 'update')->name('robots-settings.update');
            Route::post('/robots-settings/reset', 'reset')->name('robots-settings.reset');
        });
        Route::get('/robots-settings/sitemap', [PageMetaController::class, 'sitemap'])->name('robots-settings.sitemap');

        // Page SEO & Custom Pages
        Route::controller(PageMetaController::class)->group(function () {
            Route::get('/pages', 'edit')->name('pages.edit');
            Route::put('/pages', 'update')->name('pages.update');
            Route::post('/pages/toggle-sitemap', 'toggleSitemap')->name('pages.toggle-sitemap');
            Route::post('/pages/toggle-sitemap-url', 'toggleSitemapUrl')->name('pages.toggle-sitemap-url');

            Route::get('/site-pages', 'index')->name('site-pages.index');
            Route::get('/site-pages/create', 'create')->name('site-pages.create');
            Route::post('/site-pages', 'store')->name('site-pages.store');
            Route::post('/site-pages/toggle-status', 'toggleStatus')->name('site-pages.toggle-status');
            Route::post('/site-pages/update-slug', 'updateSlug')->name('site-pages.update-slug');
            Route::delete('/site-pages/delete', 'deletePage')->name('site-pages.delete');
        });

        // Blog Management
        Route::get('/blogs/categories', [BlogController::class, 'categories'])->name('blogs.categories');
        Route::post('/blogs/categories', [BlogController::class, 'storeCategory'])->name('blogs.categories.store');
        Route::put('/blogs/categories', [BlogController::class, 'updateCategory'])->name('blogs.categories.update');
        Route::delete('/blogs/categories', [BlogController::class, 'destroyCategory'])->name('blogs.categories.destroy');
        Route::post('/blogs/bulk-action', [BlogController::class, 'bulkAction'])->name('blogs.bulk-action');
        Route::get('/blogs/tags', [BlogController::class, 'tags'])->name('blogs.tags');
        Route::post('/blogs/tags', [BlogController::class, 'storeTag'])->name('blogs.tags.store');
        Route::put('/blogs/tags', [BlogController::class, 'updateTag'])->name('blogs.tags.update');
        Route::delete('/blogs/tags', [BlogController::class, 'destroyTag'])->name('blogs.tags.destroy');
        $registerAdminResourceRoutes('blogs', 'blogs', BlogController::class, 'blog');
        Route::post('/blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggle-status');
        Route::post('/blogs/{blog}/update-slug', [BlogController::class, 'updateSlug'])->name('blogs.update-slug');
        Route::delete('/blogs/{blog}/delete-image', [BlogController::class, 'deleteImage'])->name('blogs.delete-image');

        // Portfolio Management
        Route::get('/portfolios/categories', [AdminPortfolioController::class, 'categories'])->name('portfolios.categories');
        Route::post('/portfolios/categories', [AdminPortfolioController::class, 'storeCategory'])->name('portfolios.categories.store');
        Route::put('/portfolios/categories', [AdminPortfolioController::class, 'updateCategory'])->name('portfolios.categories.update');
        Route::delete('/portfolios/categories', [AdminPortfolioController::class, 'destroyCategory'])->name('portfolios.categories.destroy');
        Route::post('/portfolios/bulk-action', [AdminPortfolioController::class, 'bulkAction'])->name('portfolios.bulk-action');
        Route::get('/portfolios/tags', [AdminPortfolioController::class, 'tags'])->name('portfolios.tags');
        Route::post('/portfolios/tags', [AdminPortfolioController::class, 'storeTag'])->name('portfolios.tags.store');
        Route::put('/portfolios/tags', [AdminPortfolioController::class, 'updateTag'])->name('portfolios.tags.update');
        Route::delete('/portfolios/tags', [AdminPortfolioController::class, 'destroyTag'])->name('portfolios.tags.destroy');
        $registerAdminResourceRoutes('portfolios', 'portfolios', AdminPortfolioController::class, 'portfolio');
        Route::post('/portfolios/{portfolio}/toggle-status', [AdminPortfolioController::class, 'toggleStatus'])->name('portfolios.toggle-status');

        // Videos Management
        $registerAdminResourceRoutes('videos', 'videos', AdminVideoController::class, 'video');
        Route::post('/videos/{video}/toggle-status', [AdminVideoController::class, 'toggleStatus'])->name('videos.toggle-status');
        Route::post('/videos/bulk-action', [AdminVideoController::class, 'bulkAction'])->name('videos.bulk-action');

        // Client Logos Management
        $registerAdminResourceRoutes('client-logos', 'client-logos', ClientLogoController::class, 'clientLogo');
        Route::post('/client-logos/{clientLogo}/toggle-status', [ClientLogoController::class, 'toggleStatus'])->name('client-logos.toggle-status');

        // Reviews Management
        $registerAdminResourceRoutes('reviews', 'reviews', ReviewController::class, 'review');
        Route::post('/reviews/{review}/toggle-status', [ReviewController::class, 'toggleStatus'])->name('reviews.toggle-status');

        // Contact Messages
        Route::prefix('contact-messages')
            ->name('contact-messages.')
            ->controller(AdminContactMessageController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{contactMessage}', 'show')->name('show');
                Route::get('/{contactMessage}/download', 'downloadAttachment')->name('download');
            });

        // Fresher Hiring
        Route::prefix('fresher-hirings')
            ->name('fresher-hirings.')
            ->controller(AdminFresherHiringController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{fresherHiring}', 'show')->name('show');
                Route::get('/{fresherHiring}/download', 'downloadAttachment')->name('download');
                Route::patch('/{fresherHiring}/status', 'updateStatus')->name('update-status');
            });

        // Internship Applications
        Route::prefix('internship-applications')
            ->name('internship-applications.')
            ->controller(AdminInternshipApplicationController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{internshipApplication}', 'show')->name('show');
                Route::patch('/{internshipApplication}/status', 'updateStatus')->name('update-status');
            });
    });
});

// Dynamic Live Blog Slug Resolver (Allows all WordPress-style root slugs to load seamlessly)
Route::get('/{slug}', [FrontendBlogController::class, 'show'])
    ->where('slug', '^[a-zA-Z0-9_-]+$')
    ->name('frontend.blog.show');
