<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami – Bookify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html { scroll-behavior: smooth; }

        body {
            background: #06040f;
            color: #f0eaff;
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background effects */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image: none;
            background-size: 48px 48px;
            z-index: -2;
            pointer-events: none;
        }

        .orb1 { 
            position: fixed; 
            top: -150px; 
            left: -120px; 
            width: 500px; 
            height: 500px; 
            background: rgba(124,106,247,0.15); 
            border-radius: 50%; 
            filter: blur(80px); 
            z-index: -1; 
            pointer-events: none; 
        }

        .orb2 { 
            position: fixed; 
            bottom: -100px; 
            right: -100px; 
            width: 300px; 
            height: 300px; 
            background: rgba(79,130,246,0.10); 
            border-radius: 50%; 
            filter: blur(80px); 
            z-index: -1; 
            pointer-events: none; 
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(6,4,15,0.7);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(139,92,246,0.25);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .nav-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #f0eaff;
            line-height: 1.1;
        }

        .nav-brand-sub {
            font-size: 10px;
            color: rgba(196,181,253,0.6);
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: rgba(196,181,253,0.8);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
            position: relative;
        }

        .nav-link:hover {
            color: #f0eaff;
        }

        .nav-link.active {
            color: #a78bfa;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            transition: width 0.2s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 40px 60px;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            margin-bottom: 80px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f0eaff, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(196,181,253,0.7);
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        /* Content Sections */
        .section {
            margin-bottom: 80px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #f0eaff;
        }

        .section-content {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(139,92,246,0.25);
            border-radius: 20px;
            padding: 40px;
            line-height: 1.8;
            color: rgba(196,181,253,0.8);
        }

        .section-content p {
            margin-bottom: 20px;
            text-align: justify;
        }

        .section-content p:last-child {
            margin-bottom: 0;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .feature-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(139,92,246,0.25);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: rgba(139,92,246,0.5);
            background: rgba(255,255,255,0.08);
        }

        .feature-icon svg {
            width: 40px;
            height: 40px;
            display: block;
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 12px;
            color: #f0eaff;
        }

        .feature-desc {
            font-size: 0.95rem;
            color: rgba(196,181,253,0.7);
            line-height: 1.6;
        }

        /* Team Section */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .team-member {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(139,92,246,0.25);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-8px);
            border-color: rgba(139,92,246,0.5);
            background: rgba(255,255,255,0.08);
        }

        .team-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .team-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #f0eaff;
        }

        .team-role {
            font-size: 0.9rem;
            color: #a78bfa;
            margin-bottom: 12px;
        }

        .team-bio {
            font-size: 0.9rem;
            color: rgba(196,181,253,0.7);
            line-height: 1.6;
        }

        /* CTA Button */
        .cta-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 40px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(124,58,237,0.4);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 40px;
            color: rgba(196,181,253,0.6);
            border-top: 1px solid rgba(139,92,246,0.25);
            margin-top: 80px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 100px 20px 40px;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .section-content {
                padding: 24px;
            }

            nav {
                padding: 0 1rem;
            }

            .nav-links {
                gap: 1rem;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Background -->
    <div class="bg-grid"></div>
    <div class="orb1"></div>
    <div class="orb2"></div>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('welcome') }}" class="nav-brand">
            <div class="nav-brand-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
            </div>
            <div>
                <div class="nav-brand-text">Bookify</div>
                <div class="nav-brand-sub">DIGITAL LIBRARY</div>
            </div>
        </a>
        <div class="nav-links">
            <a href="{{ route('welcome') }}" class="nav-link">Beranda</a>
            <a href="{{ route('books.index') }}" class="nav-link">Jelajahi Buku</a>
            <a href="{{ route('about') }}" class="nav-link active">Tentang Kami</a>
            @if(auth()->check())
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-link">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Masuk</a>
            @endif
        </div>
    </nav>

    <!-- Container -->
    <div class="container">
        <!-- Hero Section -->
        <div class="hero">
            <h1 class="hero-title">Tentang Bookify</h1>
            <p class="hero-subtitle">Platform digital terpadu untuk mencintai buku dan berbagi pengetahuan bersama komunitas pembaca Indonesia</p>
        </div>

        <!-- About Us Section -->
        <div class="section">
            <h2 class="section-title">Siapa Kami?</h2>
            <div class="section-content">
                <p>
                    Bookify adalah sebuah platform digital library yang didedikasikan untuk menyediakan akses mudah terhadap berbagai koleksi buku berkualitas. Kami percaya bahwa membaca adalah jendela dunia dan setiap orang berhak memiliki akses ke pengetahuan.
                </p>
                <p>
                    Didirikan pada tahun 2024, Bookify telah berkembang menjadi platform yang melayani ribuan pembaca di seluruh Indonesia. Kami menyediakan lebih dari 1000+ judul buku dari berbagai kategori, mulai dari fiksi, sains, teknologi, bisnis, hingga agama dan spiritual.
                </p>
                <p>
                    Misi kami adalah membuat membaca menjadi lebih mudah, terjangkau, dan menyenangkan bagi semua kalangan. Dengan kombinasi buku fisik dan e-book, kami memberikan fleksibilitas kepada pembaca untuk memilih format yang paling sesuai dengan gaya hidup mereka.
                </p>
            </div>
        </div>

        <!-- Our Features -->
        <div class="section">
            <h2 class="section-title">Keunggulan Kami</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
                    </span>
                    <div class="feature-title">Koleksi Lengkap</div>
                    <div class="feature-desc">Lebih dari 1000+ judul buku dari berbagai kategori dan penerbit terpercaya</div>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </span>
                    <div class="feature-title">Harga Terjangkau</div>
                    <div class="feature-desc">Harga kompetitif dengan berbagai promosi menarik untuk pembaca setia</div>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 17"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    </span>
                    <div class="feature-title">Akses Cepat</div>
                    <div class="feature-desc">Akses instan untuk e-book dan pengiriman cepat untuk buku fisik</div>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <div class="feature-title">Aman & Terpercaya</div>
                    <div class="feature-desc">Sistem pembayaran aman dan perlindungan data pembaca terjamin</div>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </span>
                    <div class="feature-title">Komunitas Pembaca</div>
                    <div class="feature-desc">Bergabunglah dengan komunitas pembaca untuk berbagi review dan rekomendasi</div>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                    </span>
                    <div class="feature-title">Rekomendasi Personal</div>
                    <div class="feature-desc">Dapatkan rekomendasi buku yang dipersonalisasi berdasarkan preferensi Anda</div>
                </div>
            </div>
        </div>

        <!-- Our Values -->
        <div class="section">
            <h2 class="section-title">Nilai-Nilai Kami</h2>
            <div class="section-content">
                <p>
                    <strong>Aksesibilitas:</strong> Kami percaya bahwa pengetahuan harus dapat diakses oleh semua orang, tanpa memandang latar belakang atau kondisi ekonomi mereka.
                </p>
                <p>
                    <strong>Kualitas:</strong> Kami hanya bekerja sama dengan penerbit dan penulis terpercaya untuk memastikan kualitas konten yang kami tawarkan.
                </p>
                <p>
                    <strong>Inovasi:</strong> Kami terus berinovasi untuk memberikan pengalaman membaca yang lebih baik dan lebih modern kepada pelanggan kami.
                </p>
                <p>
                    <strong>Kepercayaan:</strong> Kepuasan dan kepercayaan pelanggan adalah prioritas utama kami. Kami berkomitmen untuk memberikan layanan terbaik.
                </p>
            </div>
        </div>

        <!-- Team Section -->
        <div class="section">
            <h2 class="section-title">Tim Kami</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="team-avatar">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="avatar1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#a78bfa;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50" fill="url(#avatar1)"/>
                            <circle cx="50" cy="35" r="15" fill="white"/>
                            <path d="M30 65 Q30 55 50 55 Q70 55 70 65 Q70 75 50 80 Q30 75 30 65" fill="white"/>
                        </svg>
                    </div>
                    <div class="team-name">Nabila Alya Chalisa</div>
                    <div class="team-role">Founder & CEO</div>
                    <div class="team-bio">Visioner muda yang berdedikasi untuk membuat membaca lebih mudah dan terjangkau bagi semua.</div>
                </div>
                <div class="team-member">
                    <div class="team-avatar">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="avatar2" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#60a5fa;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50" fill="url(#avatar2)"/>
                            <circle cx="50" cy="35" r="15" fill="white"/>
                            <path d="M20 70 L20 60 Q20 55 25 55 L75 55 Q80 55 80 60 L80 70 Q80 80 50 80 Q20 80 20 70" fill="white"/>
                            <rect x="30" y="62" width="8" height="12" fill="url(#avatar2)"/>
                            <rect x="62" y="62" width="8" height="12" fill="url(#avatar2)"/>
                        </svg>
                    </div>
                    <div class="team-name">Fany Nuurviana</div>
                    <div class="team-role">Head of Operations</div>
                    <div class="team-bio">Memastikan setiap aspek operasional berjalan dengan lancar dan memberikan nilai terbaik kepada pelanggan.</div>
                </div>
                <div class="team-member">
                    <div class="team-avatar">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="avatar3" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#34d399;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#10b981;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50" fill="url(#avatar3)"/>
                            <circle cx="50" cy="30" r="14" fill="white"/>
                            <path d="M30 65 L30 55 Q30 50 35 50 L65 50 Q70 50 70 55 L70 65 Q70 78 50 82 Q30 78 30 65" fill="white"/>
                            <rect x="38" y="68" width="5" height="10" fill="url(#avatar3)"/>
                            <rect x="57" y="68" width="5" height="10" fill="url(#avatar3)"/>
                        </svg>
                    </div>
                    <div class="team-name">Darunnadwah</div>
                    <div class="team-role">Chief Technology Officer</div>
                    <div class="team-bio">Mengembangkan teknologi inovatif untuk pengalaman digital library yang seamless dan responsif.</div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="section">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="section-content" style="text-align: center;">
                <p>
                    <strong>Email:</strong> info@bookify.com<br>
                    <strong>Telepon:</strong> +62 (0721) 8888-5678<br>
                    <strong>Alamat:</strong> Jl. Ahmad Yani No. 456, Bandar Lampung, Lampung 35139
                </p>
                <p>
                    Kami siap membantu Anda dengan pertanyaan atau masukan. Jangan ragu untuk menghubungi kami kapan saja!
                </p>
                <a href="{{ route('books.index') }}" class="cta-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
                    Mulai Jelajahi Buku
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bookify. Semua hak dilindungi. Platform digital library untuk Indonesia.</p>
    </footer>
</body>
</html>
