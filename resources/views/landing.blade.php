<x-guest-layout>
    
    {{-- AUDIO PLAYER (WAJIB ADA) --}}
    <audio id="bgm-player" loop>
        {{-- Pastikan file audio kamu ada di public/audio/bgm_landing.mp3 --}}
        <source src="{{ asset('audio/bgm_landing.mp3') }}" type="audio/mp3">
        Browser Anda tidak mendukung tag audio.
    </audio>

    {{-- Main Wrapper: Dibuat Full Height dan Snap Scroll (Kunci Perubahan) --}}
    <div class="h-screen overflow-y-scroll snap-y snap-mandatory bg-white dark:bg-black text-gray-900 dark:text-white transition-colors duration-500 overflow-x-hidden">
        
        {{-- 1. HERO SECTION & STATS (FULL LAYAR VERTICAL) --}}
        <div class="snap-start max-w-7xl mx-auto pt-20 pb-16 px-6 lg:px-8 min-h-screen flex items-center">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">
                
                {{-- Kiri: Copywriting --}}
                <div class="lg:col-span-7 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 text-blue-600 dark:text-blue-300 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span> Platform Terjosjis Mahasiswa GEN-ZET
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold mb-6 tracking-tight leading-tight">
                        Pamerkan Karya, <br>
                        Raih <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                            {{-- TARGET ANIMASI: SPAN INI --}}
                            <span id="animated-text">Inspirasi.</span>
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-xl leading-relaxed">
                        Gabung dengan jaringan kartel mahasiswa kreatif terbesar di Indonesia. Melalui bangun tidur buat portofolio, lalu temukan sensei terbaik versi mu, dan wujudkan kolaborasi impianmu.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-12">
                        {{-- Tombol CTA (Diberi class stop-bgm) --}}
                        <a href="{{ route('register') }}" class="stop-bgm btn-fix-text bg-gray-900 dark:bg-white !text-white dark:!text-black font-bold py-4 px-8 rounded-full text-lg shadow-xl hover:transform hover:-translate-y-1 transition-all">
                            Mulai Sekarang
                        </a>
                        
                        {{-- TOMBOL TONTON DEMO (Membuka Modal) --}}
                        <button 
                            id="demo-button" 
                            data-youtube-id="dQw4w9WgXcQ" {{-- GANTI DENGAN ID VIDEO YOUTUBE KAMU --}}
                            class="flex items-center gap-2 px-8 py-4 rounded-full border border-gray-200 dark:border-gray-800 font-bold hover:bg-gray-50 dark:hover:bg-white/5 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Tonton Demo
                        </button>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-8 border-t border-gray-100 dark:border-gray-800 pt-8 max-w-md">
                        <div>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">3</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500 font-medium">Creator</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">50</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500 font-medium">Karya</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">1</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500 font-medium">Kampus</p>
                        </div>
                    </div>

                    {{-- Instruksi Click to Play (Relokasi di bawah Stats) --}}
                    <p id="audio-instruction" class="text-sm text-gray-500 dark:text-gray-500 font-medium mt-6 animate-pulse transition-opacity">
                        Klik di mana saja pada layar untuk memuat latar musik (BGM)...
                    </p>
                </div>

                {{-- Kanan: MOCKUP UI DENGAN CAROUSEL GAMBAR --}}
                <div class="lg:col-span-5 relative hidden lg:block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-[2rem] blur-3xl opacity-20 animate-pulse"></div>
                    <div class="relative bg-white dark:bg-[#121212] border border-gray-200 dark:border-gray-800 rounded-[2rem] shadow-2xl p-6 rotate-3 hover:rotate-0 transition-transform duration-700 ease-out">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border-2 border-white dark:border-gray-700 shadow-sm">
                                    <img src="https://ui-avatars.com/api/?name=Alex+S&background=0D8ABC&color=fff" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="w-24 h-3 bg-gray-200 dark:bg-gray-700 rounded-full mb-1.5"></div>
                                    <div class="w-16 h-2 bg-gray-100 dark:bg-gray-800/50 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <div class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                                <div class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                                <div class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                            </div>
                        </div>
                        
                        {{-- TEMPAT GAMBAR CAROUSEL --}}
                        <div id="image-carousel" 
                            class="w-full aspect-[4/3] bg-gray-100 dark:bg-black rounded-2xl mb-5 flex items-center justify-center overflow-hidden relative group bg-cover bg-center transition-opacity duration-700" 
                            style="background-image: url('https://images5.alphacoders.com/140/thumb-1920-1403120.png'); opacity: 1;"
                        >
                            <div class="absolute bottom-4 right-4 bg-white/90 dark:bg-black/80 backdrop-blur-md px-3 py-1.5 rounded-lg shadow-lg border border-white/20">
                                <p class="text-xs font-bold text-gray-900 dark:text-white">UI Exploration</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex gap-4">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-100 dark:border-gray-800 text-gray-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                            </div>
                            <div class="w-24 h-8 bg-black dark:bg-white rounded-lg flex items-center justify-center">
                                <span class="text-[10px] font-bold text-white dark:text-black"> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- 2. FITUR UNGGULAN (DIBUAT FULL LAYAR VERTICAL) --}}
        <div id="features" class="snap-start py-24 bg-gray-50 dark:bg-[#0a0a0a] border-t border-gray-200 dark:border-gray-900 min-h-screen flex items-center">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-900 dark:text-white">Semua yang Kamu Butuhkan</h2>
                    <p class="text-gray-600 dark:text-gray-400">Fitur lengkap untuk mendukung perjalanan karir dan personal branding mahasiswa Indonesia.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Fitur Cards --}}
                    <div class="bg-white dark:bg-[#121212] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6 text-blue-600 dark:text-blue-400">
                            <i class="bi bi-phone text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Feed Personal</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">Posting karya terbaikmu dan dapatkan apresiasi dari komunitas mahasiswa se-Indonesia.</p>
                    </div>
                    {{-- (Fitur lainnya tetap sama) --}}
                    <div class="bg-white dark:bg-[#121212] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6 text-purple-600 dark:text-purple-400">
                            <i class="bi bi-search text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Explore Tab</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">Temukan inspirasi dari ribuan karya mahasiswa lainnya. Filter berdasarkan kategori atau kampus.</p>
                    </div>
                    <div class="bg-white dark:bg-[#121212] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-2xl flex items-center justify-center mb-6 text-pink-600 dark:text-pink-400">
                            <i class="bi bi-people text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Follow System</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">Bangun jejaring dengan mengikuti kreator favoritmu. Jangan lewatkan update karya terbaru.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. TESTIMONI (DIBUAT FULL LAYAR VERTICAL) --}}
        <div class="snap-start py-24 border-t border-gray-200 dark:border-gray-800 min-h-screen flex items-center">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-center mb-16 text-gray-900 dark:text-white">"Kata Mereka"</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Reviews --}}
                    <div class="bg-gray-50 dark:bg-[#121212] p-8 rounded-2xl border border-transparent hover:border-gray-200 dark:hover:border-gray-800 transition-all">
                        <div class="flex text-yellow-400 mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed text-sm">"MahaKarya bantu banget buat showcase portofolio aku. Sekarang udah dapet banyak tawaran freelance!"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">G</div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-900 dark:text-white">Ganendra Wishnu W.</h4>
                                <p class="text-xs text-gray-500">NRP. 2423600032 - Backend Engineer, PENS</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-[#121212] p-8 rounded-2xl border border-transparent hover:border-gray-200 dark:hover:border-gray-800 transition-all">
                        <div class="flex text-yellow-400 mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed text-sm">"Platform yang pas buat mahasiswa! Bisa belajar dari karya temen-temen dan dapet banyak inspirasi."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-sm">A</div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-900 dark:text-white">Muhammad Aprieldauzi F</h4>
                                <p class="text-xs text-gray-500">NRP. 2423600054 - Frontend Engineer, PENS</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-[#121212] p-8 rounded-2xl border border-transparent hover:border-gray-200 dark:hover:border-gray-800 transition-all">
                        <div class="flex text-yellow-400 mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed text-sm">"Networking jadi lebih mudah! Ketemu banyak kreator keren dan kolaborasi di berbagai project kampus."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold text-sm">D</div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-900 dark:text-white">R. Gusti Aryakusuma Dewa Wijaya</h4>
                                <p class="text-xs text-gray-500">NRP. 2423600058 - UI/UX Designer, PENS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. FINAL CTA (DIBUAT FULL LAYAR VERTICAL) --}}
        <div class="snap-start py-24 px-6 text-center bg-gray-900 dark:bg-[#0a0a0a] min-h-screen flex items-center">
            <div class="max-w-3xl mx-auto w-full">
                <h2 class="text-3xl md:text-5xl font-black mb-6 tracking-tight" style="color: white !important;">Siap Pamerkan Karya Terbaikmu?</h2>
                <p class="text-gray-400 text-lg mb-10" style="color: #9ca3af !important;">Bergabunglah dengan mahasiswa kreatif di Indonesia yang sudah membangun personal branding mereka di MahaKarya.</p>
                <a href="{{ route('register') }}" class="register-trigger inline-block bg-white text-black hover:bg-gray-100 font-bold py-4 px-12 rounded-full text-lg shadow-2xl transition-all transform hover:-translate-y-1">
                    Buat Akun
                </a>
                <p class="mt-6 text-sm text-gray-500" style="color: #6b7280 !important;">Tanpa bayar • Setup 2 menit • Akses semua fitur</p>
            </div>
        </div>

        {{-- FOOTER --}}
        <footer class="py-12 px-6 border-t border-gray-200 dark:border-gray-900 text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-black">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <span class="font-bold text-lg text-black dark:text-white block mb-1">MahaKarya</span>
                    <span>© 2024 Made with ❤️ for Indonesian Students.</span>
                </div>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Tentang</a>
                    <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Fitur</a>
                    <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Privasi</a>
                    <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Kontak</a>
                </div>
            </div>
        </footer>
    </div>
    
    {{-- MODAL YOUTUBE DEMO (Sembunyikan Awalnya) --}}
    <div id="youtube-modal" class="fixed inset-0 z-[100] bg-black/90 hidden flex items-center justify-center p-4" onclick="closeYoutubeModal(event)">
        <div class="w-full max-w-4xl bg-black rounded-lg overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
            <div class="relative pb-[56.25%] h-0"> {{-- Aspect Ratio 16:9 --}}
                <iframe id="youtube-iframe" class="absolute top-0 left-0 w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <button class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition-colors" onclick="closeYoutubeModal(event)">&times;</button>
    </div>

</x-guest-layout>

<script>
// --- VARIABEL GLOBAL ---
const bgmPlayer = document.getElementById('bgm-player');
const body = document.body;
const instruction = document.getElementById('audio-instruction');

// Daftar kata yang akan diganti secara berulang
const animatedWords = [
    "Inspirasi.",
    "Jaringan.",
    "Kolaborasi.",
    "Portofolio.",
];
let wordIndex = 0;
let charIndex = 0;
let isDeleting = false;
let typeSpeed = 100;
const element = document.getElementById('animated-text');


// --- FUNGSI TYPEWRITER (MENGETIK MENGHAPUS) ---
function typeWriterEffect() {
    if (!element) return;
    
    const currentWord = animatedWords[wordIndex];
    
    if (isDeleting) {
        // Menghapus
        element.textContent = currentWord.substring(0, charIndex--);
        typeSpeed = 50; 
    } else {
        // Mengetik
        element.textContent = currentWord.substring(0, charIndex++);
        typeSpeed = 100;
    }

    // Pergantian fase
    if (!isDeleting && charIndex === currentWord.length + 1) {
        // Tunggu sejenak setelah selesai mengetik
        typeSpeed = 1500; 
        isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % animatedWords.length; // Pindah ke kata berikutnya
        typeSpeed = 500; // Tunggu sejenak sebelum mengetik kata baru
    }

    setTimeout(typeWriterEffect, typeSpeed);
}


// --- FUNGSI CAROUSEL GAMBAR ---

// Daftar URL gambar yang akan diganti (GANTI INI DENGAN GAMBAR KAMU SENDIRI)
const carouselImages = [
    'https://images5.alphacoders.com/140/thumb-1920-1403120.png', // Gambar 1 (default)
    'https://images5.alphacoders.com/140/thumb-1920-1403297.jpg', // Gambar 2 (Ganti)
    'https://images5.alphacoders.com/140/thumb-1920-1403300.jpg', // Gambar 3 (Ganti)
    'https://i.ytimg.com/vi/UwlnVwxzpb4/maxresdefault.jpg', // Gambar 4 (Ganti)
];
let currentImageIndex = 0;
const imageElement = document.getElementById('image-carousel');

function imageCarousel() {
    if (!imageElement) return;

    // 1. Fade Out (Transisi Opacity) - DIUBAH MENJADI 0.0 AGAR HILANG TOTAL
    // Kita biarkan durasi 700ms di CSS yang menangani transisinya
    imageElement.style.opacity = '0.0'; 
    
    setTimeout(() => {
        // 2. Ganti Gambar
        currentImageIndex = (currentImageIndex + 1) % carouselImages.length;
        const nextImage = carouselImages[currentImageIndex];
        
        // Mengubah background-image
        imageElement.style.backgroundImage = `url('${nextImage}')`;

        // 3. Fade In (Smooth)
        imageElement.style.opacity = '1';
    }, 700); 

    // Panggil fungsi lagi setelah interval (misal 4 detik)
    setTimeout(imageCarousel, 4000); 
}


// --- FUNGSI BGM & NAVIGASI ---

// Fungsi untuk mencoba memutar audio (Dipanggil saat klik di layar)
function tryPlayAudio() {
    bgmPlayer.volume = 1.0; // Set volume 100%
    const playPromise = bgmPlayer.play();

    if (playPromise !== undefined) {
        playPromise.then(() => {
            console.log("BGM started successfully.");
            // Hapus event listener agar tidak terulang
            body.removeEventListener('click', tryPlayAudio);
            body.removeEventListener('touchstart', tryPlayAudio);
            if (instruction) instruction.style.opacity = '0';

        }).catch(error => {
            console.warn("BGM blocked, waiting for next user interaction.");
        });
    }
}

// Menghentikan audio saat pindah halaman
function stopAudioOnNavigation(e) {
    if (bgmPlayer && !bgmPlayer.paused) {
        bgmPlayer.pause();
        console.log("BGM paused for navigation.");
    }
    // Biarkan link melanjutkan navigasi
}


// --- FUNGSI MODAL YOUTUBE ---

function openYoutubeModal(youtubeId) {
    stopAudioOnNavigation(); // HENTIKAN BGM SAAT MODAL DIBUKA
    const modal = document.getElementById('youtube-modal');
    const iframe = document.getElementById('youtube-iframe');
    
    // Ganti source iframe dengan video yang diminta
    iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
    modal.classList.remove('hidden');
}

function closeYoutubeModal(event) {
    const modal = document.getElementById('youtube-modal');
    const iframe = document.getElementById('youtube-iframe');
    
    // Hentikan video dengan menghapus src
    iframe.src = ''; 
    modal.classList.add('hidden');
    
    // Opsional: Lanjutkan BGM jika modal ditutup dan BGM diizinkan
    // bgmPlayer.play().catch(e => console.log('BGM needs interaction to resume.'));
}


// --- INITIALIZATION ---
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Mulai Animasi Typewriter di Headline
    typeWriterEffect();
    
    // 2. Mulai Carousel Gambar
    imageCarousel();

    // 3. Setup BGM Start Listener
    body.addEventListener('click', tryPlayAudio);
    body.addEventListener('touchstart', tryPlayAudio);
    
    // 4. Setup Stop BGM Listener untuk Navigasi
    document.querySelectorAll('.stop-bgm, a[href*="/login"], a[href*="/register"]').forEach(link => {
        link.addEventListener('click', stopAudioOnNavigation);
    });

    // 5. Setup Tombol Demo
    const demoButton = document.getElementById('demo-button');
    if (demoButton) {
        demoButton.addEventListener('click', function() {
            const youtubeId = this.getAttribute('data-youtube-id');
            openYoutubeModal(youtubeId);
        });
    }
});
</script>