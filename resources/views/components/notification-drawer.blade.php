<div
    x-show="notificationOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    
    {{-- FIX TEMA: BACKGROUND DAN BORDER UTAMA HARUS DINAMIS --}}
    class="fixed top-0 left-[72px] xl:left-[245px] z-40 h-full w-[397px] bg-white dark:bg-black border-r border-gray-300 dark:border-[#262626] rounded-r-2xl shadow-2xl overflow-hidden transition-colors duration-300"
    style="display: none;"

    {{-- LOGIKA ALPINE JS (Dibiarkan sama) --}}
    x-data="{
        notifications: [],
        isLoading: false,

        async fetchNotifications() {
            this.isLoading = true;
            try {
                const response = await fetch('{{ route('notifications.json') }}');
                const data = await response.json();
                this.notifications = data;
            } catch (error) {
                console.error('Error fetching notifications:', error);
            } finally {
                this.isLoading = false;
            }
        },

        async markAsRead(id) {
            // Optimistic UI Update (Langsung ubah tampilan biar cepat)
            const index = this.notifications.findIndex(n => n.id === id);
            if (index !== -1) this.notifications[index].is_read = true;

            // Kirim request ke server
            await fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
        }
    }"
    {{-- Saat drawer dibuka, otomatis fetch data --}}
    x-init="$watch('notificationOpen', value => { if(value) fetchNotifications() })">
    <div class="flex flex-col h-full">

        <div class="p-6 border-b border-gray-300 dark:border-[#262626] transition-colors duration-300">
            {{-- FIX TEXT COLOR --}}
            <h2 class="text-2xl font-bold mt-2 text-gray-900 dark:text-white transition-colors duration-300">Notifikasi</h2>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar">

            {{-- Loading State --}}
            <div x-show="isLoading" class="flex justify-center py-10">
                <svg class="animate-spin h-6 w-6 text-gray-600 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            {{-- Empty State --}}
            <div x-show="!isLoading && notifications.length === 0" class="flex flex-col items-center justify-center py-20 text-center px-6">
                <div class="w-12 h-12 border-2 border-gray-800 dark:border-white rounded-full flex items-center justify-center mb-4 transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-800 dark:text-white font-bold transition-colors duration-300">Aktivitas di postinganmu</p>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 transition-colors duration-300">Saat seseorang menyukai atau mengomentari postinganmu, kamu akan melihatnya di sini.</p>
            </div>

            {{-- Notification List --}}
            <div x-show="!isLoading && notifications.length > 0">
                <template x-for="notif in notifications" :key="notif.id">
                    <div
                        @click="markAsRead(notif.id)"
                        class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 dark:hover:bg-white/5 cursor-pointer transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-11 h-11 rounded-full bg-gray-200 dark:bg-gray-800 overflow-hidden border border-gray-300 dark:border-[#262626]">
                                    <img :src="notif.avatar" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 rounded-full p-1 border border-white dark:border-black"
                                    :class="notif.type.includes('Like') ? 'bg-red-500' : 'bg-blue-500'">
                                    <svg x-show="notif.type.includes('Like')" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    <svg x-show="!notif.type.includes('Like')" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="text-sm">
                                <p class="leading-snug text-gray-900 dark:text-white">
                                    <span class="font-bold" x-text="notif.data.name || 'Seseorang'"></span>
                                    <span x-text="notif.data.message || 'berinteraksi denganmu.'"></span>
                                    <span class="text-gray-600 dark:text-gray-400 text-xs ml-1" x-text="notif.created_at_human"></span>
                                </p>
                            </div>
                        </div>

                        <div x-show="!notif.is_read" class="w-2 h-2 rounded-full bg-blue-500"></div>
                    </div>
                </template>
            </div>

        </div>
    </div>
</div>

{{-- FIX BACKDROP: Backdrop untuk mobile --}}
<div
    x-show="notificationOpen"
    @click="notificationOpen = false"
    class="fixed inset-0 z-30 bg-black/20 dark:bg-black/50 backdrop-blur-sm lg:hidden transition-colors duration-300"
    style="display: none;"></div>