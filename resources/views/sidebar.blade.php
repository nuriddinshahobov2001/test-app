<nav class="p-4">
    <div class="mb-6">
        <p class="text-gray-400 uppercase text-xs font-bold mb-4">Main</p>
        <ul>
            <li class="mb-2">
                <a href="{{ route('dashboard-index') }}" class="flex items-center p-2 rounded-lg {{ request()->is('/') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('products.index') }}" class="flex items-center p-2 rounded-lg {{ (request()->is('products') or request()->is('products/*')) ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-ice-cream mr-3"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
