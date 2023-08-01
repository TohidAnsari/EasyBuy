<a href="{{ route('product.wishlist') }}" class="btn px-0 ml-3">
    <i class="fas fa-heart text-primary"></i>
    <span class="badge text-secondary border border-secondary rounded-circle"
        style="padding-bottom: 2px;">{{ Cart::instance('addtowishlist')->count() > 0 ? Cart::instance('addtowishlist')->count() : 0 }}</span>
</a>
