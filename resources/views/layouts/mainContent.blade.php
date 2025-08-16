<main class="content">
        <div class="stat-grid">
            <div class="stat-card">
                <div>
                    <p class="title">Product</p>
                    <p class="value">{{ $totalProducts ?? 0 }}</p>
                </div>
                <div class="thumb"><i class="fas fa-store"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">Category</p>
                    <p class="value">{{ $totalCategories ?? 0 }}</p>
                </div>
                <div class="thumb"><i class="fas fa-store"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">Customer</p>
                    <p class="value">{{ $totalCustomers ?? 0 }}</p>
                </div>
                <div class="thumb"><i class="fas fa-store"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">Invoice</p>
                    <p class="value">{{ $totalInvoices ?? 0 }}</p>
                </div>
                <div class="thumb"><i class="fas fa-store"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">$ Total Sale</p>
                    <p class="value">{{ number_format($totalSale ?? 0, 2) }}</p>
                </div>
                <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">$ Vat Collection</p>
                    <p class="value">{{ number_format($vatCollection ?? 0, 2) }}</p>
                </div>
                <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <p class="title">$ Total Collection</p>
                    <p class="value">{{ number_format($totalCollection ?? 0, 2) }}</p>
                </div>
                <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>
    </main>