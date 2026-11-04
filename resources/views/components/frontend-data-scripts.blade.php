@if (! empty($frontendReviewFeed ?? []))
<script type="application/json" id="reviews-data">@json(['reviews' => $frontendReviewFeed])</script>
@endif
