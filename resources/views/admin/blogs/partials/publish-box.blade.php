<div class="meta-box">
    <div class="meta-title">Publish</div>
    <div class="meta-body">
        <label class="publish-field">
            Status
            <select name="status" class="@error('status') is-invalid @enderror">
                <option value="published" @selected(old('status', $blog['status']) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $blog['status']) === 'draft')>Draft</option>
            </select>
        </label>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <p>Visibility: <strong>Public</strong></p>
        <p>Published on: <strong>{{ $blog['published_label'] }}</strong></p>
    </div>
    <div class="meta-footer" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
        @if ($blog->exists)
            <button type="button"
                    class="btn btn-danger"
                    style="font-size: 12px; padding: 6px 12px; border-radius: 4px; cursor: pointer;"
                    onclick="if(confirm('Are you sure you want to delete this blog post?')) { document.getElementById('delete-blog-form').submit(); }">
                Delete
            </button>
        @else
            <span></span>
        @endif
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</div>
