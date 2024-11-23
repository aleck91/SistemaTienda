@push('scripts')
    <!-- Agregar el CSS y JS de Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

<div class="p-4 bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold">Carrusel de Productos</h2>

    <div class="swiper-container mt-4">
        <div class="swiper-wrapper">
            @foreach($images as $image)
                <div class="swiper-slide">
                    <img src="{{ $image }}" alt="Producto" class="w-full h-auto rounded-lg">
                </div>
            @endforeach
        </div>
        <!-- Agregar controles para el carrusel -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

@push('scripts')
<script>
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endpush
