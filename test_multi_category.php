<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Support\Facades\Validator;

echo "--- 1. TESTING MULTI-CATEGORY REQUEST PREPARATION & VALIDATION ---\n";

$req = BlogRequest::create('/sortiqadmin/blogs', 'POST', [
    'title' => 'Test Multi Category Blog',
    'content' => '<p>Some high quality content here.</p>',
    'status' => 'published',
    'published_at' => '2026-11-04',
    'categories' => ['Web Design', 'Development', 'Technology'],
]);

// Call prepareForValidation via reflection
$prepMethod = new ReflectionMethod(BlogRequest::class, 'prepareForValidation');
$prepMethod->setAccessible(true);
$prepMethod->invoke($req);

echo "Normalized category string: " . $req->input('category') . "\n";
assert($req->input('category') === 'Web Design, Development, Technology', "Category string must be merged");
assert($req->input('categories') === ['Web Design', 'Development', 'Technology'], "Categories array must be preserved");

$v = Validator::make($req->all(), $req->rules());
assert(!$v->fails(), "Validator must pass: " . json_encode($v->errors()->all()));
echo "VALIDATION TEST: PASSED!\n\n";

echo "--- 2. TESTING BLOG MODEL ACCESSORS ---\n";

$dummyBlog = new Blog([
    'title' => 'Multi Category Test Post',
    'slug' => 'multi-category-test-post',
    'category' => 'Web Design, Development',
    'content' => 'Sample content',
    'status' => 'published',
    'published_at' => now(),
]);

$cats = $dummyBlog->categories_list;
echo "Categories list: " . json_encode($cats) . "\n";
assert($cats === ['Web Design', 'Development'], "categories_list accessor must return array");
assert($dummyBlog->hasCategory('Web Design'), "Must have Web Design");
assert($dummyBlog->hasCategory('Development'), "Must have Development");
assert(!$dummyBlog->hasCategory('News'), "Must not have News");
echo "MODEL ACCESSOR TEST: PASSED!\n\n";

echo "--- 3. TESTING ADMIN FORM RENDERING ---\n";

\Illuminate\Support\Facades\View::share('errors', new \Illuminate\Support\ViewErrorBag());

$formHtml = view('admin.blogs.partials.form', [
    'action' => '/test-store',
    'method' => 'POST',
    'blog' => $dummyBlog,
    'permalink' => 'https://sortiqsolutions.com/test',
    'submitLabel' => 'Publish',
    'categories' => ['Company', 'Web Design', 'Development', 'Digital Marketing', 'Technology', 'News'],
])->render();

assert(str_contains($formHtml, 'multiCatContainer'), "Must contain multiCatContainer");
assert(str_contains($formHtml, 'multiCatTrigger'), "Must contain multiCatTrigger");
assert(str_contains($formHtml, 'multiCatDropdown'), "Must contain multiCatDropdown");
assert(str_contains($formHtml, 'multiCategoryHiddenInput'), "Must contain multiCategoryHiddenInput");
assert(str_contains($formHtml, 'multi-cat-checkbox'), "Must contain multi-cat-checkbox");
assert(str_contains($formHtml, 'Web Design'), "Must contain Web Design");
assert(str_contains($formHtml, 'Development'), "Must contain Development");
echo "ADMIN FORM RENDERING: PASSED!\n\n";

echo "--- 4. TESTING FRONTEND VIEWS RENDERING ---\n";

$showHtml = view('frontend.blog.show', [
    'blog' => $dummyBlog,
    'categories' => collect([
        (object) ['name' => 'Web Design', 'slug' => 'web-design', 'total' => 5],
        (object) ['name' => 'Development', 'slug' => 'development', 'total' => 8],
    ]),
    'recentBlogs' => collect([$dummyBlog]),
    'previousPost' => null,
    'nextPost' => null,
])->render();

assert(str_contains($showHtml, 'Web Design'), "Show view must contain Web Design");
assert(str_contains($showHtml, 'Development'), "Show view must contain Development");
echo "FRONTEND VIEWS RENDERING: PASSED!\n\n";

echo "ALL MULTI-CATEGORY TESTS PASSED SUCCESSFULLY!\n";
