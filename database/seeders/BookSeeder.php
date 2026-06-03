<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Book::truncate();

        // Koleksi URL gambar Unsplash bertema buku/kategori
        $covers = [
            // Fiksi & Novel (Novel)
            'laskar_pelangi' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=400&q=80',
            'ketika_cinta_bertasbih' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=400&q=80',
            'teluk_alaska' => 'https://images.unsplash.com/photo-1476275466078-4007374efbbe?auto=format&fit=crop&w=400&q=80',
            'bumi_manusia' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=400&q=80',
            
            // Sains & Teknologi (Code / Science)
            'laravel_pemula' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=400&q=80',
            'react_js' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?auto=format&fit=crop&w=400&q=80',
            'ai_fundamentals' => 'https://images.unsplash.com/photo-1677442136019-21780efad99a?auto=format&fit=crop&w=400&q=80',
            'devops' => 'https://images.unsplash.com/photo-1618401471353-b98aedd07871?auto=format&fit=crop&w=400&q=80',
            
            // Sejarah (History)
            'sejarah_modern' => 'https://images.unsplash.com/photo-1461360370896-922624d12aa1?auto=format&fit=crop&w=400&q=80',
            'perang_pasifik' => 'https://images.unsplash.com/photo-1505664194779-8bebcb95c557?auto=format&fit=crop&w=400&q=80',
            'majapahit' => 'https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?auto=format&fit=crop&w=400&q=80',
            'revolusi_industri' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=400&q=80',
            
            // Bisnis & Ekonomi
            'kaya_itu_mudah' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=400&q=80',
            'entrepreneur' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=400&q=80',
            'ekonomi_global' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=400&q=80',
            'marketing' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=400&q=80',
            
            // Agama & Spiritual
            'tafsir_quran' => 'https://images.unsplash.com/photo-1609599006353-e629f1d40939?auto=format&fit=crop&w=400&q=80',
            'nabi_muhammad' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?auto=format&fit=crop&w=400&q=80',
            'meditasi' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=400&q=80',
            'filsafat_islam' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&q=80',
            
            // Buku Anak
            'si_kancil' => 'https://images.unsplash.com/photo-1489065604198-8d37a83d2c54?auto=format&fit=crop&w=400&q=80',
            'putri_salju' => 'https://images.unsplash.com/photo-1518373386927-8581a5146013?auto=format&fit=crop&w=400&q=80',
            'belajar_warna' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=400&q=80',
            'timun_mas' => 'https://images.unsplash.com/photo-1607990283143-e81e7a2c93ab?auto=format&fit=crop&w=400&q=80',
            
            // Jurnal & Riset
            'metode_sosial' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=400&q=80',
            'biomolekular' => 'https://images.unsplash.com/photo-1532187643603-ba119ca4109e?auto=format&fit=crop&w=400&q=80',
            'perilaku_konsumen' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=400&q=80',
            'blockchain' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=400&q=80',
            
            // Puisi
            'sapardi' => 'https://images.unsplash.com/photo-1492052722242-2554d0e99e3a?auto=format&fit=crop&w=400&q=80',
            'puisi_cinta' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&w=400&q=80',
            
            // Filsafat
            'filosofi_teras' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=400&q=80',
            'kebijaksanaan' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=400&q=80',
            
            // Hukum
            'hukum_konstitusi' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=400&q=80',
            'ham_modern' => 'https://images.unsplash.com/photo-1505664194779-8bebcb95c557?auto=format&fit=crop&w=400&q=80',
            
            // Psikologi
            'psikologi_anak' => 'https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?auto=format&fit=crop&w=400&q=80',
            'terapi_kognitif' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=400&q=80',
            
            // Biografi
            'steve_jobs' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
            'kartini' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=400&q=80',
        ];

        // KATEGORI 1: FIKSI & NOVEL
        \App\Models\Book::create([
            'title' => 'Laskar Pelangi',
            'year' => 2005,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 1,
            'price' => 75000,
            'stock' => 12,
            'type' => 'both',
            'image' => $covers['laskar_pelangi']
        ]);

        \App\Models\Book::create([
            'title' => 'Ketika Cinta Bertasbih',
            'year' => 2007,
            'author_id' => 2,
            'publisher_id' => 1,
            'category_id' => 1,
            'price' => 65000,
            'stock' => 8,
            'type' => 'physical',
            'image' => $covers['ketika_cinta_bertasbih']
        ]);

        \App\Models\Book::create([
            'title' => 'Teluk Alaska',
            'year' => 2001,
            'author_id' => 3,
            'publisher_id' => 2,
            'category_id' => 1,
            'price' => 55000,
            'stock' => 5,
            'type' => 'ebook',
            'image' => $covers['teluk_alaska']
        ]);

        \App\Models\Book::create([
            'title' => 'Bumi Manusia',
            'year' => 1980,
            'author_id' => 4,
            'publisher_id' => 3,
            'category_id' => 1,
            'price' => 85000,
            'stock' => 15,
            'type' => 'both',
            'image' => $covers['bumi_manusia']
        ]);

        // KATEGORI 2: SAINS & TEKNOLOGI
        \App\Models\Book::create([
            'title' => 'Belajar Laravel untuk Pemula',
            'year' => 2024,
            'author_id' => 1,
            'publisher_id' => 2,
            'category_id' => 2,
            'price' => 95000,
            'stock' => 20,
            'type' => 'both',
            'image' => $covers['laravel_pemula']
        ]);

        \App\Models\Book::create([
            'title' => 'Mastering React.js',
            'year' => 2023,
            'author_id' => 2,
            'publisher_id' => 1,
            'category_id' => 2,
            'price' => 105000,
            'stock' => 10,
            'type' => 'ebook',
            'image' => $covers['react_js']
        ]);

        \App\Models\Book::create([
            'title' => 'Artificial Intelligence Fundamentals',
            'year' => 2024,
            'author_id' => 9,
            'publisher_id' => 5,
            'category_id' => 2,
            'price' => 125000,
            'stock' => 7,
            'type' => 'physical',
            'image' => $covers['ai_fundamentals']
        ]);

        \App\Models\Book::create([
            'title' => 'Cloud Computing & DevOps',
            'year' => 2023,
            'author_id' => 3,
            'publisher_id' => 2,
            'category_id' => 2,
            'price' => 115000,
            'stock' => 9,
            'type' => 'both',
            'image' => $covers['devops']
        ]);

        // KATEGORI 3: SEJARAH
        \App\Models\Book::create([
            'title' => 'Sejarah Indonesia Modern',
            'year' => 1995,
            'author_id' => 4,
            'publisher_id' => 3,
            'category_id' => 3,
            'price' => 95000,
            'stock' => 14,
            'type' => 'both',
            'image' => $covers['sejarah_modern']
        ]);

        \App\Models\Book::create([
            'title' => 'Perang Pasifik 1941-1945',
            'year' => 2000,
            'author_id' => 9,
            'publisher_id' => 1,
            'category_id' => 3,
            'price' => 105000,
            'stock' => 6,
            'type' => 'physical',
            'image' => $covers['perang_pasifik']
        ]);

        \App\Models\Book::create([
            'title' => 'Jejak Kerajaan Majapahit',
            'year' => 2010,
            'author_id' => 6,
            'publisher_id' => 4,
            'category_id' => 3,
            'price' => 85000,
            'stock' => 11,
            'type' => 'both',
            'image' => $covers['majapahit']
        ]);

        \App\Models\Book::create([
            'title' => 'Revolusi Industri & Dampaknya',
            'year' => 2015,
            'author_id' => 2,
            'publisher_id' => 5,
            'category_id' => 3,
            'price' => 78000,
            'stock' => 8,
            'type' => 'ebook',
            'image' => $covers['revolusi_industri']
        ]);

        // KATEGORI 4: BISNIS & EKONOMI
        \App\Models\Book::create([
            'title' => 'Kaya Itu Mudah',
            'year' => 2018,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 4,
            'price' => 89000,
            'stock' => 16,
            'type' => 'both',
            'image' => $covers['kaya_itu_mudah']
        ]);

        \App\Models\Book::create([
            'title' => 'Mindset Entrepreneur',
            'year' => 2020,
            'author_id' => 6,
            'publisher_id' => 2,
            'category_id' => 4,
            'price' => 75000,
            'stock' => 10,
            'type' => 'physical',
            'image' => $covers['entrepreneur']
        ]);

        \App\Models\Book::create([
            'title' => 'Ekonomi Global di Era Digital',
            'year' => 2022,
            'author_id' => 9,
            'publisher_id' => 5,
            'category_id' => 4,
            'price' => 99000,
            'stock' => 7,
            'type' => 'both',
            'image' => $covers['ekonomi_global']
        ]);

        \App\Models\Book::create([
            'title' => 'Strategi Marketing Terkini',
            'year' => 2023,
            'author_id' => 3,
            'publisher_id' => 6,
            'category_id' => 4,
            'price' => 85000,
            'stock' => 12,
            'type' => 'ebook',
            'image' => $covers['marketing']
        ]);

        // KATEGORI 5: AGAMA & SPIRITUAL
        \App\Models\Book::create([
            'title' => 'Tafsir Quran Kontemporer',
            'year' => 2015,
            'author_id' => 7,
            'publisher_id' => 3,
            'category_id' => 5,
            'price' => 125000,
            'stock' => 18,
            'type' => 'both',
            'image' => $covers['tafsir_quran']
        ]);

        \App\Models\Book::create([
            'title' => 'Kehidupan Nabi Muhammad SAW',
            'year' => 2010,
            'author_id' => 7,
            'publisher_id' => 3,
            'category_id' => 5,
            'price' => 105000,
            'stock' => 14,
            'type' => 'physical',
            'image' => $covers['nabi_muhammad']
        ]);

        \App\Models\Book::create([
            'title' => 'Meditasi dan Ketenangan Batin',
            'year' => 2019,
            'author_id' => 5,
            'publisher_id' => 4,
            'category_id' => 5,
            'price' => 65000,
            'stock' => 9,
            'type' => 'both',
            'image' => $covers['meditasi']
        ]);

        \App\Models\Book::create([
            'title' => 'Filsafat Kehidupan Islam',
            'year' => 2012,
            'author_id' => 7,
            'publisher_id' => 3,
            'category_id' => 5,
            'price' => 95000,
            'stock' => 11,
            'type' => 'ebook',
            'image' => $covers['filsafat_islam']
        ]);

        // KATEGORI 6: BUKU ANAK
        \App\Models\Book::create([
            'title' => 'Petualangan Si Kancil',
            'year' => 2018,
            'author_id' => 8,
            'publisher_id' => 2,
            'category_id' => 6,
            'price' => 45000,
            'stock' => 25,
            'type' => 'both',
            'image' => $covers['si_kancil']
        ]);

        \App\Models\Book::create([
            'title' => 'Dongeng Putri Salju',
            'year' => 2020,
            'author_id' => 8,
            'publisher_id' => 1,
            'category_id' => 6,
            'price' => 55000,
            'stock' => 20,
            'type' => 'both',
            'image' => $covers['putri_salju']
        ]);

        \App\Models\Book::create([
            'title' => 'Seri Anak Cerdas - Belajar Warna',
            'year' => 2022,
            'author_id' => 6,
            'publisher_id' => 2,
            'category_id' => 6,
            'price' => 35000,
            'stock' => 30,
            'type' => 'physical',
            'image' => $covers['belajar_warna']
        ]);

        \App\Models\Book::create([
            'title' => 'Cerita Fabel Timun Mas',
            'year' => 2019,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 6,
            'price' => 48000,
            'stock' => 17,
            'type' => 'ebook',
            'image' => $covers['timun_mas']
        ]);

        // KATEGORI 7: JURNAL & RISET
        \App\Models\Book::create([
            'title' => 'Metodologi Penelitian Sosial',
            'year' => 2021,
            'author_id' => 9,
            'publisher_id' => 5,
            'category_id' => 7,
            'price' => 145000,
            'stock' => 5,
            'type' => 'both',
            'image' => $covers['metode_sosial']
        ]);

        \App\Models\Book::create([
            'title' => 'Jurnal Sains Biomolekular',
            'year' => 2023,
            'author_id' => 10,
            'publisher_id' => 4,
            'category_id' => 7,
            'price' => 165000,
            'stock' => 3,
            'type' => 'ebook',
            'image' => $covers['biomolekular']
        ]);

        \App\Models\Book::create([
            'title' => 'Riset Perilaku Konsumen',
            'year' => 2022,
            'author_id' => 6,
            'publisher_id' => 5,
            'category_id' => 7,
            'price' => 135000,
            'stock' => 6,
            'type' => 'physical',
            'image' => $covers['perilaku_konsumen']
        ]);

        \App\Models\Book::create([
            'title' => 'Kajian Teknologi Blockchain',
            'year' => 2023,
            'author_id' => 3,
            'publisher_id' => 6,
            'category_id' => 7,
            'price' => 155000,
            'stock' => 4,
            'type' => 'both',
            'image' => $covers['blockchain']
        ]);

        // KATEGORI 8: PUISI INDONESIA
        \App\Models\Book::create([
            'title' => 'Kumpulan Puisi Sapardi Djoko Damono',
            'year' => 2015,
            'author_id' => 5,
            'publisher_id' => 4,
            'category_id' => 8,
            'price' => 65000,
            'stock' => 9,
            'type' => 'both',
            'image' => $covers['sapardi']
        ]);

        \App\Models\Book::create([
            'title' => 'Puisi Cinta dan Rindu',
            'year' => 2018,
            'author_id' => 5,
            'publisher_id' => 1,
            'category_id' => 8,
            'price' => 55000,
            'stock' => 7,
            'type' => 'physical',
            'image' => $covers['puisi_cinta']
        ]);

        // KATEGORI 9: FILSAFAT TIMUR
        \App\Models\Book::create([
            'title' => 'Filosofi Teras',
            'year' => 2019,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 9,
            'price' => 85000,
            'stock' => 13,
            'type' => 'both',
            'image' => $covers['filosofi_teras']
        ]);

        \App\Models\Book::create([
            'title' => 'Kebijaksanaan Timur dan Barat',
            'year' => 2020,
            'author_id' => 9,
            'publisher_id' => 4,
            'category_id' => 9,
            'price' => 95000,
            'stock' => 8,
            'type' => 'ebook',
            'image' => $covers['kebijaksanaan']
        ]);

        // KATEGORI 10: HUKUM & HAM
        \App\Models\Book::create([
            'title' => 'Hukum Konstitusi Indonesia',
            'year' => 2016,
            'author_id' => 4,
            'publisher_id' => 3,
            'category_id' => 10,
            'price' => 115000,
            'stock' => 6,
            'type' => 'both',
            'image' => $covers['hukum_konstitusi']
        ]);

        \App\Models\Book::create([
            'title' => 'Hak Asasi Manusia Modern',
            'year' => 2019,
            'author_id' => 9,
            'publisher_id' => 5,
            'category_id' => 10,
            'price' => 105000,
            'stock' => 5,
            'type' => 'physical',
            'image' => $covers['ham_modern']
        ]);

        // KATEGORI 11: PSIKOLOGI
        \App\Models\Book::create([
            'title' => 'Psikologi Perkembangan Anak',
            'year' => 2018,
            'author_id' => 2,
            'publisher_id' => 2,
            'category_id' => 11,
            'price' => 95000,
            'stock' => 10,
            'type' => 'both',
            'image' => $covers['psikologi_anak']
        ]);

        \App\Models\Book::create([
            'title' => 'Terapi Kognitif Perilaku',
            'year' => 2020,
            'author_id' => 6,
            'publisher_id' => 5,
            'category_id' => 11,
            'price' => 125000,
            'stock' => 7,
            'type' => 'ebook',
            'image' => $covers['terapi_kognitif']
        ]);

        // KATEGORI 12: BIOGRAFI TOKOH
        \App\Models\Book::create([
            'title' => 'Biografi Steve Jobs',
            'year' => 2011,
            'author_id' => 9,
            'publisher_id' => 1,
            'category_id' => 12,
            'price' => 85000,
            'stock' => 11,
            'type' => 'both',
            'image' => $covers['steve_jobs']
        ]);

        \App\Models\Book::create([
            'title' => 'Perjalanan Hidup Ibu Kartini',
            'year' => 2015,
            'author_id' => 4,
            'publisher_id' => 3,
            'category_id' => 12,
            'price' => 65000,
            'stock' => 14,
            'type' => 'physical',
            'image' => $covers['kartini']
        ]);
    }
}
