<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
<div class="comment">
    <div class="rating">
        <span class="star filled">★</span>
        <span class="star filled">★</span>
        <span class="star filled">★</span>
        <span class="star">★</span>
        <span class="star">★</span>
    </div>
    <h3>Review Title 1</h3>
    <div class="body">
        <img
            src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>"
            alt="User 1"
            class="user-photo" />
        <p>This is the body of review 1. I loved the product!</p>
    </div>
</div>