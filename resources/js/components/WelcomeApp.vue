<template>
  <div class="app-wrapper" :class="{ 'is-loaded': isLoaded }">
    <!-- Animated Background -->
    <div class="bg-animated">
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div>
      <div class="noise-overlay"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-navbar" :class="{ 'scrolled': scrollY > 20 }">
      <div class="nav-container">
        <div class="brand">
          <div class="logo-box">
            <img :src="appData.logoUrl" alt="Logo" class="logo" />
          </div>
          <div class="brand-text">
            <span class="brand-title">SI-JANTUNG</span>
            <span class="brand-subtitle">BAPPELITBANG TAPIN</span>
          </div>
        </div>
        <div class="nav-links" v-if="appData.hasLogin">
          <a v-if="appData.isAuth" :href="appData.dashboardUrl" class="btn-glow">
            <span>Dashboard Utama</span>
            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
          </a>
          <a v-else :href="appData.loginUrl" class="btn-glow">
            <span>Login Sistem</span>
            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
          </a>
        </div>
      </div>
    </nav>

    <main class="main-scroll" ref="mainScroll" @scroll="handleScroll">
      
      <!-- Hero Section -->
      <section class="hero">
        <div class="hero-content">
          <div class="badge-wrapper">
            <div class="pulse-dot"></div>
            <span>Sistem Informasi Terintegrasi Bappelitbang Tapin</span>
          </div>
          
          <h1 class="main-title">
            Transformasi Digital <br/>
            <span class="gradient-text">Manajemen & Birokrasi</span>
          </h1>
          
          <p class="hero-desc">
            SI-JANTUNG menghadirkan ekosistem digital untuk mengelola Surat Undangan, Surat Keluar, Dokumen RKPD, dan SPJ secara cerdas, cepat, dan transparan di lingkungan Bappelitbang Kabupaten Tapin.
          </p>

          <div class="action-group">
            <a v-if="appData.isAuth" :href="appData.dashboardUrl" class="btn-primary-large">
              Mulai Bekerja Sekarang
            </a>
            <a v-else :href="appData.loginUrl" class="btn-primary-large">
              Akses Sistem
            </a>
            <a href="#statistik" class="btn-secondary-large">
              Lihat Statistik
            </a>
          </div>
        </div>
      </section>

      <!-- Dashboard Stats Section -->
      <section id="statistik" class="stats-section">
        <div class="section-header">
          <h2 class="section-title">Data <span class="gradient-text">Real-Time</span> Sistem</h2>
          <p class="section-subtitle">Pantauan aktivitas dan pengelolaan dokumen di SI-JANTUNG</p>
        </div>

        <div class="stats-grid">
          <!-- Total Surat -->
          <div class="stat-card">
            <div class="stat-icon-wrapper yellow">
               <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div class="stat-info">
              <h3 class="stat-label">Total Surat</h3>
              <div class="stat-value-row">
                <span class="stat-value">{{ dashboardData.totalSurat }}</span>
                <span class="stat-trend" :class="dashboardData.suratPersen >= 0 ? 'positive' : 'negative'">
                  {{ dashboardData.suratPersen > 0 ? '+' : '' }}{{ dashboardData.suratPersen }}%
                </span>
              </div>
            </div>
          </div>

          <!-- Pengguna Aktif -->
          <div class="stat-card">
            <div class="stat-icon-wrapper green">
               <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div class="stat-info">
              <h3 class="stat-label">Pengguna Aktif</h3>
              <div class="stat-value-row">
                <span class="stat-value">{{ dashboardData.totalUsers }}</span>
                <span class="stat-trend" :class="dashboardData.usersPersen >= 0 ? 'positive' : 'negative'">
                  {{ dashboardData.usersPersen > 0 ? '+' : '' }}{{ dashboardData.usersPersen }}%
                </span>
              </div>
            </div>
          </div>

          <!-- Dokumen RKPD -->
          <div class="stat-card">
            <div class="stat-icon-wrapper emerald">
              <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <div class="stat-info">
              <h3 class="stat-label">Dokumen RKPD</h3>
              <div class="stat-value-row">
                <span class="stat-value">{{ dashboardData.totalRkpd }}</span>
                <span class="stat-badge">PDF File</span>
              </div>
            </div>
          </div>

          <!-- Transaksi SPJ -->
          <div class="stat-card">
            <div class="stat-icon-wrapper teal">
              <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <div class="stat-info">
              <h3 class="stat-label">Transaksi SPJ</h3>
              <div class="stat-value-row">
                <span class="stat-value">{{ dashboardData.totalTransaksi }}</span>
                <span class="stat-trend" :class="dashboardData.trxPersen >= 0 ? 'positive' : 'negative'">
                  {{ dashboardData.trxPersen > 0 ? '+' : '' }}{{ dashboardData.trxPersen }}%
                </span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Location Section -->
      <section id="lokasi" class="stats-section">
        <div class="section-header">
          <h2 class="section-title">Lokasi <span class="gradient-text">Kantor</span></h2>
          <p class="section-subtitle">Kunjungi kantor Bappelitbang Kabupaten Tapin</p>
        </div>
        <div class="map-card">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1671.0743721150493!2d115.16113717630029!3d-2.9335888057739083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de5a4c2b7ad8b19%3A0x5f682a593a05a4c2!2sBappelitbang%20Kab.%20Tapin!5e1!3m2!1sen!2sid!4v1784342552615!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
      </section>

      <!-- Footer -->
      <footer class="app-footer">
        <div class="footer-content">
          <div class="footer-logo">
            <img :src="appData.logoUrl" alt="Logo" class="footer-logo-img" />
            <span class="footer-brand">SI-JANTUNG</span>
          </div>
          <p class="copyright-text">
            SI-JANTUNG TAPIN &copy; 2026 Pemerintah Kabupaten Tapin. Seluruh hak cipta dilindungi.<br/>
            Badan Perencanaan Pembangunan, Penelitian dan Pengembangan Daerah (Bappelitbang)
          </p>
        </div>
      </footer>

    </main>
  </div>
</template>

<script>
import { ref, onMounted, reactive } from 'vue';

export default {
  name: 'WelcomeApp',
  setup() {
    const appData = window.__APP_DATA__ || {
      isAuth: false,
      hasLogin: true,
      loginUrl: '/login',
      dashboardUrl: '/dashboard',
      logoUrl: '/images/logo.png',
      appVersion: '12',
      // Optional stats if passed from backend (can be dynamically populated in blade)
      stats: null
    };

    // Use dynamic data if available, fallback to mock data that mimics the dashboard layout
    const dashboardData = reactive({
      totalSurat: appData.stats?.totalSurat ?? '1,284',
      suratPersen: appData.stats?.suratPersen ?? 12.5,
      totalUsers: appData.stats?.totalUsers ?? '42',
      usersPersen: appData.stats?.usersPersen ?? 5.2,
      totalRkpd: appData.stats?.totalRkpd ?? '156',
      totalTransaksi: appData.stats?.totalTransaksi ?? '3,842',
      trxPersen: appData.stats?.trxPersen ?? 8.4
    });

    const isLoaded = ref(false);
    const scrollY = ref(0);
    const mainScroll = ref(null);

    const handleScroll = () => {
      if (mainScroll.value) {
        scrollY.value = mainScroll.value.scrollTop;
      }
    };

    onMounted(() => {
      // Simulate loading for entry animations
      setTimeout(() => {
        isLoaded.value = true;
      }, 50);
    });

    return {
      appData,
      isLoaded,
      scrollY,
      mainScroll,
      handleScroll,
      dashboardData
    };
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
  --font-heading: 'Outfit', sans-serif;
  --font-body: 'Plus Jakarta Sans', sans-serif;
  
  --color-bg: #030712;
  --color-surface: #111827;
  --color-surface-hover: #1f2937;
  --color-border: rgba(255,255,255,0.08);
  
  --color-primary: #eab308; /* Yellow */
  --color-primary-glow: rgba(234, 179, 8, 0.4);
  --color-secondary: #10b981; /* Emerald */
  
  --color-text: #f9fafb;
  --color-text-muted: #9ca3af;
}

* {
  box-sizing: border-box;
}

.app-wrapper {
  background-color: var(--color-bg);
  color: var(--color-text);
  font-family: var(--font-body);
  height: 100vh;
  width: 100vw;
  overflow: hidden;
  position: relative;
  opacity: 0;
  transition: opacity 0.8s ease-in-out;
}
.app-wrapper.is-loaded {
  opacity: 1;
}

/* Background Animations */
.bg-animated {
  position: absolute;
  inset: 0;
  z-index: 0;
  overflow: hidden;
  pointer-events: none;
}
.blob {
  position: absolute;
  filter: blur(100px);
  border-radius: 50%;
  opacity: 0.4;
  animation: float 15s infinite alternate ease-in-out;
}
.blob-1 {
  top: -10%; left: -10%;
  width: 50vw; height: 50vw;
  background: radial-gradient(circle, rgba(234,179,8,0.2) 0%, rgba(0,0,0,0) 70%);
}
.blob-2 {
  bottom: -20%; right: -10%;
  width: 60vw; height: 60vw;
  background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, rgba(0,0,0,0) 70%);
  animation-delay: -5s;
}
.blob-3 {
  top: 40%; left: 60%;
  width: 40vw; height: 40vw;
  background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, rgba(0,0,0,0) 70%);
  animation-delay: -10s;
}
.noise-overlay {
  position: absolute;
  inset: 0;
  background-image: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)" opacity="0.05"/%3E%3C/svg%3E');
  mix-blend-mode: overlay;
  opacity: 0.5;
}
@keyframes float {
  0% { transform: translate(0, 0) scale(1); }
  100% { transform: translate(30px, 50px) scale(1.1); }
}

/* Navigation */
.glass-navbar {
  position: fixed;
  top: 0; left: 0; right: 0;
  height: 80px;
  z-index: 50;
  display: flex;
  align-items: center;
  border-bottom: 1px solid transparent;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.glass-navbar.scrolled {
  background: rgba(3, 7, 18, 0.75);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--color-border);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
}
.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.brand {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.logo-box {
  width: 44px; height: 44px;
  background: linear-gradient(135deg, var(--color-primary), #d97706);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 20px var(--color-primary-glow);
}
.logo {
  width: 24px;
  height: auto;
  filter: brightness(0) invert(1);
}
.brand-text {
  display: flex;
  flex-direction: column;
}
.brand-title {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: 0.5px;
}
.brand-subtitle {
  font-size: 0.75rem;
  color: var(--color-primary);
  font-weight: 600;
  letter-spacing: 1px;
}

.btn-glow {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.7rem 1.5rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 50px;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}
.btn-glow::before {
  content: '';
  position: absolute;
  top: 0; left: -100%;
  width: 100%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
  transition: all 0.5s ease;
}
.btn-glow:hover {
  background: rgba(255,255,255,0.1);
  border-color: rgba(255,255,255,0.2);
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
.btn-glow:hover::before {
  left: 100%;
}
.icon {
  width: 18px; height: 18px;
}

/* Main Content Area */
.main-scroll {
  height: 100vh;
  overflow-y: auto;
  overflow-x: hidden;
  scroll-behavior: smooth;
  position: relative;
  z-index: 10;
}
.main-scroll::-webkit-scrollbar {
  width: 8px;
}
.main-scroll::-webkit-scrollbar-track {
  background: var(--color-bg);
}
.main-scroll::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.1);
  border-radius: 10px;
}
.main-scroll::-webkit-scrollbar-thumb:hover {
  background: rgba(255,255,255,0.2);
}

/* Hero Section */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 8rem 2rem 4rem;
}
.hero-content {
  max-width: 900px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  transform: translateY(40px);
  opacity: 0;
  transition: all 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s;
}
.app-wrapper.is-loaded .hero-content {
  transform: translateY(0);
  opacity: 1;
}

.badge-wrapper {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.5rem 1.25rem;
  background: rgba(234, 179, 8, 0.1);
  border: 1px solid rgba(234, 179, 8, 0.2);
  border-radius: 50px;
  color: var(--color-primary);
  font-weight: 600;
  font-size: 0.85rem;
  margin-bottom: 2rem;
  backdrop-filter: blur(10px);
}
.pulse-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: var(--color-primary);
  box-shadow: 0 0 10px var(--color-primary);
  animation: pulse 2s infinite;
}
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.7); }
  70% { box-shadow: 0 0 0 10px rgba(234, 179, 8, 0); }
  100% { box-shadow: 0 0 0 0 rgba(234, 179, 8, 0); }
}

.main-title {
  font-family: var(--font-heading);
  font-size: clamp(3rem, 6vw, 5.5rem);
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 1.5rem;
  letter-spacing: -1px;
}
.gradient-text {
  background: linear-gradient(135deg, #fde047, #eab308, #d97706);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.hero-desc {
  font-size: 1.15rem;
  line-height: 1.7;
  color: var(--color-text-muted);
  max-width: 700px;
  margin-bottom: 3rem;
}

.action-group {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
  justify-content: center;
}
.btn-primary-large {
  display: inline-flex;
  align-items: center;
  padding: 1rem 2.5rem;
  background: linear-gradient(135deg, #eab308, #d97706);
  color: #000;
  font-weight: 700;
  font-size: 1.1rem;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 10px 30px rgba(234, 179, 8, 0.3);
  transition: all 0.3s ease;
}
.btn-primary-large:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 40px rgba(234, 179, 8, 0.4);
}
.btn-secondary-large {
  display: inline-flex;
  align-items: center;
  padding: 1rem 2.5rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  font-weight: 600;
  font-size: 1.1rem;
  border-radius: 50px;
  text-decoration: none;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}
.btn-secondary-large:hover {
  background: rgba(255,255,255,0.1);
  border-color: rgba(255,255,255,0.2);
  transform: translateY(-3px);
}

/* Stats Section */
.stats-section {
  padding: 6rem 2rem;
  max-width: 1200px;
  margin: 0 auto;
}
.section-header {
  text-align: center;
  margin-bottom: 4rem;
}
.section-title {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 0.5rem;
}
.section-subtitle {
  color: var(--color-text-muted);
  font-size: 1.1rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.5rem;
}
.stat-card {
  background: rgba(17, 24, 39, 0.6);
  border: 1px solid var(--color-border);
  border-radius: 24px;
  padding: 2rem;
  backdrop-filter: blur(20px);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}
.stat-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
}
.stat-card:hover {
  transform: translateY(-10px);
  background: rgba(31, 41, 55, 0.8);
  border-color: rgba(255,255,255,0.15);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

.stat-icon-wrapper {
  width: 56px; height: 56px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
}
.stat-icon-wrapper.yellow { background: rgba(234, 179, 8, 0.15); color: #eab308; border: 1px solid rgba(234,179,8,0.2); }
.stat-icon-wrapper.green { background: rgba(34, 197, 94, 0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.2); }
.stat-icon-wrapper.emerald { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
.stat-icon-wrapper.teal { background: rgba(20, 184, 166, 0.15); color: #14b8a6; border: 1px solid rgba(20,184,166,0.2); }
.stat-icon { width: 28px; height: 28px; }

.stat-info { display: flex; flex-direction: column; gap: 0.5rem; }
.stat-label {
  font-size: 0.95rem;
  color: var(--color-text-muted);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.stat-value-row {
  display: flex;
  align-items: baseline;
  gap: 1rem;
}
.stat-value {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 800;
  color: #fff;
}
.stat-trend {
  font-size: 0.85rem;
  font-weight: 700;
  padding: 0.25rem 0.5rem;
  border-radius: 8px;
}
.stat-trend.positive {
  background: rgba(34, 197, 94, 0.15);
  color: #4ade80;
}
.stat-trend.negative {
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
}
.stat-badge {
  font-size: 0.85rem;
  font-weight: 600;
  padding: 0.25rem 0.5rem;
  border-radius: 8px;
  background: rgba(255,255,255,0.1);
  color: var(--color-text-muted);
}

.map-card {
  background: rgba(17, 24, 39, 0.6);
  border: 1px solid var(--color-border);
  border-radius: 24px;
  backdrop-filter: blur(20px);
  position: relative;
  overflow: hidden;
  height: 450px;
  padding: 0;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.map-card:hover {
  border-color: rgba(255,255,255,0.15);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}
.map-card iframe {
  width: 100%;
  height: 100%;
  border: none;
}

/* Footer */
.app-footer {
  border-top: 1px solid var(--color-border);
  background: rgba(3, 7, 18, 0.8);
  padding: 4rem 2rem;
  margin-top: 4rem;
}
.footer-content {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 1.5rem;
}
.footer-logo {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.footer-logo-img {
  width: 40px; height: auto;
  filter: brightness(0) invert(1);
  opacity: 0.8;
}
.footer-brand {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  font-weight: 800;
  letter-spacing: 1px;
  background: linear-gradient(135deg, #fff, #9ca3af);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
.copyright-text {
  color: var(--color-text-muted);
  font-size: 0.95rem;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
  .hero { padding-top: 7rem; padding-bottom: 3rem; }
  .main-title { font-size: 2.5rem; }
  .hero-desc { font-size: 1rem; }
  .action-group { flex-direction: column; width: 100%; }
  .btn-primary-large, .btn-secondary-large { width: 100%; justify-content: center; }
  .nav-container { padding: 0 1rem; }
  .btn-glow span { display: none; }
  .stats-section { padding: 4rem 1.5rem; }
}
</style>

