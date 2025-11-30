<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahaKarya - Platform Portofolio Mahasiswa Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#667eea',
                        secondary: '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #fff 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-black text-white">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full px-8 py-6 flex justify-between items-center z-50 backdrop-blur-lg bg-black/80 border-b border-white/10">
        <div class="text-3xl font-extrabold gradient-text">
            MahaKarya
        </div>
        <div class="flex gap-4 items-center">
            <!-- Desktop Menu -->
            <div class="hidden md:flex gap-8 items-center mr-4">
                <a href="#fitur" class="text-white/80 hover:text-primary transition-colors font-medium">Fitur</a>
                <a href="#cara" class="text-white/80 hover:text-primary transition-colors font-medium">Cara Kerja</a>
                <a href="#tentang" class="text-white/80 hover:text-primary transition-colors font-medium">Tentang</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex gap-3 items-center">
                <a href="/login" class="inline-block px-5 py-2 text-white/80 border border-transparent hover:border-white/30 rounded-lg text-sm font-medium transition-all">
                    Log in
                </a>
                <a href="/register" class="inline-block px-5 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg text-sm font-semibold hover:scale-105 hover:shadow-lg hover:shadow-primary/50 transition-all">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center px-8 pt-32 pb-16 bg-gradient-to-b from-[#1a1a2e] to-black">
        <div class="max-w-7xl w-full grid md:grid-cols-2 gap-16 items-center">
            <!-- Left Content -->
            <div>
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 gradient-text">
                    Pamerkan Karya, Raih Inspirasi
                </h1>
                <p class="text-xl text-white/70 mb-8 leading-relaxed">
                    Platform sosial media khusus mahasiswa Indonesia untuk memamerkan portofolio, berbagi pencapaian, dan menemukan inspirasi dari karya teman-teman satu generasi.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/register" class="bg-gradient-to-r from-primary to-secondary text-white px-10 py-4 rounded-full font-semibold hover:scale-105 hover:shadow-xl hover:shadow-primary/50 transition-all inline-block">
                        Gabung Gratis
                    </a>
                    <button class="bg-transparent text-white px-10 py-4 rounded-full font-semibold border-2 border-white/30 hover:border-primary hover:bg-primary/10 transition-all">
                        Lihat Demo
                    </button>
                </div>
                <div class="flex gap-8 mt-12 text-sm">
                    <div>
                        <div class="text-3xl font-bold gradient-text">10K+</div>
                        <div class="text-white/60">Mahasiswa</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold gradient-text">50K+</div>
                        <div class="text-white/60">Karya</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold gradient-text">100+</div>
                        <div class="text-white/60">Universitas</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Mock Portfolio -->
            <div class="animate-float">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-white/10 rounded-2xl p-6 backdrop-blur-lg hover:scale-105 hover:shadow-xl hover:shadow-primary/30 transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-secondary"></div>
                            <div>
                                <h4 class="text-sm font-semibold">Andi Pratama</h4>
                                <p class="text-xs text-white/50">UI/UX Design</p>
                            </div>
                        </div>
                        <div class="w-full h-32 bg-gradient-to-br from-primary to-secondary rounded-xl mb-3"></div>
                        <div class="flex gap-4 text-xs text-white/60">
                            <span>❤️ 234</span>
                            <span>💬 12</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-white/10 rounded-2xl p-6 backdrop-blur-lg hover:scale-105 hover:shadow-xl hover:shadow-primary/30 transition-all mt-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-secondary to-primary"></div>
                            <div>
                                <h4 class="text-sm font-semibold">Siti Nurhaliza</h4>
                                <p class="text-xs text-white/50">Web Developer</p>
                            </div>
                        </div>
                        <div class="w-full h-32 bg-gradient-to-br from-secondary to-primary rounded-xl mb-3"></div>
                        <div class="flex gap-4 text-xs text-white/60">
                            <span>❤️ 189</span>
                            <span>💬 8</span>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-white/10 rounded-2xl p-6 backdrop-blur-lg hover:scale-105 hover:shadow-xl hover:shadow-primary/30 transition-all -mt-4">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-secondary"></div>
                            <div>
                                <h4 class="text-sm font-semibold">Budi Santoso</h4>
                                <p class="text-xs text-white/50">Graphic Design</p>
                            </div>
                        </div>
                        <div class="w-full h-32 bg-gradient-to-br from-primary to-secondary rounded-xl mb-3"></div>
                        <div class="flex gap-4 text-xs text-white/60">
                            <span>❤️ 312</span>
                            <span>💬 15</span>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-white/10 rounded-2xl p-6 backdrop-blur-lg hover:scale-105 hover:shadow-xl hover:shadow-primary/30 transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-secondary to-primary"></div>
                            <div>
                                <h4 class="text-sm font-semibold">Dewi Lestari</h4>
                                <p class="text-xs text-white/50">3D Artist</p>
                            </div>
                        </div>
                        <div class="w-full h-32 bg-gradient-to-br from-secondary to-primary rounded-xl mb-3"></div>
                        <div class="flex gap-4 text-xs text-white/60">
                            <span>❤️ 267</span>
                            <span>💬 20</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="px-8 py-32 bg-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">
                    Fitur Unggulan
                </h2>
                <p class="text-xl text-white/60">
                    Semua yang kamu butuhkan untuk membangun personal branding
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        📱
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Feed Personal</h3>
                    <p class="text-white/60 leading-relaxed">
                        Posting karya terbaikmu dan dapatkan apresiasi dari komunitas mahasiswa se-Indonesia. Like, comment, dan share!
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        🔍
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Explore Tab</h3>
                    <p class="text-white/60 leading-relaxed">
                        Temukan inspirasi dari ribuan karya mahasiswa lainnya. Filter berdasarkan kategori, kampus, atau trending topics.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        👥
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Follow System</h3>
                    <p class="text-white/60 leading-relaxed">
                        Follow kreator favoritmu dan dapatkan notifikasi setiap ada karya baru. Build your network, build your future!
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        💼
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Portfolio Builder</h3>
                    <p class="text-white/60 leading-relaxed">
                        Susun portofolio profesional dengan mudah. Showcase skills, projects, dan achievements dalam satu tempat.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        🏆
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Achievement Badge</h3>
                    <p class="text-white/60 leading-relaxed">
                        Dapatkan badge dan recognition atas prestasi akademik maupun non-akademik. Tunjukkan keunggulanmu!
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-10 rounded-3xl hover:scale-105 hover:border-primary hover:shadow-2xl hover:shadow-primary/20 transition-all">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-3xl mb-6">
                        🎯
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Opportunity Feed</h3>
                    <p class="text-white/60 leading-relaxed">
                        Akses info lowongan magang, kompetisi, dan scholarship yang sesuai dengan minat dan skill kamu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="cara" class="px-8 py-32 bg-gradient-to-b from-black via-[#1a1a2e] to-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">
                    Cara Kerja
                </h2>
                <p class="text-xl text-white/60">
                    Mulai perjalanan digital portfolio-mu dalam 3 langkah mudah
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-4xl font-extrabold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Daftar & Setup Profil</h3>
                    <p class="text-white/60 leading-relaxed">
                        Buat akun dengan email kampus, lengkapi profil dengan foto, bio, dan skills yang kamu miliki.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-4xl font-extrabold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Upload Karya</h3>
                    <p class="text-white/60 leading-relaxed">
                        Posting project, design, code, atau karya apapun yang ingin kamu pamerkan ke komunitas.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-4xl font-extrabold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Connect & Grow</h3>
                    <p class="text-white/60 leading-relaxed">
                        Follow teman, like karya inspiratif, dan bangun network untuk masa depan karirmu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="px-8 py-32 bg-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">
                    Kata Mereka
                </h2>
                <p class="text-xl text-white/60">
                    Ribuan mahasiswa sudah merasakan manfaatnya
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-8 rounded-3xl">
                    <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-white/70 mb-6 leading-relaxed">
                        "MahaKarya bantu banget buat showcase portfolio aku. Sekarang udah dapet banyak tawaran freelance!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-secondary"></div>
                        <div>
                            <h4 class="font-semibold">Rara Wijaya</h4>
                            <p class="text-sm text-white/50">UI/UX Designer, ITB</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-8 rounded-3xl">
                    <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-white/70 mb-6 leading-relaxed">
                        "Platform yang pas buat mahasiswa! Bisa belajar dari karya temen-temen dan dapet banyak inspirasi."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-secondary to-primary"></div>
                        <div>
                            <h4 class="font-semibold">Arif Rahman</h4>
                            <p class="text-sm text-white/50">Software Engineer, UI</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border border-white/10 p-8 rounded-3xl">
                    <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-white/70 mb-6 leading-relaxed">
                        "Networking jadi lebih mudah! Ketemu banyak kreator keren dan kolaborasi di berbagai project."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-secondary"></div>
                        <div>
                            <h4 class="font-semibold">Dina Puspita</h4>
                            <p class="text-sm text-white/50">Content Creator, UGM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="px-8 py-32 bg-gradient-to-br from-primary/10 to-secondary/10 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Pamerkan Karya Terbaikmu?
            </h2>
            <p class="text-xl text-white/70 mb-10 leading-relaxed">
                Bergabunglah dengan ribuan mahasiswa Indonesia yang sudah membangun personal branding mereka di MahaKarya. Gratis selamanya!
            </p>
            <a href="/register" class="bg-gradient-to-r from-primary to-secondary text-white px-12 py-5 rounded-full font-bold text-lg hover:scale-110 hover:shadow-2xl hover:shadow-primary/50 transition-all inline-block">
                Mulai Sekarang - Gratis! 🚀
            </a>
            <p class="text-sm text-white/50 mt-6">
                ✓ Tanpa kartu kredit ✓ Setup 2 menit ✓ Akses semua fitur
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer id="tentang" class="px-8 py-12 bg-black border-t border-white/10">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="text-2xl font-extrabold gradient-text mb-4">MahaKarya</div>
                    <p class="text-white/60 text-sm leading-relaxed">
                        Platform portfolio & networking untuk mahasiswa Indonesia yang ingin membangun personal branding.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Platform</h4>
                    <ul class="space-y-2 text-white/60 text-sm">
                        <li><a href="#fitur" class="hover:text-primary transition-colors">Fitur</a></li>
                        <li><a href="#cara" class="hover:text-primary transition-colors">Cara Kerja</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Komunitas</h4>
                    <ul class="space-y-2 text-white/60 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Events</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Discord</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Ambassador</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-white/60 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Kontak</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/10 text-center text-white/50 text-sm">
                <p>© 2024 MahaKarya. Made with ❤️ for Indonesian Students.</p>
            </div>
        </div>
    </footer>
</body>

</html>