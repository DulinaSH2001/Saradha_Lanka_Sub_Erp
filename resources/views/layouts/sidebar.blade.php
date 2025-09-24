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
    <nav class="flex-1 px-4 py-6 overflow-y-auto">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-green-500' : 'text-gray-400 group-hover:text-green-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                Dashboard
            </a>

            <!-- Sales Section -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M8 11v6h8v-6M8 11H6a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2h-2">
                            </path>
                        </svg>
                        Sales
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Orders</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Invoices</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Customers</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Products</a>
                </div>
            </div>

            <!-- Inventory Section -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Inventory
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Stock
                        Management</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Warehouses</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Stock
                        Transfer</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Stock
                        Reports</a>
                </div>
            </div>

            <!-- Purchasing Section -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 3H3m4 10v6a1 1 0 001 1h9a1 1 0 001-1v-6"></path>
                        </svg>
                        Purchasing
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Purchase
                        Orders</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Suppliers</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Receipts</a>
                </div>
            </div>

            <!-- Accounting Section -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                        Accounting
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">General
                        Ledger</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Accounts
                        Payable</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Accounts
                        Receivable</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Financial
                        Reports</a>
                </div>
            </div>

            <!-- HR Section -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="group flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        Human Resources
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Employees</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Payroll</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Attendance</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-green-50 hover:text-green-600">Performance</a>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Reports -->
            <a href="#"
                class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Reports
            </a>

            <!-- Settings -->
            <a href="#"
                class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
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