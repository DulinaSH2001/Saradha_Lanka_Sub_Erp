<div class="flex flex-col h-full">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center py-6 px-4 border-b border-gray-200">
        <div class="flex items-center">
            <div
                class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold text-xl">SL</span>
            </div>
            <div class="ml-3">
                <h2 class="text-lg font-bold text-gray-900">Saradha Lanka</h2>
                <p class="text-xs text-green-600 font-medium">ERP System</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto" x-data="{
        openSection: '{{ request()->is('masters*') ? 'masters' : (request()->is('sales*') ? 'sales' : (request()->is('inventory*') ? 'inventory' : (request()->is('purchasing*') ? 'purchasing' : (request()->is('accounting*') ? 'accounting' : (request()->is('hr*') ? 'hr' : ''))))) }}',

        init() {
            // Load saved state from localStorage if no active route
            if (!this.openSection) {
                const saved = localStorage.getItem('sidebar-open-section');
                if (saved) {
                    this.openSection = saved;
                }
            }

            // Watch for changes and save to localStorage
            this.$watch('openSection', (value) => {
                localStorage.setItem('sidebar-open-section', value || '');
            });
        },

        toggleSection(section) {
            // If clicking the same section, toggle it
            // If clicking a different section, switch to it
            this.openSection = this.openSection === section ? '' : section;
        },

        isOpen(section) {
            return this.openSection === section;
        }
    }">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <i
                    class="fas fa-tachometer-alt w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-green-500' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                Dashboard
            </a>

            <!-- Masters Section -->
            <div>
                <button @click="toggleSection('masters')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('masters*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-database w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('masters*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Masters
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': isOpen('masters') }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('masters')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/masters/customers"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('masters/customers*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-users w-4 h-4 mr-2 {{ request()->is('masters/customers*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Customers
                    </a>
                    <a href="{{ route('sites.index') }}"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('masters/sites*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-map-marker-alt w-4 h-4 mr-2 {{ request()->is('masters/sites*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Sites
                    </a>
                    <a href="/masters/items"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('masters/items*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-boxes w-4 h-4 mr-2 {{ request()->is('masters/items*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Items
                    </a>
                    <a href="/masters/suppliers"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('masters/suppliers*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-truck w-4 h-4 mr-2 {{ request()->is('masters/suppliers*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Suppliers
                    </a>
                </div>
            </div>

            <!-- Sales Section -->
            <div>
                <button @click="toggleSection('sales')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('sales*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-tags w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('sales*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Sales
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': isOpen('sales') }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('sales')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/sales/orders"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('sales/orders*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-shopping-cart w-4 h-4 mr-2 {{ request()->is('sales/orders*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Orders
                    </a>
                    <a href="/sales/invoices"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('sales/invoices*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-file-invoice-dollar w-4 h-4 mr-2 {{ request()->is('sales/invoices*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Invoices
                    </a>
                    <a href="/sales/customers"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('sales/customers*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-user-friends w-4 h-4 mr-2 {{ request()->is('sales/customers*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Customers
                    </a>
                    <a href="/sales/products"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('sales/products*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-cube w-4 h-4 mr-2 {{ request()->is('sales/products*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Products
                    </a>
                </div>
            </div>

            <!-- Inventory Section -->
            <div>
                <button @click="toggleSection('inventory')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('inventory*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-boxes w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('inventory*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Inventory
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': isOpen('inventory') }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('inventory')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/inventory/stock"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('inventory/stock*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-clipboard-list w-4 h-4 mr-2 {{ request()->is('inventory/stock*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Stock Management
                    </a>
                    <a href="/inventory/warehouses"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('inventory/warehouses*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-warehouse w-4 h-4 mr-2 {{ request()->is('inventory/warehouses*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Warehouses
                    </a>
                    <a href="/inventory/transfers"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('inventory/transfers*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-exchange-alt w-4 h-4 mr-2 {{ request()->is('inventory/transfers*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Stock Transfer
                    </a>
                    <a href="/inventory/reports"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('inventory/reports*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-chart-line w-4 h-4 mr-2 {{ request()->is('inventory/reports*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Stock Reports
                    </a>
                </div>
            </div>

            <!-- Purchasing Section -->
            <div>
                <button @click="toggleSection('purchasing')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('purchasing*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-shopping-cart w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('purchasing*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Purchasing
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-90': isOpen('purchasing') }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('purchasing')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/purchasing/orders"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('purchasing/orders*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-file-alt w-4 h-4 mr-2 {{ request()->is('purchasing/orders*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Purchase Orders
                    </a>
                    <a href="/purchasing/suppliers"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('purchasing/suppliers*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-truck w-4 h-4 mr-2 {{ request()->is('purchasing/suppliers*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Suppliers
                    </a>
                    <a href="/purchasing/receipts"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('purchasing/receipts*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-receipt w-4 h-4 mr-2 {{ request()->is('purchasing/receipts*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Receipts
                    </a>
                </div>
            </div>

            <!-- Accounting Section -->
            <div>
                <button @click="toggleSection('accounting')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('accounting*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-calculator w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('accounting*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Accounting
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-90': isOpen('accounting') }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('accounting')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/accounting/ledger"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('accounting/ledger*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-book w-4 h-4 mr-2 {{ request()->is('accounting/ledger*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        General Ledger
                    </a>
                    <a href="/accounting/payables"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('accounting/payables*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-money-bill-wave w-4 h-4 mr-2 {{ request()->is('accounting/payables*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Accounts Payable
                    </a>
                    <a href="/accounting/receivables"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('accounting/receivables*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-hand-holding-usd w-4 h-4 mr-2 {{ request()->is('accounting/receivables*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Accounts Receivable
                    </a>
                    <a href="/accounting/reports"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('accounting/reports*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-chart-pie w-4 h-4 mr-2 {{ request()->is('accounting/reports*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Financial Reports
                    </a>
                </div>
            </div>

            <!-- HR Section -->
            <div>
                <button @click="toggleSection('hr')"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('hr*') ? 'bg-green-100 text-green-700 border-r-4 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                    <div class="flex items-center">
                        <i
                            class="fas fa-users w-5 h-5 mr-3 transition-colors duration-200 {{ request()->is('hr*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}"></i>
                        Human Resources
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': isOpen('hr') }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="isOpen('hr')" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-2 ml-8 space-y-1">
                    <a href="/hr/employees"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('hr/employees*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-id-badge w-4 h-4 mr-2 {{ request()->is('hr/employees*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Employees
                    </a>
                    <a href="/hr/payroll"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('hr/payroll*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-coins w-4 h-4 mr-2 {{ request()->is('hr/payroll*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Payroll
                    </a>
                    <a href="/hr/attendance"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('hr/attendance*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-calendar-check w-4 h-4 mr-2 {{ request()->is('hr/attendance*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Attendance
                    </a>
                    <a href="/hr/performance"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 {{ request()->is('hr/performance*') ? 'bg-green-100 text-green-700 border-r-2 border-green-500 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-600 hover:translate-x-1' }}">
                        <i
                            class="fas fa-chart-bar w-4 h-4 mr-2 {{ request()->is('hr/performance*') ? 'text-green-600' : 'text-gray-400' }}"></i>
                        Performance
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Reports -->
            <a href="#"
                class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                <i class="fas fa-chart-bar w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500"></i>
                Reports
            </a>

            <!-- Settings -->
            <a href="#"
                class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                <i class="fas fa-cog w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500"></i>
                Settings
            </a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-gray-200">
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Need Help?</h3>
                    <p class="text-xs text-green-600">Contact support for assistance</p>
                </div>
            </div>
            <div class="mt-3">
                <button
                    class="w-full bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Contact Support
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>