<div class="meta-box">
    <div class="meta-title">Publish</div>
    <div class="meta-body">
        <button type="button" class="btn preview-btn">Preview Changes</button>

        <label class="publish-field">
            Status
            <select name="status" class="@error('status') is-invalid @enderror">
                <option value="published" @selected(old('status', $clientLogo['status']) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $clientLogo['status']) === 'draft')>Draft</option>
            </select>
        </label>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <p>Visibility: <strong>Public</strong></p>
        <p>Display order: <strong>{{ old('sort_order', $clientLogo['sort_order']) }}</strong></p>
    </div>
    <div class="meta-footer" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
        @if ($clientLogo->exists)
            <button type="button"
                    class="btn btn-danger"
                    style="font-size: 12px; padding: 6px 12px; border-radius: 4px; cursor: pointer;"
                    onclick="if(confirm('Are you sure you want to delete this client logo?')) { document.getElementById('delete-client-logo-form').submit(); }">
                Delete
            </button>
        @else
            <span></span>
        @endif
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</div>

