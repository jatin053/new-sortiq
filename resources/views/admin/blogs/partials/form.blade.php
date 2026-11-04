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
            $categoryValue = old('category', $blog['category']);
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
                    .blog-visual-editor h2 {
                        font-size: 24px;
                        font-weight: 700;
                        margin-top: 1.6em;
                        margin-bottom: 0.6em;
                        color: #0f172a;
                        line-height: 1.35;
                    }
                    .blog-visual-editor h3 {
                        font-size: 20px;
                        font-weight: 700;
                        margin-top: 1.4em;
                        margin-bottom: 0.5em;
                        color: #1e293b;
                        line-height: 1.4;
                    }
                    .blog-visual-editor h4 {
                        font-size: 17px;
                        font-weight: 600;
                        margin-top: 1.2em;
                        margin-bottom: 0.4em;
                        color: #334155;
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

                    // Format dropdown (Paragraph, H2, H3, H4, blockquote)
                    var formatSelect = document.getElementById('editorFormatSelect');
                    if (formatSelect) {
                        formatSelect.addEventListener('change', function() {
                            var tag = this.value;
                            visual.focus();
                            document.execCommand('formatBlock', false, tag);
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
                        <label>
                            Featured Image
                            <input type="hidden" name="image" value="{{ $image }}">
                            <input
                                class="@error('image_file') is-invalid @enderror"
                                name="image_file"
                                type="file"
                                accept="image/webp,image/png,image/jpeg"
                            >
                            <span class="field-help">Upload a local blog image. The current image stays in place until you replace it.</span>
                            @error('image_file')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>

                        @if ($blog->image_url)
                            <p class="current-logo-path">
                                Current file: <strong>{{ $blog['image'] }}</strong>
                            </p>
                        @endif

                        <label>
                            Category
                            <select name="category" class="@error('category') is-invalid @enderror">
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" @selected($categoryValue === $category)>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </label>

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
