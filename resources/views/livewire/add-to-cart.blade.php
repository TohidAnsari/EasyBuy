<a href="{{ route('product.cart') }}" class="btn px-0 ml-3">
    <i class="fas fa-shopping-cart text-primary"></i>
    <span class="badge text-secondary border border-secondary rounded-circle"
        style="padding-bottom: 2px;">{{ Cart::instance('addtocart')->count() > 0 ? Cart::instance('addtocart')->count() : 0 }}</span>
</a>
