    <form action="{{ $action }}" method="post" class="blog-form" enctype="multipart/form-data" novalidate>
        @csrf

        @if ($method !== 'POST')
            @method($method)
        @endif

        @php
            $title = old('title', $blog['title']);
            $slug = old('slug', $blog['slug']);
            $content = old('content', $blog['content']);
            $image = old('image', $blog['image']);
            $categoryValue = old('category', $blog['category'] ?? ($blog->category ?? null));
            $selectedCategories = old('categories', $blog->categories_list ?? []);
            if (empty($selectedCategories) && !empty($categoryValue)) {
                $selectedCategories = array_values(array_filter(array_map('trim', explode(',', (string) $categoryValue))));
            }
            if (!is_array($selectedCategories)) {
                $selectedCategories = (array) $selectedCategories;
            }
            $publishedAt = old('published_at', $blog->published_at?->format('Y-m-d'));
            $excerpt = old('excerpt', $blog['excerpt']);
        @endphp

        <div class="review-edit-grid blog-edit-grid">
            <section class="review-editor-main">
                <label class="screen-reader-text" for="blog-title">Blog title</label>
                <input
                    id="blog-title"
                    class="title-input @error('title') is-invalid @enderror"
                    name="title"
                    type="text"
                    value="{{ $title }}"
                    placeholder="Enter blog title"
                >
                @error('title')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <div class="blog-slug-editor-box" style="margin: 12px 0 20px 0; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <!-- VIEW MODE -->
                    <div id="slugViewMode" style="display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
                        <span style="font-weight: 700; color: #1e293b; font-size: 13px; display: inline-flex; align-items: center; gap: 4px;">
                            <iconify-icon icon="lucide:link" width="15" height="15" style="color: #0b63e5;"></iconify-icon>
                            Permalink:
                        </span>
                        <span style="color: #64748b; font-size: 13px; font-family: monospace; font-weight: 500;">{{ url('/') }}/</span>
                        <span id="slugDisplayText" style="font-weight: 700; color: #0b63e5; font-size: 13px; font-family: monospace; background: #e0f2fe; padding: 4px 10px; border-radius: 6px; border: 1px solid #bae6fd;">{{ $slug ?: 'untitled-slug' }}</span>

                        <!-- EDIT BUTTON -->
                        <button type="button" id="btnEditSlug" style="padding: 6px 14px; font-size: 12px; font-weight: 700; background: #ffffff; color: #0b63e5; border: 1px solid #0b63e5; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; transition: all 0.15s ease;">
                            <iconify-icon icon="lucide:edit-2" width="13" height="13"></iconify-icon> Edit
                        </button>

                        @if ($slug)
                            <a id="btnViewLivePost" href="{{ url('/' . $slug) }}" target="_blank" rel="noopener" style="padding: 6px 14px; font-size: 12px; font-weight: 600; background: #ffffff; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <iconify-icon icon="lucide:external-link" width="13" height="13"></iconify-icon> View Page ↗
                            </a>
                        @endif

                        <span id="slugSaveSuccessBadge" style="display: none; font-size: 12px; font-weight: 700; color: #16a34a; background: #dcfce7; border: 1px solid #86efac; padding: 4px 10px; border-radius: 6px;">
                            ✓ Saved!
                        </span>
                    </div>

                    <!-- EDIT MODE (hidden by default until Edit is clicked) -->
                    <div id="slugEditMode" style="display: none; align-items: center; flex-wrap: wrap; gap: 8px;">
                        <span style="font-weight: 700; color: #1e293b; font-size: 13px; display: inline-flex; align-items: center; gap: 4px;">
                            <iconify-icon icon="lucide:link" width="15" height="15" style="color: #0b63e5;"></iconify-icon>
                            Permalink:
                        </span>
                        <span style="color: #64748b; font-size: 13px; font-family: monospace; font-weight: 500;">{{ url('/') }}/</span>

                        <div style="flex: 1; min-width: 240px; max-width: 480px;">
                            <input
                                type="text"
                                id="blog-slug-input"
                                name="slug"
                                value="{{ $slug }}"
                                placeholder="enter-custom-slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                style="width: 100%; padding: 7px 12px; font-size: 13px; font-family: monospace; border: 2px solid #0b63e5; border-radius: 6px; background: #ffffff; color: #0f172a; font-weight: 700; outline: none;"
                            >
                        </div>

                        <!-- SAVE BUTTON -->
                        <button type="button" id="btnSaveSlug" style="padding: 7px 16px; font-size: 12px; font-weight: 700; background: #0b63e5; color: #ffffff; border: 1px solid #0b63e5; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 1px 2px rgba(11,99,229,0.2);">
                            <iconify-icon icon="lucide:check" width="14" height="14"></iconify-icon> Save
                        </button>

                        <!-- CANCEL BUTTON -->
                        <button type="button" id="btnCancelSlug" style="padding: 7px 12px; font-size: 12px; font-weight: 600; background: #ffffff; color: #64748b; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                            Cancel
                        </button>

                        <!-- AUTO FROM TITLE BUTTON -->
                        <button type="button" id="btnAutoSlug" title="Generate clean slug from post title" style="padding: 7px 12px; font-size: 12px; font-weight: 600; background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                            <iconify-icon icon="lucide:sparkles" width="13" height="13" style="color: #d97706;"></iconify-icon> Auto from Title
                        </button>

                        <span id="slugSaveLoadingSpinner" style="display: none; font-size: 12px; font-weight: 600; color: #0b63e5;">
                            Saving slug...
                        </span>
                    </div>

                    <div id="slugAjaxErrorMessage" style="display: none; color: #dc2626; font-size: 12px; margin-top: 6px; font-weight: 600;"></div>

                    @error('slug')
                        <p class="field-error" style="color: #dc2626; font-size: 12px; margin-top: 6px; font-weight: 600;">{{ $message }}</p>
                    @enderror

                    <div style="margin-top: 8px; font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span>Live Page URL:</span>
                        <a id="blogSlugPreviewLink" href="{{ url('/' . ($slug ?: '')) }}" target="_blank" rel="noopener" style="color: #0b63e5; font-weight: 600; text-decoration: underline; font-family: monospace;">
                            {{ url('/' . ($slug ?: 'sample-slug')) }}
                        </a>
                    </div>
                </div>

                <div class="classic-editor" id="blogClassicEditorWrapper">
                    <div class="editor-media" style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 10px 14px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="small-btn" style="background: #00173e; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px; font-size: 11px;">CONTENT</span>
                            <span id="editorActiveModeLabel" style="font-size: 12px; font-weight: 600; color: #0b63e5; background: #e0f2fe; padding: 3px 8px; border-radius: 4px;">Visual Mode (Normal Text)</span>
                        </div>
                        <div class="editor-mode-toggle" style="display: flex; gap: 6px;">
                            <button type="button" id="btnSwitchVisual" class="btn-mode-tab is-active" style="padding: 4px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; border: 1px solid #0b63e5; background: #0b63e5; color: #fff; cursor: pointer;">Visual (Normal)</button>
                            <button type="button" id="btnSwitchHtml" class="btn-mode-tab" style="padding: 4px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; border: 1px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer;">&lt;/&gt; HTML Code</button>
                        </div>
                    </div>

                    <div class="editor-toolbar" id="blogEditorToolbar" style="display: flex; flex-wrap: wrap; gap: 6px; padding: 8px 12px; background: #ffffff; border-bottom: 1px solid #e2e8f0; align-items: center;">
                        <select id="editorFormatSelect" aria-label="Text style" style="padding: 5px 8px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 12px; font-weight: 600; color: #1e293b; background: #fff; cursor: pointer;">
                            <option value="p">Paragraph</option>
                            <option value="h1">Heading 1 (H1)</option>
                            <option value="h2">Heading 2 (H2)</option>
                            <option value="h3">Heading 3 (H3)</option>
                            <option value="h4">Heading 4 (H4)</option>
                            <option value="h5">Heading 5 (H5)</option>
                            <option value="h6">Heading 6 (H6)</option>
                            <option value="blockquote">Quote Block</option>
                        </select>

                        <div style="width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px;"></div>

                        <button type="button" class="ed-btn" data-cmd="bold" title="Bold (Ctrl+B)"><strong>B</strong></button>
                        <button type="button" class="ed-btn" data-cmd="italic" title="Italic (Ctrl+I)"><em>I</em></button>
                        <button type="button" class="ed-btn" data-cmd="underline" title="Underline (Ctrl+U)"><u>U</u></button>
                        <button type="button" class="ed-btn" data-cmd="strikeThrough" title="Strikethrough"><s>S</s></button>

                        <div style="width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px;"></div>

                        <button type="button" class="ed-btn" data-cmd="insertUnorderedList" title="Bullet List">&#8226; List</button>
                        <button type="button" class="ed-btn" data-cmd="insertOrderedList" title="Numbered List">1. List</button>

                        <div style="width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px;"></div>

                        <button type="button" class="ed-btn" data-cmd="justifyLeft" title="Align Left">&#8801;</button>
                        <button type="button" class="ed-btn" data-cmd="justifyCenter" title="Align Center">&#9776;</button>
                        <button type="button" class="ed-btn" data-cmd="justifyRight" title="Align Right">&#8803;</button>

                        <div style="width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px;"></div>

                        <button type="button" id="btnToolbarLink" class="ed-btn ed-btn-link" title="Insert or Edit Link" style="background: #e0f2fe; color: #0b63e5; border-color: #93c5fd; font-weight: 700; padding: 0 10px; width: auto;">
                            &#128279; Link
                        </button>
                        <button type="button" id="btnToolbarUnlink" class="ed-btn" title="Remove Link" style="padding: 0 8px; width: auto;">
                            &#128279;&#10006;
                        </button>
                        <button type="button" id="btnToolbarImage" class="ed-btn" title="Insert Image" style="padding: 0 8px; width: auto;">
                            &#128444; Image
                        </button>
                        <button type="button" id="btnToolbarClean" class="ed-btn" title="Clean ChatGPT tags / Clear Format" style="padding: 0 8px; width: auto; color: #d97706;">
                            &#129529; Clean
                        </button>

                        <div style="width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px;"></div>

                        <button type="button" class="ed-btn" data-cmd="undo" title="Undo (Ctrl+Z)">&#8617;</button>
                        <button type="button" class="ed-btn" data-cmd="redo" title="Redo (Ctrl+Y)">&#8618;</button>
                    </div>

                    {{-- VISUAL RICH TEXT CONTAINER (Normal text, vibrant blue clickable links) --}}
                    <div
                        id="blogVisualEditor"
                        class="blog-visual-editor"
                        contenteditable="true"
                        spellcheck="true"
                        aria-label="Blog Visual Content"
                    >{!! $content !!}</div>

                    {{-- RAW HTML CODE TEXTAREA --}}
                    <textarea
                        id="blogRawContent"
                        class="review-content blog-content @error('content') is-invalid @enderror"
                        name="content"
                        aria-label="Blog raw content"
                        style="display: none; font-family: 'Consolas', 'Monaco', monospace; font-size: 13px; line-height: 1.6; background: #0f172a; color: #f8fafc;"
                    >{{ $content }}</textarea>

                    <div class="editor-footer" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b;">
                        <span id="editorWordCountDisplay">Word count: {{ str_word_count(strip_tags($content)) }}</span>
                        <span style="color: #0b63e5; font-weight: 600;">&#128161; Tip: Click any blue link to view, change, or remove it</span>
                    </div>
                </div>
                @error('content')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                {{-- EDIT LINK MODAL --}}
                <div id="blogLinkModal" class="blog-link-modal-backdrop" style="display: none;">
                    <div class="blog-link-modal-box">
                        <div class="blog-link-modal-head">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 16px;">&#128279;</span>
                                <h4 id="linkModalHeading" style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;">Edit Link</h4>
                            </div>
                            <button type="button" id="btnLinkModalClose" style="border: none; background: transparent; font-size: 20px; line-height: 1; color: #94a3b8; cursor: pointer; padding: 0 4px;">&times;</button>
                        </div>
                        <div class="blog-link-modal-body">
                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                                Link URL (Destination)
                                <input
                                    type="url"
                                    id="linkModalUrl"
                                    placeholder="https://sortiqsolutions.com/..."
                                    style="width: 100%; padding: 9px 12px; font-size: 13px; border: 1.5px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; margin-top: 4px; outline: none;"
                                >
                                <span style="display: block; font-size: 11px; color: #64748b; margin-top: 4px; font-weight: normal;">Enter where the link should go (e.g. website page URL)</span>
                            </label>

                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-top: 14px; margin-bottom: 6px;">
                                Link Text (Anchor)
                                <input
                                    type="text"
                                    id="linkModalText"
                                    placeholder="Text to display"
                                    style="width: 100%; padding: 9px 12px; font-size: 13px; border: 1.5px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; margin-top: 4px; outline: none;"
                                >
                            </label>

                            <label style="display: flex; align-items: center; gap: 8px; margin-top: 14px; font-size: 12px; color: #334155; cursor: pointer;">
                                <input type="checkbox" id="linkModalTarget" style="cursor: pointer; width: 16px; height: 16px;">
                                <span>Open in a new tab (<code>target="_blank"</code>)</span>
                            </label>
                        </div>
                        <div class="blog-link-modal-foot">
                            <button type="button" id="btnLinkModalCancel" class="btn btn-secondary" style="padding: 7px 14px; font-size: 12px; font-weight: 600; border-radius: 6px; border: 1px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer;">Cancel</button>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" id="btnLinkModalRemove" class="btn btn-danger" style="display: none; padding: 7px 14px; font-size: 12px; font-weight: 600; border-radius: 6px; border: 1px solid #ef4444; background: #ef4444; color: #fff; cursor: pointer;">Remove Link</button>
                                <button type="button" id="btnLinkModalSave" class="btn btn-primary" style="padding: 7px 18px; font-size: 12px; font-weight: 600; border-radius: 6px; border: 1px solid #0b63e5; background: #0b63e5; color: #fff; cursor: pointer;">Apply Link</button>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* Visual Rich Text Editor Styling */
                    .blog-visual-editor {
                        width: 100%;
                        min-height: 420px;
                        max-height: 750px;
                        padding: 22px 24px;
                        background: #ffffff;
                        color: #1e293b;
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                        font-size: 15px;
                        line-height: 1.75;
                        outline: none;
                        border: none;
                        overflow-y: auto;
                        box-sizing: border-box;
                    }
                    .blog-visual-editor:focus {
                        background: #ffffff;
                    }
                    .blog-visual-editor p {
                        margin-top: 0;
                        margin-bottom: 1.15em;
                    }
                    .blog-visual-editor h1,
                    .blog-visual-editor h1 * {
                        font-size: 28px !important;
                        font-weight: 800 !important;
                        margin-top: 1.8em;
                        margin-bottom: 0.6em;
                        color: #0f172a;
                        line-height: 1.3;
                    }
                    .blog-visual-editor h2,
                    .blog-visual-editor h2 * {
                        font-size: 24px !important;
                        font-weight: 750 !important;
                        margin-top: 1.6em;
                        margin-bottom: 0.6em;
                        color: #0f172a;
                        line-height: 1.35;
                    }
                    .blog-visual-editor h3,
                    .blog-visual-editor h3 * {
                        font-size: 20px !important;
                        font-weight: 700 !important;
                        margin-top: 1.4em;
                        margin-bottom: 0.5em;
                        color: #1e293b;
                        line-height: 1.4;
                    }
                    .blog-visual-editor h4,
                    .blog-visual-editor h4 * {
                        font-size: 17px !important;
                        font-weight: 650 !important;
                        margin-top: 1.2em;
                        margin-bottom: 0.4em;
                        color: #334155;
                    }
                    .blog-visual-editor h5,
                    .blog-visual-editor h5 * {
                        font-size: 15px !important;
                        font-weight: 600 !important;
                        margin-top: 1.1em;
                        margin-bottom: 0.4em;
                        color: #475569;
                    }
                    .blog-visual-editor h6,
                    .blog-visual-editor h6 * {
                        font-size: 13.5px !important;
                        font-weight: 600 !important;
                        text-transform: uppercase;
                        letter-spacing: 0.04em;
                        margin-top: 1em;
                        margin-bottom: 0.35em;
                        color: #64748b;
                    }
                    .blog-visual-editor ul,
                    .blog-visual-editor ol {
                        margin-top: 0;
                        margin-bottom: 1.2em;
                        padding-left: 28px;
                    }
                    .blog-visual-editor li {
                        margin-bottom: 0.4em;
                    }
                    .blog-visual-editor blockquote {
                        border-left: 4px solid #0b63e5;
                        margin: 1.3em 0;
                        padding: 12px 18px;
                        background: #f8fafc;
                        color: #475569;
                        font-style: italic;
                        border-radius: 0 8px 8px 0;
                    }
                    .blog-visual-editor img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 8px;
                        margin: 1em 0;
                        display: block;
                    }

                    /* =========================================================
                    VIBRANT BLUE LINKS AS EXPLICITLY REQUESTED BY USER
                    ========================================================= */
                    .blog-visual-editor a {
                        color: #0b63e5 !important;
                        text-decoration: underline !important;
                        text-underline-offset: 3px !important;
                        font-weight: 600 !important;
                        background-color: rgba(11, 99, 229, 0.09) !important;
                        padding: 2px 6px !important;
                        border-radius: 4px !important;
                        cursor: pointer !important;
                        display: inline !important;
                        box-shadow: 0 1px 2px rgba(11, 99, 229, 0.15) !important;
                        transition: all 0.2s ease !important;
                    }
                    .blog-visual-editor a:hover {
                        background-color: #0b63e5 !important;
                        color: #ffffff !important;
                        text-decoration: none !important;
                        box-shadow: 0 2px 6px rgba(11, 99, 229, 0.3) !important;
                    }

                    /* Toolbar Button Styles */
                    .ed-btn {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        height: 28px;
                        min-width: 28px;
                        padding: 0 6px;
                        border-radius: 6px;
                        border: 1px solid #cbd5e1;
                        background: #ffffff;
                        color: #334155;
                        font-size: 12px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.15s ease;
                    }
                    .ed-btn:hover {
                        background: #f1f5f9;
                        border-color: #94a3b8;
                        color: #0f172a;
                    }
                    .ed-btn:active,
                    .ed-btn.is-active {
                        background: #e2e8f0;
                        border-color: #64748b;
                    }

                    /* Link Modal Styles */
                    .blog-link-modal-backdrop {
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: rgba(15, 23, 42, 0.55);
                        backdrop-filter: blur(2px);
                        z-index: 99999;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 16px;
                        box-sizing: border-box;
                    }
                    .blog-link-modal-box {
                        background: #ffffff;
                        width: 100%;
                        max-width: 480px;
                        border-radius: 12px;
                        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.25);
                        overflow: hidden;
                        animation: modalScaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
                    }
                    @keyframes modalScaleIn {
                        from { transform: scale(0.94); opacity: 0; }
                        to { transform: scale(1); opacity: 1; }
                    }
                    .blog-link-modal-head {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 14px 18px;
                        border-bottom: 1px solid #e2e8f0;
                        background: #f8fafc;
                    }
                    .blog-link-modal-body {
                        padding: 18px;
                    }
                    .blog-link-modal-foot {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px solid #e2e8f0;
                        background: #f8fafc;
                    }
                </style>

                <script>
                (function initBlogWysiwygEditor() {
                    var visual = document.getElementById('blogVisualEditor');
                    var raw = document.getElementById('blogRawContent');
                    var form = visual ? visual.closest('form') : null;
                    var wordCountEl = document.getElementById('editorWordCountDisplay');
                    var modeBadge = document.getElementById('editorActiveModeLabel');
                    var btnVisual = document.getElementById('btnSwitchVisual');
                    var btnHtml = document.getElementById('btnSwitchHtml');
                    var toolbar = document.getElementById('blogEditorToolbar');

                    var modal = document.getElementById('blogLinkModal');
                    var modalHeading = document.getElementById('linkModalHeading');
                    var inputUrl = document.getElementById('linkModalUrl');
                    var inputText = document.getElementById('linkModalText');
                    var inputTarget = document.getElementById('linkModalTarget');
                    var btnModalSave = document.getElementById('btnLinkModalSave');
                    var btnModalRemove = document.getElementById('btnLinkModalRemove');
                    var btnModalCancel = document.getElementById('btnLinkModalCancel');
                    var btnModalClose = document.getElementById('btnLinkModalClose');

                    if (!visual || !raw) return;

                    var currentActiveLink = null;
                    var currentSavedRange = null;

                    function updateWordCount() {
                        if (!wordCountEl) return;
                        var text = visual.innerText || visual.textContent || '';
                        var words = text.trim().split(/\s+/).filter(Boolean).length;
                        wordCountEl.textContent = 'Word count: ' + words;
                    }

                    function syncToRaw() {
                        raw.value = visual.innerHTML;
                        updateWordCount();
                    }

                    function syncToVisual() {
                        visual.innerHTML = raw.value;
                        updateWordCount();
                    }

                    // Clean unwanted ChatGPT tracking attributes like data-start, data-end, data-section-id
                    function cleanHtmlAttributes(html) {
                        return html.replace(/\s+(data-start|data-end|data-section-id)="[^"]*"/gi, '');
                    }

                    // Initial cleanup and count
                    visual.innerHTML = cleanHtmlAttributes(visual.innerHTML);
                    syncToRaw();

                    // Live typing updates
                    visual.addEventListener('input', syncToRaw);
                    raw.addEventListener('input', function() {
                        updateWordCount();
                    });

                    // Mode Tabs
                    btnVisual.addEventListener('click', function() {
                        syncToVisual();
                        visual.style.display = 'block';
                        raw.style.display = 'none';
                        toolbar.style.display = 'flex';
                        modeBadge.textContent = 'Visual Mode (Normal Text)';
                        modeBadge.style.color = '#0b63e5';
                        modeBadge.style.background = '#e0f2fe';
                        btnVisual.style.background = '#0b63e5';
                        btnVisual.style.borderColor = '#0b63e5';
                        btnVisual.style.color = '#ffffff';
                        btnHtml.style.background = '#ffffff';
                        btnHtml.style.borderColor = '#cbd5e1';
                        btnHtml.style.color = '#475569';
                    });

                    btnHtml.addEventListener('click', function() {
                        syncToRaw();
                        visual.style.display = 'none';
                        raw.style.display = 'block';
                        toolbar.style.display = 'none';
                        modeBadge.textContent = 'HTML Code View';
                        modeBadge.style.color = '#d97706';
                        modeBadge.style.background = '#fef3c7';
                        btnHtml.style.background = '#0f172a';
                        btnHtml.style.borderColor = '#0f172a';
                        btnHtml.style.color = '#ffffff';
                        btnVisual.style.background = '#ffffff';
                        btnVisual.style.borderColor = '#cbd5e1';
                        btnVisual.style.color = '#475569';
                    });

                    // Toolbar Command Execution
                    toolbar.querySelectorAll('[data-cmd]').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            var cmd = this.getAttribute('data-cmd');
                            var val = this.getAttribute('data-val') || null;
                            visual.focus();
                            document.execCommand(cmd, false, val);
                            syncToRaw();
                        });
                    });

                    // Format dropdown (Paragraph, H1, H2, H3, H4, H5, H6, blockquote)
                    var formatSelect = document.getElementById('editorFormatSelect');
                    if (formatSelect) {
                        formatSelect.addEventListener('change', function() {
                            var tag = this.value;
                            visual.focus();
                            document.execCommand('formatBlock', false, tag);
                            var sel = window.getSelection();
                            if (sel && sel.anchorNode) {
                                var parentEl = sel.anchorNode.nodeType === 1 ? sel.anchorNode : sel.anchorNode.parentElement;
                                var block = parentEl ? parentEl.closest('h1, h2, h3, h4, h5, h6, p, blockquote') : null;
                                if (block) {
                                    block.querySelectorAll('span, font, strong, b').forEach(function(child) {
                                        child.style.fontSize = '';
                                        child.style.fontFamily = '';
                                    });
                                }
                            }
                            syncToRaw();
                        });
                    }

                    // Image button
                    var btnImage = document.getElementById('btnToolbarImage');
                    if (btnImage) {
                        btnImage.addEventListener('click', function() {
                            var url = prompt('Enter Image URL:');
                            if (url) {
                                visual.focus();
                                document.execCommand('insertImage', false, url);
                                syncToRaw();
                            }
                        });
                    }

                    // Clean button
                    var btnClean = document.getElementById('btnToolbarClean');
                    if (btnClean) {
                        btnClean.addEventListener('click', function() {
                            visual.innerHTML = cleanHtmlAttributes(visual.innerHTML);
                            syncToRaw();
                            alert('Cleaned ChatGPT formatting & synchronized content!');
                        });
                    }

                    // Open Modal Helper
                    function openLinkModal(linkEl) {
                        currentActiveLink = linkEl || null;
                        if (linkEl) {
                            modalHeading.textContent = 'Edit Link';
                            inputUrl.value = linkEl.getAttribute('href') || '';
                            inputText.value = linkEl.textContent || '';
                            inputTarget.checked = linkEl.getAttribute('target') === '_blank';
                            btnModalRemove.style.display = 'inline-block';
                            btnModalSave.textContent = 'Update Link';
                        } else {
                            modalHeading.textContent = 'Add New Link';
                            inputUrl.value = '';
                            var sel = window.getSelection();
                            if (sel && sel.rangeCount > 0) {
                                currentSavedRange = sel.getRangeAt(0).cloneRange();
                                inputText.value = sel.toString().trim() || '';
                            } else {
                                currentSavedRange = null;
                                inputText.value = '';
                            }
                            inputTarget.checked = false;
                            btnModalRemove.style.display = 'none';
                            btnModalSave.textContent = 'Insert Link';
                        }
                        modal.style.display = 'flex';
                        inputUrl.focus();
                    }

                    function closeLinkModal() {
                        modal.style.display = 'none';
                        currentActiveLink = null;
                        currentSavedRange = null;
                    }

                    // Click ANY link directly in the visual editor to edit it!
                    visual.addEventListener('click', function(e) {
                        var targetLink = e.target.closest('a');
                        if (targetLink && visual.contains(targetLink)) {
                            e.preventDefault();
                            e.stopPropagation();
                            openLinkModal(targetLink);
                        }
                    });

                    // Toolbar Link button
                    var btnLink = document.getElementById('btnToolbarLink');
                    if (btnLink) {
                        btnLink.addEventListener('click', function() {
                            var sel = window.getSelection();
                            var parentLink = null;
                            if (sel && sel.anchorNode) {
                                var el = sel.anchorNode.nodeType === 1 ? sel.anchorNode : sel.anchorNode.parentElement;
                                parentLink = el ? el.closest('a') : null;
                            }
                            if (parentLink && visual.contains(parentLink)) {
                                openLinkModal(parentLink);
                            } else {
                                openLinkModal(null);
                            }
                        });
                    }

                    // Toolbar Unlink button
                    var btnUnlink = document.getElementById('btnToolbarUnlink');
                    if (btnUnlink) {
                        btnUnlink.addEventListener('click', function() {
                            visual.focus();
                            document.execCommand('unlink', false, null);
                            syncToRaw();
                        });
                    }

                    // Modal Save Link
                    btnModalSave.addEventListener('click', function() {
                        var url = inputUrl.value.trim();
                        var text = inputText.value.trim();
                        var isNewTab = inputTarget.checked;

                        if (!url) {
                            alert('Please enter a valid link URL.');
                            inputUrl.focus();
                            return;
                        }

                        if (currentActiveLink) {
                            // Editing existing link
                            currentActiveLink.setAttribute('href', url);
                            if (text) currentActiveLink.textContent = text;
                            if (isNewTab) {
                                currentActiveLink.setAttribute('target', '_blank');
                                currentActiveLink.setAttribute('rel', 'noopener noreferrer');
                            } else {
                                currentActiveLink.removeAttribute('target');
                                currentActiveLink.removeAttribute('rel');
                            }
                        } else {
                            // Creating new link
                            visual.focus();
                            if (currentSavedRange) {
                                var sel = window.getSelection();
                                sel.removeAllRanges();
                                sel.addRange(currentSavedRange);
                            }
                            var a = document.createElement('a');
                            a.href = url;
                            a.textContent = text || url;
                            if (isNewTab) {
                                a.target = '_blank';
                                a.rel = 'noopener noreferrer';
                            }

                            if (currentSavedRange && !currentSavedRange.collapsed) {
                                currentSavedRange.deleteContents();
                                currentSavedRange.insertNode(a);
                            } else {
                                document.execCommand('insertHTML', false, a.outerHTML);
                            }
                        }

                        closeLinkModal();
                        syncToRaw();
                    });

                    // Modal Remove Link
                    btnModalRemove.addEventListener('click', function() {
                        if (currentActiveLink) {
                            var textNode = document.createTextNode(currentActiveLink.textContent);
                            currentActiveLink.parentNode.replaceChild(textNode, currentActiveLink);
                        }
                        closeLinkModal();
                        syncToRaw();
                    });

                    // Modal Close / Cancel
                    btnModalClose.addEventListener('click', closeLinkModal);
                    btnModalCancel.addEventListener('click', closeLinkModal);
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) closeLinkModal();
                    });

                    // Ensure form submit always has fresh HTML
                    if (form) {
                        form.addEventListener('submit', function() {
                            if (visual.style.display !== 'none') {
                                syncToRaw();
                            }
                        });
                    }

                    // Blog Slug Auto-Generate, Edit & Direct Save Script
                    (function initBlogSlugEditor() {
                        var titleInput = document.getElementById('blog-title');
                        var slugInput = document.getElementById('blog-slug-input');
                        var slugViewMode = document.getElementById('slugViewMode');
                        var slugEditMode = document.getElementById('slugEditMode');
                        var slugDisplayText = document.getElementById('slugDisplayText');
                        var btnEdit = document.getElementById('btnEditSlug');
                        var btnSave = document.getElementById('btnSaveSlug');
                        var btnCancel = document.getElementById('btnCancelSlug');
                        var btnAuto = document.getElementById('btnAutoSlug');
                        var previewLink = document.getElementById('blogSlugPreviewLink');
                        var viewBtn = document.getElementById('btnViewLivePost');
                        var successBadge = document.getElementById('slugSaveSuccessBadge');
                        var errorMsg = document.getElementById('slugAjaxErrorMessage');
                        var spinner = document.getElementById('slugSaveLoadingSpinner');
                        var baseUrl = @json(rtrim(url('/'), '/') . '/');
                        var updateSlugUrl = @json($blog->exists ? route('admin.blogs.update-slug', $blog) : '');
                        var csrfToken = @json(csrf_token());

                        if (!slugInput) return;

                        var originalSlug = slugInput.value.trim();

                        function slugify(text) {
                            return text
                                .toString()
                                .toLowerCase()
                                .trim()
                                .replace(/[^\w\s-]/g, '')
                                .replace(/[\s_-]+/g, '-')
                                .replace(/^-+|-+$/g, '');
                        }

                        function sanitizeInputSlug() {
                            var val = slugInput.value.trim();
                            if (val.indexOf('http://') === 0 || val.indexOf('https://') === 0) {
                                try {
                                    var urlObj = new URL(val);
                                    var pathParts = urlObj.pathname.split('/').filter(Boolean);
                                    val = pathParts.length > 0 ? pathParts[pathParts.length - 1] : '';
                                } catch(e) {}
                            }
                            return slugify(val);
                        }

                        function updatePreviewUI(slugVal) {
                            var clean = slugVal.replace(/^\/+|\/+$/g, '');
                            var fullUrl = baseUrl + (clean || 'sample-slug');
                            if (slugDisplayText) {
                                slugDisplayText.textContent = clean || 'untitled-slug';
                            }
                            if (previewLink) {
                                previewLink.href = baseUrl + (clean || '');
                                previewLink.textContent = fullUrl;
                            }
                            if (viewBtn) {
                                viewBtn.href = baseUrl + (clean || '');
                            }
                        }

                        // Click Edit -> Show Edit Mode
                        if (btnEdit) {
                            btnEdit.addEventListener('click', function() {
                                originalSlug = slugInput.value.trim();
                                if (errorMsg) errorMsg.style.display = 'none';
                                if (slugViewMode) slugViewMode.style.display = 'none';
                                if (slugEditMode) slugEditMode.style.display = 'flex';
                                slugInput.focus();
                                slugInput.select();
                            });
                        }

                        // Click Cancel -> Hide Edit Mode, restore original
                        if (btnCancel) {
                            btnCancel.addEventListener('click', function() {
                                slugInput.value = originalSlug;
                                updatePreviewUI(originalSlug);
                                if (errorMsg) errorMsg.style.display = 'none';
                                if (slugEditMode) slugEditMode.style.display = 'none';
                                if (slugViewMode) slugViewMode.style.display = 'flex';
                            });
                        }

                        // Click Auto from Title
                        if (btnAuto && titleInput) {
                            btnAuto.addEventListener('click', function() {
                                var val = slugify(titleInput.value);
                                if (val) {
                                    slugInput.value = val;
                                    updatePreviewUI(val);
                                }
                            });
                        }

                        // Click Save -> Direct AJAX Save to DB (or local form update if new post)
                        if (btnSave) {
                            btnSave.addEventListener('click', function() {
                                var cleanSlug = sanitizeInputSlug();
                                if (!cleanSlug) {
                                    cleanSlug = slugify(titleInput ? titleInput.value : '') || 'new-slug';
                                }
                                slugInput.value = cleanSlug;
                                updatePreviewUI(cleanSlug);

                                if (errorMsg) errorMsg.style.display = 'none';

                                // If post exists in database, save via AJAX immediately
                                if (updateSlugUrl) {
                                    btnSave.disabled = true;
                                    if (spinner) spinner.style.display = 'inline';

                                    fetch(updateSlugUrl, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ slug: cleanSlug, blog_id: {{ $blog->id ?? 'null' }} })
                                    })
                                    .then(function(res) {
                                        return res.json().then(function(data) {
                                            return { status: res.status, data: data };
                                        });
                                    })
                                    .then(function(res) {
                                        btnSave.disabled = false;
                                        if (spinner) spinner.style.display = 'none';

                                        if (res.status === 200 && res.data && res.data.success) {
                                            originalSlug = res.data.slug;
                                            slugInput.value = res.data.slug;
                                            updatePreviewUI(res.data.slug);

                                            // Update edit url in history and main form
                                            if (res.data.edit_url) {
                                                try {
                                                    window.history.replaceState({}, '', res.data.edit_url);
                                                    var mainForm = slugInput.closest('form');
                                                    if (mainForm) mainForm.action = res.data.edit_url.replace(/\/edit\/?$/, '');
                                                    updateSlugUrl = res.data.edit_url.replace(/\/edit\/?$/, '/update-slug');
                                                } catch(e) {}
                                            }

                                            if (slugEditMode) slugEditMode.style.display = 'none';
                                            if (slugViewMode) slugViewMode.style.display = 'flex';

                                            if (successBadge) {
                                                successBadge.textContent = '✓ Saved: ' + res.data.slug;
                                                successBadge.style.display = 'inline';
                                                setTimeout(function() {
                                                    successBadge.style.display = 'none';
                                                }, 4000);
                                            }
                                        } else {
                                            var message = (res.data && res.data.message) || (res.data && res.data.errors && Object.values(res.data.errors)[0][0]) || 'Error saving slug.';
                                            if (errorMsg) {
                                                errorMsg.textContent = message;
                                                errorMsg.style.display = 'block';
                                            }
                                        }
                                    })
                                    .catch(function(err) {
                                        btnSave.disabled = false;
                                        if (spinner) spinner.style.display = 'none';
                                        if (errorMsg) {
                                            errorMsg.textContent = 'Network error saving slug.';
                                            errorMsg.style.display = 'block';
                                        }
                                    });
                                } else {
                                    // New post not yet created: keep in input, switch to view mode
                                    originalSlug = cleanSlug;
                                    if (slugEditMode) slugEditMode.style.display = 'none';
                                    if (slugViewMode) slugViewMode.style.display = 'flex';
                                    if (successBadge) {
                                        successBadge.textContent = '✓ Slug updated (click Publish to save)';
                                        successBadge.style.display = 'inline';
                                        setTimeout(function() { successBadge.style.display = 'none'; }, 3000);
                                    }
                                }
                            });
                        }

                        // Auto-slug while typing title for new posts
                        if (titleInput && (!originalSlug || originalSlug === 'new-blog')) {
                            titleInput.addEventListener('input', function() {
                                if (!slugInput.dataset.manualEdit) {
                                    var val = slugify(titleInput.value);
                                    slugInput.value = val;
                                    updatePreviewUI(val);
                                }
                            });
                            slugInput.addEventListener('input', function() {
                                slugInput.dataset.manualEdit = 'true';
                            });
                        }
                    })();

                    // Blog Featured Image Preview & Delete Manager
                    (function initBlogFeaturedImageManager() {
                        var fileInput = document.getElementById('blogImageFileInput');
                        var newPreviewCard = document.getElementById('newBlogImagePreviewCard');
                        var newPreviewImg = document.getElementById('newBlogImagePreviewImg');
                        var newPreviewName = document.getElementById('newBlogImageName');
                        var btnCancelNew = document.getElementById('btnCancelNewImage');
                        var currentCard = document.getElementById('currentBlogImageCard');
                        var btnDeleteCurrent = document.getElementById('btnDeleteBlogImage');
                        var hiddenImageInput = document.getElementById('blogCurrentHiddenImage');
                        var deleteFlagInput = document.getElementById('inputDeleteBlogImage');
                        var wrapper = document.getElementById('blogFeaturedImageWrapper');
                        var deleteUrl = @json($blog->exists ? route('admin.blogs.delete-image', $blog) : '');
                        var csrfToken = @json(csrf_token());

                        // Handle New File Selection Preview
                        if (fileInput) {
                            fileInput.addEventListener('change', function() {
                                if (fileInput.files && fileInput.files[0]) {
                                    var file = fileInput.files[0];
                                    if (!file.type.match('image.*')) {
                                        alert('Please select a valid image file (WebP, PNG, JPG).');
                                        fileInput.value = '';
                                        return;
                                    }

                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        if (newPreviewImg) newPreviewImg.src = e.target.result;
                                        if (newPreviewName) newPreviewName.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                                        if (newPreviewCard) newPreviewCard.style.display = 'block';
                                        if (deleteFlagInput) deleteFlagInput.value = '0';
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    if (newPreviewCard) newPreviewCard.style.display = 'none';
                                }
                            });
                        }

                        // Cancel New File Selection
                        if (btnCancelNew) {
                            btnCancelNew.addEventListener('click', function() {
                                if (fileInput) fileInput.value = '';
                                if (newPreviewCard) newPreviewCard.style.display = 'none';
                                if (newPreviewImg) newPreviewImg.src = '';
                            });
                        }

                        // Handle Delete Current Image
                        if (btnDeleteCurrent) {
                            btnDeleteCurrent.addEventListener('click', function() {
                                if (!confirm('Are you sure you want to permanently delete this image from the database and storage?')) {
                                    return;
                                }

                                btnDeleteCurrent.disabled = true;
                                btnDeleteCurrent.innerHTML = '<iconify-icon icon="lucide:loader" width="14" height="14" class="animate-spin"></iconify-icon> <span>Deleting...</span>';

                                if (deleteUrl) {
                                    fetch(deleteUrl, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                    .then(function(res) {
                                        return res.json().then(function(data) {
                                            return { status: res.status, data: data };
                                        });
                                    })
                                    .then(function(res) {
                                        if (res.status === 200 && res.data && res.data.success) {
                                            if (currentCard) currentCard.remove();
                                            if (hiddenImageInput) hiddenImageInput.value = '';
                                            if (deleteFlagInput) deleteFlagInput.value = '1';

                                            var successNotice = document.createElement('div');
                                            successNotice.style = 'font-size: 12px; color: #16a34a; background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; padding: 7px 10px; margin-bottom: 10px; font-weight: 600; display: flex; align-items: center; gap: 5px;';
                                            successNotice.innerHTML = '<iconify-icon icon="lucide:check-circle" width="15" height="15"></iconify-icon> Image permanently deleted from database.';
                                            if (wrapper && fileInput) {
                                                wrapper.insertBefore(successNotice, fileInput);
                                                setTimeout(function() {
                                                    successNotice.style.transition = 'opacity 0.5s';
                                                    successNotice.style.opacity = '0';
                                                    setTimeout(function() { successNotice.remove(); }, 500);
                                                }, 5000);
                                            }
                                        } else {
                                            alert((res.data && res.data.message) || 'Error deleting image.');
                                            btnDeleteCurrent.disabled = false;
                                            btnDeleteCurrent.innerHTML = '<iconify-icon icon="lucide:trash-2" width="14" height="14"></iconify-icon> <span>Delete Image</span>';
                                        }
                                    })
                                    .catch(function(err) {
                                        alert('Network error while deleting image.');
                                        btnDeleteCurrent.disabled = false;
                                        btnDeleteCurrent.innerHTML = '<iconify-icon icon="lucide:trash-2" width="14" height="14"></iconify-icon> <span>Delete Image</span>';
                                    });
                                } else {
                                    // New unsaved post
                                    if (currentCard) currentCard.remove();
                                    if (hiddenImageInput) hiddenImageInput.value = '';
                                    if (deleteFlagInput) deleteFlagInput.value = '1';
                                }
                            });
                        }
                    })();
                })();
                </script>

                <div class="meta-box" style="margin-top: 30px;">
                    <div class="meta-title">SEO Meta Details</div>
                    <div class="meta-body review-fields blog-fields">
                        <label>
                            Meta Title
                            <input
                                class="title-input @error('meta_title') is-invalid @enderror"
                                name="meta_title"
                                type="text"
                                value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                                placeholder="SEO Title (Optional)"
                                style="font-size: 14px; padding: 10px;"
                            >
                            @error('meta_title')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label style="margin-top: 15px;">
                            Meta Description
                            <textarea
                                class="@error('meta_description') is-invalid @enderror"
                                name="meta_description"
                                placeholder="SEO Description (Optional)"
                            >{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                            @error('meta_description')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label style="margin-top: 15px;">
                            Meta Keywords
                            <textarea
                                class="@error('meta_keywords') is-invalid @enderror"
                                name="meta_keywords"
                                placeholder="SEO Keywords, comma separated (Optional)"
                            >{{ old('meta_keywords', $blog->meta_keywords ?? '') }}</textarea>
                            @error('meta_keywords')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>
            </section>

            <aside class="review-side">
                @include('admin.blogs.partials.publish-box', [
                    'blog' => $blog,
                    'submitLabel' => $submitLabel,
                ])

                <div class="meta-box">
                    <div class="meta-title">Blog Details</div>
                    <div class="meta-body review-fields blog-fields">
                        <div class="form-group blog-featured-image-wrapper" id="blogFeaturedImageWrapper" style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b; font-size: 13px;">Featured Image</label>
                            <input type="hidden" name="image" id="blogCurrentHiddenImage" value="{{ $image }}">
                            <input type="hidden" name="delete_image" id="inputDeleteBlogImage" value="0">

                            {{-- Current Image Display (if exists) --}}
                            @if (!empty($blog['image']))
                                <div id="currentBlogImageCard" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; margin-bottom: 10px;">
                                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; margin-bottom: 6px;">Current Image</div>
                                    <div style="position: relative; max-width: 100%; border-radius: 6px; overflow: hidden; background: #0b132b; text-align: center; margin-bottom: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                                        <img 
                                            id="currentBlogImageImg"
                                            src="{{ $blog->image_url }}" 
                                            alt="{{ $blog->title ?: 'Featured image' }}" 
                                            style="max-width: 100%; max-height: 180px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 4px;"
                                        >
                                    </div>
                                    <div style="font-size: 11px; color: #64748b; word-break: break-all; margin-bottom: 8px; line-height: 1.4;">
                                        File: <strong style="color: #334155;">{{ $blog['image'] }}</strong>
                                    </div>
                                    <button 
                                        type="button" 
                                        id="btnDeleteBlogImage"
                                        style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; font-size: 12px; font-weight: 600; color: #b91c1c; background: #fee2e2; border: 1px solid rgba(185, 28, 28, 0.25); border-radius: 6px; cursor: pointer; transition: all 0.15s ease;"
                                        onmouseover="this.style.background='#fecaca'"
                                        onmouseout="this.style.background='#fee2e2'"
                                    >
                                        <iconify-icon icon="lucide:trash-2" width="14" height="14"></iconify-icon>
                                        <span>Delete Image</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Live Preview for newly selected file --}}
                            <div id="newBlogImagePreviewCard" style="display: none; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 10px; margin-bottom: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #1d4ed8; letter-spacing: 0.5px;">New Image Selected</span>
                                    <button type="button" id="btnCancelNewImage" style="background: none; border: none; color: #64748b; font-size: 11px; font-weight: 600; cursor: pointer; text-decoration: underline;">Cancel</button>
                                </div>
                                <div style="position: relative; max-width: 100%; border-radius: 6px; overflow: hidden; background: #0f172a; text-align: center; margin-bottom: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                                    <img id="newBlogImagePreviewImg" src="" alt="New preview" style="max-width: 100%; max-height: 180px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 4px;">
                                </div>
                                <div id="newBlogImageName" style="font-size: 11px; color: #1e40af; word-break: break-all;"></div>
                            </div>

                            {{-- File Upload Input --}}
                            <input
                                id="blogImageFileInput"
                                class="@error('image_file') is-invalid @enderror"
                                name="image_file"
                                type="file"
                                accept="image/webp,image/png,image/jpeg,image/jpg"
                                style="width: 100%;"
                            >
                            <span class="field-help" style="display: block; margin-top: 4px; font-size: 11px; color: #64748b;">
                                Upload a local blog image (WebP, PNG, JPG). Replaces existing image on save.
                            </span>
                            @error('image_file')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Multi-Category Manager --}}
                        <div class="multi-cat-container" id="multiCatContainer">
                            <div class="multi-cat-header">
                                <span class="multi-cat-header-title">Category <small>(Multi-select)</small></span>
                                <span id="multiCatSelectedCountBadge" class="multi-cat-header-badge">
                                    {{ !empty($selectedCategories) ? count($selectedCategories) : 0 }} selected
                                </span>
                            </div>

                            {{-- Hidden input for backward compatibility --}}
                            <input type="hidden" name="category" id="multiCategoryHiddenInput" value="{{ is_array($selectedCategories) ? implode(', ', $selectedCategories) : '' }}">

                            {{-- Dropdown Trigger Box --}}
                            <div id="multiCatTrigger" tabindex="0" role="combobox" aria-expanded="false" aria-haspopup="listbox">
                                <div id="multiCatPillsContainer">
                                    @forelse ($selectedCategories as $cat)
                                        <span class="multi-cat-pill" data-cat="{{ $cat }}">
                                            <span>{{ $cat }}</span>
                                            <span class="multi-cat-remove-btn" data-cat="{{ $cat }}" title="Remove">&times;</span>
                                        </span>
                                    @empty
                                        <span id="multiCatPlaceholder">Select categories...</span>
                                    @endforelse
                                </div>
                                <span class="multi-cat-trigger-arrow">
                                    <svg id="multiCatArrowIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </div>

                            {{-- Dropdown Panel --}}
                            <div id="multiCatDropdown">
                                {{-- Search Input --}}
                                <div class="multi-cat-search-box">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    <input type="text" id="multiCatSearchInput" placeholder="Search categories..." autocomplete="off">
                                </div>

                                {{-- Quick Actions --}}
                                <div class="multi-cat-options-bar">
                                    <span>Options:</span>
                                    <div style="display: flex; gap: 8px;">
                                        <button type="button" id="multiCatSelectAllBtn">Select All</button>
                                        <span style="color: #cbd5e1;">|</span>
                                        <button type="button" id="multiCatClearAllBtn">Clear All</button>
                                    </div>
                                </div>

                                {{-- Scrollable Checkbox List --}}
                                <div class="multi-cat-list" id="multiCatList">
                                    @foreach ($categories as $index => $category)
                                        @php
                                            $isChecked = in_array($category, $selectedCategories, true);
                                        @endphp
                                        <div class="multi-cat-row {{ $isChecked ? 'is-checked' : '' }}" data-cat-name="{{ strtolower($category) }}">
                                            <input 
                                                type="checkbox" 
                                                id="cat-check-{{ $index }}" 
                                                name="categories[]" 
                                                value="{{ $category }}" 
                                                class="multi-cat-checkbox"
                                                @checked($isChecked)
                                            >
                                            <label for="cat-check-{{ $index }}" class="multi-cat-text-label">{{ $category }}</label>
                                        </div>
                                    @endforeach
                                    <div id="multiCatNoMatch" style="display: none; padding: 12px; text-align: center; color: #94a3b8; font-size: 12px;">No matching categories found</div>
                                </div>
                            </div>

                            @error('category')
                                <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                            @enderror
                            @error('categories')
                                <span class="field-error" style="display: block; margin-top: 4px;">{{ $message }}</span>
                            @enderror

                            <style>
                                /* Multi-category Dropdown & Item Styling */
                                .multi-cat-container {
                                    position: relative !important;
                                    margin-bottom: 16px !important;
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                }

                                .multi-cat-header {
                                    display: flex !important;
                                    flex-direction: row !important;
                                    justify-content: space-between !important;
                                    align-items: center !important;
                                    margin-bottom: 6px !important;
                                    width: 100% !important;
                                }

                                .multi-cat-header-title {
                                    font-size: 12px !important;
                                    font-weight: 700 !important;
                                    color: var(--text, #1e293b) !important;
                                    letter-spacing: 0.01em !important;
                                }

                                .multi-cat-header-title small {
                                    font-weight: 400 !important;
                                    color: #64748b !important;
                                    font-size: 11px !important;
                                }

                                .multi-cat-header-badge {
                                    font-size: 11px !important;
                                    font-weight: 600 !important;
                                    color: #2563eb !important;
                                    background: #eff6ff !important;
                                    padding: 1px 8px !important;
                                    border-radius: 12px !important;
                                    border: 1px solid #bfdbfe !important;
                                    display: inline-block !important;
                                    margin: 0 !important;
                                }

                                /* Trigger Box */
                                #multiCatTrigger {
                                    display: flex !important;
                                    flex-direction: row !important;
                                    flex-wrap: wrap !important;
                                    align-items: center !important;
                                    gap: 5px !important;
                                    min-height: 40px !important;
                                    padding: 6px 36px 6px 10px !important;
                                    background: #ffffff !important;
                                    border: 1px solid #cbd5e1 !important;
                                    border-radius: 6px !important;
                                    cursor: pointer !important;
                                    position: relative !important;
                                    box-sizing: border-box !important;
                                    transition: all 0.15s ease !important;
                                    width: 100% !important;
                                    user-select: none !important;
                                }

                                #multiCatTrigger:hover {
                                    border-color: #94a3b8 !important;
                                }

                                #multiCatTrigger:focus,
                                #multiCatTrigger.is-open {
                                    border-color: #2563eb !important;
                                    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
                                    outline: none !important;
                                }

                                #multiCatPillsContainer {
                                    display: flex !important;
                                    flex-direction: row !important;
                                    flex-wrap: wrap !important;
                                    gap: 5px !important;
                                    align-items: center !important;
                                    flex: 1 !important;
                                    width: auto !important;
                                }

                                #multiCatPlaceholder {
                                    color: #94a3b8 !important;
                                    font-size: 13px !important;
                                    display: inline-block !important;
                                    margin: 0 !important;
                                }

                                .multi-cat-trigger-arrow {
                                    position: absolute !important;
                                    right: 12px !important;
                                    top: 50% !important;
                                    transform: translateY(-50%) !important;
                                    pointer-events: none !important;
                                    color: #64748b !important;
                                    display: inline-flex !important;
                                    align-items: center !important;
                                    justify-content: center !important;
                                }

                                #multiCatArrowIcon {
                                    transition: transform 0.2s ease !important;
                                }

                                /* Badges / Pills */
                                .multi-cat-pill {
                                    display: inline-flex !important;
                                    flex-direction: row !important;
                                    align-items: center !important;
                                    gap: 4px !important;
                                    background: #eff6ff !important;
                                    color: #1d4ed8 !important;
                                    border: 1px solid #bfdbfe !important;
                                    font-size: 12px !important;
                                    font-weight: 600 !important;
                                    padding: 2px 7px !important;
                                    border-radius: 4px !important;
                                    line-height: 1.3 !important;
                                    margin: 0 !important;
                                }

                                .multi-cat-pill:hover {
                                    background: #dbeafe !important;
                                }

                                .multi-cat-pill span {
                                    display: inline !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                }

                                .multi-cat-pill .multi-cat-remove-btn {
                                    display: inline-flex !important;
                                    align-items: center !important;
                                    justify-content: center !important;
                                    width: 14px !important;
                                    height: 14px !important;
                                    border-radius: 50% !important;
                                    color: #3b82f6 !important;
                                    font-size: 13px !important;
                                    line-height: 1 !important;
                                    cursor: pointer !important;
                                }

                                .multi-cat-pill .multi-cat-remove-btn:hover {
                                    background: #bfdbfe !important;
                                    color: #1e3a8a !important;
                                }

                                /* Dropdown Panel */
                                #multiCatDropdown {
                                    display: none;
                                    position: absolute !important;
                                    top: calc(100% + 4px) !important;
                                    left: 0 !important;
                                    right: 0 !important;
                                    background: #ffffff !important;
                                    border: 1px solid #cbd5e1 !important;
                                    border-radius: 8px !important;
                                    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.12), 0 8px 10px -6px rgba(0,0,0,0.08) !important;
                                    z-index: 1050 !important;
                                    padding: 10px !important;
                                    box-sizing: border-box !important;
                                    flex-direction: column !important;
                                    width: 100% !important;
                                }

                                /* Search Box */
                                .multi-cat-search-box {
                                    position: relative !important;
                                    margin-bottom: 8px !important;
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                }

                                .multi-cat-search-box svg {
                                    position: absolute !important;
                                    left: 9px !important;
                                    top: 50% !important;
                                    transform: translateY(-50%) !important;
                                    color: #94a3b8 !important;
                                    pointer-events: none !important;
                                }

                                #multiCatSearchInput {
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                    padding: 6px 10px 6px 30px !important;
                                    font-size: 12.5px !important;
                                    border: 1px solid #cbd5e1 !important;
                                    border-radius: 5px !important;
                                    outline: none !important;
                                    height: 32px !important;
                                    background: #f8fafc !important;
                                    color: #1e293b !important;
                                    margin: 0 !important;
                                }

                                #multiCatSearchInput:focus {
                                    background: #ffffff !important;
                                    border-color: #2563eb !important;
                                    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1) !important;
                                }

                                /* Options Bar */
                                .multi-cat-options-bar {
                                    display: flex !important;
                                    flex-direction: row !important;
                                    justify-content: space-between !important;
                                    align-items: center !important;
                                    padding: 0 2px 6px 2px !important;
                                    margin-bottom: 6px !important;
                                    border-bottom: 1px solid #f1f5f9 !important;
                                    font-size: 11.5px !important;
                                    color: #64748b !important;
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                }

                                .multi-cat-options-bar button {
                                    background: none !important;
                                    border: none !important;
                                    padding: 0 !important;
                                    font-size: 11.5px !important;
                                    font-weight: 600 !important;
                                    cursor: pointer !important;
                                    text-decoration: none !important;
                                }

                                #multiCatSelectAllBtn {
                                    color: #2563eb !important;
                                }
                                #multiCatSelectAllBtn:hover {
                                    text-decoration: underline !important;
                                }

                                #multiCatClearAllBtn {
                                    color: #ef4444 !important;
                                }
                                #multiCatClearAllBtn:hover {
                                    text-decoration: underline !important;
                                }

                                /* Scrollable Category List */
                                .multi-cat-list {
                                    overflow-y: auto !important;
                                    max-height: 190px !important;
                                    display: flex !important;
                                    flex-direction: column !important;
                                    gap: 2px !important;
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                    padding: 0 !important;
                                    margin: 0 !important;
                                }

                                .multi-cat-list::-webkit-scrollbar {
                                    width: 5px;
                                }
                                .multi-cat-list::-webkit-scrollbar-thumb {
                                    background: #cbd5e1;
                                    border-radius: 4px;
                                }

                                /* The Row: ALWAYS horizontal flex-direction row */
                                .multi-cat-row {
                                    display: flex !important;
                                    flex-direction: row !important;
                                    align-items: center !important;
                                    justify-content: flex-start !important;
                                    gap: 10px !important;
                                    padding: 7px 9px !important;
                                    border-radius: 5px !important;
                                    cursor: pointer !important;
                                    user-select: none !important;
                                    transition: background-color 0.12s ease !important;
                                    width: 100% !important;
                                    box-sizing: border-box !important;
                                    margin: 0 !important;
                                }

                                .multi-cat-row:hover {
                                    background-color: #f1f5f9 !important;
                                }

                                .multi-cat-row.is-checked {
                                    background-color: #eff6ff !important;
                                }

                                /* The Checkbox: horizontal, aligned */
                                .multi-cat-row input[type="checkbox"],
                                .multi-cat-row .multi-cat-checkbox {
                                    width: 16px !important;
                                    height: 16px !important;
                                    min-width: 16px !important;
                                    max-width: 16px !important;
                                    accent-color: #2563eb !important;
                                    cursor: pointer !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    display: inline-block !important;
                                    flex-shrink: 0 !important;
                                    vertical-align: middle !important;
                                }

                                /* The Label Text: horizontal next to checkbox */
                                .multi-cat-row label.multi-cat-text-label {
                                    display: inline-block !important;
                                    flex: 1 !important;
                                    font-family: inherit !important;
                                    font-size: 13px !important;
                                    font-weight: 500 !important;
                                    color: #1e293b !important;
                                    cursor: pointer !important;
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    text-align: left !important;
                                    line-height: 1.4 !important;
                                    white-space: normal !important;
                                }

                                .multi-cat-row.is-checked label.multi-cat-text-label {
                                    color: #1d4ed8 !important;
                                    font-weight: 600 !important;
                                }
                            </style>

                            <script>
                            (function initBlogMultiCategorySelector() {
                                function setup() {
                                    var container = document.getElementById('multiCatContainer');
                                    if (!container) return;

                                    var trigger = document.getElementById('multiCatTrigger');
                                    var dropdown = document.getElementById('multiCatDropdown');
                                    var pillsContainer = document.getElementById('multiCatPillsContainer');
                                    var countBadge = document.getElementById('multiCatSelectedCountBadge');
                                    var hiddenInput = document.getElementById('multiCategoryHiddenInput');
                                    var searchInput = document.getElementById('multiCatSearchInput');
                                    var selectAllBtn = document.getElementById('multiCatSelectAllBtn');
                                    var clearAllBtn = document.getElementById('multiCatClearAllBtn');
                                    var arrowIcon = document.getElementById('multiCatArrowIcon');
                                    var rows = container.querySelectorAll('.multi-cat-row');
                                    var checkboxes = container.querySelectorAll('.multi-cat-checkbox');
                                    var noMatch = document.getElementById('multiCatNoMatch');

                                    function isOpen() {
                                        return dropdown.style.display === 'flex';
                                    }

                                    function setOpen(open) {
                                        if (open) {
                                            dropdown.style.display = 'flex';
                                            trigger.classList.add('is-open');
                                            trigger.setAttribute('aria-expanded', 'true');
                                            if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
                                            if (searchInput) {
                                                searchInput.value = '';
                                                filterRows('');
                                                setTimeout(function() { searchInput.focus(); }, 50);
                                            }
                                        } else {
                                            dropdown.style.display = 'none';
                                            trigger.classList.remove('is-open');
                                            trigger.setAttribute('aria-expanded', 'false');
                                            if (arrowIcon) arrowIcon.style.transform = 'rotate(0deg)';
                                        }
                                    }

                                    function filterRows(query) {
                                        var q = query.trim().toLowerCase();
                                        var matched = 0;
                                        rows.forEach(function(row) {
                                            var name = row.getAttribute('data-cat-name') || '';
                                            if (!q || name.indexOf(q) !== -1) {
                                                row.style.display = 'flex';
                                                matched++;
                                            } else {
                                                row.style.display = 'none';
                                            }
                                        });
                                        if (noMatch) {
                                            noMatch.style.display = matched === 0 ? 'block' : 'none';
                                        }
                                    }

                                    function updateState() {
                                        var selected = [];
                                        checkboxes.forEach(function(cb) {
                                            var parentRow = cb.closest('.multi-cat-row');
                                            if (cb.checked) {
                                                selected.push(cb.value);
                                                if (parentRow) parentRow.classList.add('is-checked');
                                            } else {
                                                if (parentRow) parentRow.classList.remove('is-checked');
                                            }
                                        });

                                        if (countBadge) {
                                            countBadge.textContent = selected.length + ' selected';
                                        }

                                        if (hiddenInput) {
                                            hiddenInput.value = selected.join(', ');
                                        }

                                        pillsContainer.innerHTML = '';
                                        if (selected.length === 0) {
                                            var placeholder = document.createElement('span');
                                            placeholder.id = 'multiCatPlaceholder';
                                            placeholder.textContent = 'Select categories...';
                                            pillsContainer.appendChild(placeholder);
                                        } else {
                                            selected.forEach(function(cat) {
                                                var pill = document.createElement('span');
                                                pill.className = 'multi-cat-pill';
                                                pill.setAttribute('data-cat', cat);

                                                var textSpan = document.createElement('span');
                                                textSpan.textContent = cat;

                                                var removeBtn = document.createElement('span');
                                                removeBtn.className = 'multi-cat-remove-btn';
                                                removeBtn.setAttribute('data-cat', cat);
                                                removeBtn.innerHTML = '&times;';
                                                removeBtn.title = 'Remove ' + cat;

                                                pill.appendChild(textSpan);
                                                pill.appendChild(removeBtn);
                                                pillsContainer.appendChild(pill);
                                            });
                                        }
                                    }

                                    // Clicking row toggles checkbox
                                    rows.forEach(function(row) {
                                        row.addEventListener('click', function(e) {
                                            if (e.target.tagName !== 'INPUT') {
                                                var cb = row.querySelector('.multi-cat-checkbox');
                                                if (cb) {
                                                    cb.checked = !cb.checked;
                                                    updateState();
                                                }
                                            }
                                        });
                                    });

                                    // Trigger click
                                    trigger.addEventListener('click', function(e) {
                                        if (e.target.closest('.multi-cat-remove-btn')) {
                                            var catToRemove = e.target.closest('.multi-cat-remove-btn').getAttribute('data-cat');
                                            if (catToRemove) {
                                                checkboxes.forEach(function(cb) {
                                                    if (cb.value === catToRemove) {
                                                        cb.checked = false;
                                                    }
                                                });
                                                updateState();
                                            }
                                            e.stopPropagation();
                                            return;
                                        }
                                        setOpen(!isOpen());
                                    });

                                    trigger.addEventListener('keydown', function(e) {
                                        if (e.key === 'Enter' || e.key === ' ') {
                                            e.preventDefault();
                                            setOpen(!isOpen());
                                        } else if (e.key === 'Escape') {
                                            setOpen(false);
                                        }
                                    });

                                    if (searchInput) {
                                        searchInput.addEventListener('input', function() {
                                            filterRows(this.value);
                                        });
                                        searchInput.addEventListener('keydown', function(e) {
                                            if (e.key === 'Escape') {
                                                setOpen(false);
                                                trigger.focus();
                                            }
                                        });
                                    }

                                    checkboxes.forEach(function(cb) {
                                        cb.addEventListener('change', function() {
                                            updateState();
                                        });
                                    });

                                    if (selectAllBtn) {
                                        selectAllBtn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            rows.forEach(function(row) {
                                                if (row.style.display !== 'none') {
                                                    var cb = row.querySelector('.multi-cat-checkbox');
                                                    if (cb) cb.checked = true;
                                                }
                                            });
                                            updateState();
                                        });
                                    }

                                    if (clearAllBtn) {
                                        clearAllBtn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            checkboxes.forEach(function(cb) {
                                                cb.checked = false;
                                            });
                                            updateState();
                                        });
                                    }

                                    document.addEventListener('click', function(e) {
                                        if (!container.contains(e.target)) {
                                            setOpen(false);
                                        }
                                    });
                                }

                                if (document.readyState === 'loading') {
                                    document.addEventListener('DOMContentLoaded', setup);
                                } else {
                                    setup();
                                }
                            })();
                            </script>
                        </div>

                        <label>
                            Tags
                            <input name="tags_text" type="text" value="{{ old('tags_text', implode(', ', $blog->tags ?? [])) }}" placeholder="Example: SEO, Laravel, Web Design">
                            <span class="field-help">Separate tags with commas. You can add up to 12 tags.</span>
                            @error('tags_text')<span class="field-error">{{ $message }}</span>@enderror
                        </label>

                        <label>
                            Publish Date
                            <input
                                class="@error('published_at') is-invalid @enderror"
                                name="published_at"
                                type="date"
                                value="{{ $publishedAt }}"
                            >
                            @error('published_at')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Short Description
                            <textarea
                                class="@error('excerpt') is-invalid @enderror"
                                name="excerpt"
                                placeholder="Short line shown in blog cards"
                            >{{ $excerpt }}</textarea>
                            @error('excerpt')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>
            </aside>
        </div>
    </form>
