<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Smart Preview RKPD') }}
        </h2>
    </x-slot>

    <style>
        /* GAYA KOTAK BARU: Anti Terpotong */
        .pdf-highlight {
            position: absolute;
            background-color: rgba(255, 255, 0, 0.25); 
            border: 2px solid rgba(255, 0, 0, 0.8); 
            box-shadow: 0 0 8px rgba(255, 0, 0, 0.4); 
            z-index: 50; /* Pastikan selalu paling atas */
            border-radius: 2px;
            /* KUNCI PERBAIKAN: Memastikan border ikut terhitung di dalam ukuran kotak */
            box-sizing: border-box; 
        }
        
        #pdf-wrapper {
            position: relative;
            display: inline-block;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .textLayer {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            /* PERBAIKAN: Menghapus overflow:hidden agar tidak memotong elemen */
            opacity: 0.2; 
            line-height: 1.0;
        }
        .pdf-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .pdf-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>

    <div class="py-8 w-full px-4 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-xl p-6 md:p-8 shadow-2xl shadow-indigo-100/20 dark:shadow-none rounded-3xl border border-white/50 dark:border-gray-700 relative overflow-hidden">
            <!-- Decorative background blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-gradient-to-br from-blue-100/50 to-purple-100/50 dark:from-blue-900/20 dark:to-purple-900/20 blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-gradient-to-tr from-emerald-100/30 to-teal-100/30 dark:from-emerald-900/20 dark:to-teal-900/20 blur-3xl pointer-events-none"></div>

            <div class="mb-8 relative z-10 flex items-center gap-4">
                <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl shadow-lg shadow-blue-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Smart Preview RKPD</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Cari, sorot, dan potong dokumen RKPD dengan tampilan interaktif.</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 relative z-10">
                
                <div class="w-full lg:w-1/4 bg-white/70 dark:bg-gray-800/70 backdrop-blur-md p-6 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-white/60 dark:border-gray-600 h-fit sticky top-6 space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="p-2 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 text-indigo-600 dark:text-indigo-300 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Kontrol Area</h3>
                    </div>
                    
                    <div>
                        <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Cari Kode Program/Kegiatan</label>
                        <div class="flex gap-2">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" id="input-cari" class="block w-full pl-10 rounded-xl border border-gray-300 bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all shadow-sm py-2.5 text-sm font-medium" placeholder="Ketik kode...">
                            </div>
                            <button type="button" id="btn-cari-kode" onclick="jalankanPencarian()" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md shadow-blue-500/20 transition-all text-sm whitespace-nowrap disabled:opacity-90 disabled:cursor-wait">Cari</button>
                        </div>
                        <div class="mt-3 flex items-start gap-2 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-100 dark:border-blue-800/30">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-blue-700 dark:text-blue-300 font-medium">Kotak penyorot bisa ditarik bebas. Anda juga bisa <strong class="font-extrabold text-blue-800 dark:text-blue-200">Klik Ganda (Double-Click)</strong> area teks mana saja di dokumen PDF untuk langsung membuat potongan kotak di titik tersebut!</p>
                        </div>
                        <button type="button" onclick="buatKotakManual()" class="mt-3 w-full bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all text-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                            Munculkan Kotak Manual
                        </button>
                    </div>

                    <form id="form-potong" action="{{ route('rkpd.potong') }}" method="POST" class="space-y-5 pt-2 border-t border-gray-200 dark:border-gray-700">
                        @csrf
                        <input type="hidden" name="hl_halaman" id="hl-halaman">
                        <input type="hidden" name="hl_y" id="hl-y">
                        <input type="hidden" name="hl_x" id="hl-x">
                        <input type="hidden" name="hl_h" id="hl-h">
                        <input type="hidden" name="hl_w" id="hl-w">

                        <div>
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Pilih Dokumen RKPD</label>
                            <select name="nama_file" id="pilih-dokumen" class="w-full rounded-xl border-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 text-gray-900 dark:text-white transition-all shadow-sm py-2.5 text-sm truncate" required onchange="gantiDokumen()">
                                <option value="" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">-- Pilih File RKPD --</option>
                                @if(isset($pdfFiles) && !empty($pdfFiles))
                                    @foreach($pdfFiles as $folder => $files)
                                        <optgroup label="📂 {{ $folder }}" class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-bold">
                                            @foreach($files as $file)
                                                <option value="{{ $file['path'] }}" class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-normal">📄 {{ $file['nama_tampil'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div>
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Potong Halaman Berapa?</label>
                            <input type="text" name="halaman" id="input-halaman" placeholder="Contoh: 1-3, 5" class="w-full rounded-xl border-gray-200 bg-white/50 focus:bg-white dark:bg-gray-900/50 focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 text-gray-900 dark:text-white transition-all shadow-sm py-2.5 text-sm" required>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-red-500/30 transition-all duration-300 transform hover:-translate-y-1 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                            Ekspor PDF Baru
                        </button>
                    </form>
                </div>

                <div class="w-full lg:w-3/4 bg-white/70 dark:bg-gray-800/70 backdrop-blur-md p-6 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-white/60 dark:border-gray-600 flex flex-col items-center min-h-[600px]">
                    
                    <div class="flex flex-wrap items-center justify-between w-full gap-4 mb-6 bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 px-5 py-3 rounded-xl shadow-sm">
                        <div class="flex items-center gap-2">
                            <button id="btn-prev" class="px-3 py-1.5 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-lg font-bold text-sm text-gray-700 dark:text-gray-300 transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                Mundur
                            </button>
                            <span class="font-semibold text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap mx-2">
                                Hal: <span id="page_num" class="text-indigo-600 dark:text-indigo-400 font-bold px-1">0</span> / <span id="page_count">0</span>
                            </span>
                            <button id="btn-next" class="px-3 py-1.5 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-lg font-bold text-sm text-gray-700 dark:text-gray-300 transition-colors flex items-center gap-1">
                                Maju
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-2 md:border-l border-gray-200 dark:border-gray-700 md:pl-5">
                            <button type="button" onclick="zoomOut()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-lg font-bold text-gray-700 dark:text-gray-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
                            </button>
                            <span class="font-bold text-sm text-indigo-600 dark:text-indigo-400 w-12 text-center" id="zoom-text">200%</span>
                            <button type="button" onclick="zoomIn()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-lg font-bold text-gray-700 dark:text-gray-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="pdf-container w-full bg-gray-100 dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 overflow-auto shadow-inner text-center" style="height: 80vh; padding: 20px;">
                        <div id="pdf-wrapper" class="inline-block text-left relative transition-transform origin-top-left">
                            <canvas id="pdf-canvas" class="shadow-md"></canvas>
                            <div id="text-layer" class="textLayer"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.css">

    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        let urlPDF = ''; 
        let pdfDoc = null, pageNum = 1, pageRendering = false, pageNumPending = null, scale = 2.0; 
            
        const canvas = document.getElementById('pdf-canvas'),
              ctx = canvas.getContext('2d'),
              textLayerDiv = document.getElementById('text-layer');

        let isDraggingBox = false;
        let currentAction = 'move';
        let startY, startX, startTop, startLeft, startW, startH;
        let activeHighlight = null;

        window.zoomIn = function() {
            if(scale < 5.0) { scale += 0.25; terapkanZoom(); }
        }
        window.zoomOut = function() {
            if(scale > 0.5) { scale -= 0.25; terapkanZoom(); }
        }
        function terapkanZoom() {
            document.getElementById('zoom-text').innerText = Math.round(scale * 100) + '%';
            if (pdfDoc) {
                queueRenderPage(pageNum);
            }
        }

        window.isNewSearch = false;

        window.gantiDokumen = function() {
            const fileName = document.getElementById('pilih-dokumen').value;
            // Hapus highlight jika ada saat ganti dokumen
            document.querySelectorAll('.pdf-highlight').forEach(e => e.remove());
            
            if(!fileName) {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                textLayerDiv.innerHTML = '';
                document.getElementById('page_count').textContent = '0';
                document.getElementById('page_num').textContent = '0';
                pdfDoc = null; 
                return;
            }
            urlPDF = '/Dokumen RKPD/' + fileName; 
            
            // Reset zoom ke default 200% saat ganti dokumen
            scale = 2.0;
            document.getElementById('zoom-text').innerText = '200%';

            pdfjsLib.getDocument(urlPDF).promise.then(pdf => {
                pdfDoc = pdf; pageNum = 1; 
                document.getElementById('page_count').textContent = pdf.numPages;
                renderPage(pageNum);
            }).catch(error => { alert("File PDF gagal dimuat."); });
        }

        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = { canvasContext: ctx, viewport: viewport };
                page.render(renderContext).promise.then(() => {
                    textLayerDiv.innerHTML = '';
                    textLayerDiv.style.height = viewport.height + 'px';
                    textLayerDiv.style.width = viewport.width + 'px';

                    page.getTextContent().then(textContent => {
                        pdfjsLib.renderTextLayer({
                            textContentSource: textContent, container: textLayerDiv, viewport: viewport, textDivs: []
                        }).promise.then(() => {
                            pageRendering = false;
                            if (pageNumPending !== null) { renderPage(pageNumPending); pageNumPending = null; }
                            
                            if (window.isNewSearch) {
                                const kataDicari = document.getElementById('input-cari').value.trim();
                                if(kataDicari) sorotTeksDiLayar(kataDicari);
                                window.isNewSearch = false; // Reset status pencarian
                            }
                        });
                    });
                });
            });
            document.getElementById('page_num').textContent = num;
            
            // Jika ini dari pencarian baru, isi dengan 1-3 dan halaman yang dicari
            if (window.isNewSearch) {
                document.getElementById('input-halaman').value = '1-3, ' + num;
            } else {
                // Jika user pindah halaman biasa, kita update angkanya
                // KECUALI jika di dalamnya sudah ada format custom (seperti koma atau strip)
                let currentVal = document.getElementById('input-halaman').value;
                if (!currentVal.includes(',') && !currentVal.includes('-')) {
                    document.getElementById('input-halaman').value = num;
                }
            }
        }

        function queueRenderPage(num) {
            if (pageRendering) { pageNumPending = num; } else { renderPage(num); }
        }
        document.getElementById('btn-prev').addEventListener('click', () => {
            if (!pdfDoc || pageNum <= 1) return; pageNum--; queueRenderPage(pageNum);
        });
        document.getElementById('btn-next').addEventListener('click', () => {
            if (!pdfDoc || pageNum >= pdfDoc.numPages) return; pageNum++; queueRenderPage(pageNum);
        });

        window.jalankanPencarian = async function() {
            const btnCari = document.getElementById('btn-cari-kode');
            const kataDicari = document.getElementById('input-cari').value.trim();

            if (!pdfDoc) { alert("⚠️ Peringatan: Silakan pilih Dokumen RKPD terlebih dahulu!"); return; }
            if(!kataDicari) { alert("⚠️ Ketikkan kode atau teks yang ingin dicari terlebih dahulu!"); return; }

            const teksAsli = btnCari.innerText;
            btnCari.innerText = "Mencari...";
            btnCari.disabled = true;

            let halamanDitemukan = null;

            for (let i = 1; i <= pdfDoc.numPages; i++) {
                const page = await pdfDoc.getPage(i);
                const textContent = await page.getTextContent();
                const textHalaman = textContent.items.map(item => item.str).join('');
                if (textHalaman.replace(/\s/g, '').includes(kataDicari.replace(/\s/g, ''))) {
                    halamanDitemukan = i; break; 
                }
            }

            btnCari.innerText = teksAsli;
            btnCari.disabled = false;

            if (halamanDitemukan) {
                // Kembalikan zoom ke default 200%
                scale = 2.0;
                document.getElementById('zoom-text').innerText = '200%';
                pageNum = halamanDitemukan;
                window.isNewSearch = true; // Tandai bahwa ini hasil pencarian baru
                queueRenderPage(pageNum);
            } else {
                alert(`Kode "${kataDicari}" tidak ditemukan di dokumen ini.`);
            }
        }

        // ================= KOTAK PINTAR (ANTI TERPOTONG) =================
        window.sorotTeksDiLayar = function(kataDicari) {
            if(!kataDicari) return;

            document.querySelectorAll('.pdf-highlight').forEach(e => e.remove());
            const textNodes = document.querySelectorAll('.textLayer span');
            let kotakDibuat = false; 

            textNodes.forEach(node => {
                const nodeTextClean = node.textContent.replace(/\s/g, '');
                const kataDicariClean = kataDicari.replace(/\s/g, '');

                if (!kotakDibuat && nodeTextClean.includes(kataDicariClean) && nodeTextClean !== '') {
                    const highlight = document.createElement('div');
                    highlight.className = 'pdf-highlight';
                    
                    highlight.style.left = '2%'; 
                    highlight.style.width = '96%'; 
                    highlight.style.top = (parseFloat(node.style.top) - 4) + 'px'; 
                    highlight.style.height = '30px'; 

                    // PERBAIKAN: Tempelkan kotak ke pdf-wrapper, bukan text-layer agar tidak dibatasi oleh PDF.js
                    document.getElementById('pdf-wrapper').appendChild(highlight);
                    
                    // Gulir container agar kotak terlihat di tengah tanpa menggulir seluruh halaman
                    const container = document.querySelector('.pdf-container');
                    const scrollY = highlight.offsetTop - (container.clientHeight / 2) + (highlight.clientHeight / 2);
                    container.scrollTo({ top: scrollY, behavior: 'smooth' });
                    
                    pasangEventKotak(highlight);

                    kotakDibuat = true;
                }
            });
        }

        window.buatKotakManual = function() {
            if (!pdfDoc) { alert("⚠️ Peringatan: Silakan pilih Dokumen RKPD terlebih dahulu!"); return; }
            document.querySelectorAll('.pdf-highlight').forEach(e => e.remove());
            
            const highlight = document.createElement('div');
            highlight.className = 'pdf-highlight';
            
            highlight.style.left = '5%'; 
            highlight.style.width = '90%'; 
            highlight.style.top = '150px'; 
            highlight.style.height = '100px'; 
            
            document.getElementById('pdf-wrapper').appendChild(highlight);
            pasangEventKotak(highlight);
            
            // Gulir container agar kotak terlihat di tengah
            const container = document.querySelector('.pdf-container');
            const scrollY = highlight.offsetTop - (container.clientHeight / 2) + (highlight.clientHeight / 2);
            container.scrollTo({ top: Math.max(0, scrollY), behavior: 'smooth' });
        }

        function pasangEventKotak(highlight) {
            highlight.addEventListener('mousemove', function(e) {
                if (isDraggingBox) return; 

                const rect = highlight.getBoundingClientRect();
                const x = (e.clientX - rect.left);
                const y = (e.clientY - rect.top);
                const w = rect.width;
                const h = rect.height;
                const t = 10; 

                let cursor = 'move';
                let action = 'move';

                if (y < t && x < t) { cursor = 'nwse-resize'; action = 'resize-nw'; }
                else if (y < t && x > w - t) { cursor = 'nesw-resize'; action = 'resize-ne'; }
                else if (y > h - t && x < t) { cursor = 'nesw-resize'; action = 'resize-sw'; }
                else if (y > h - t && x > w - t) { cursor = 'nwse-resize'; action = 'resize-se'; }
                else if (y < t) { cursor = 'ns-resize'; action = 'resize-n'; }
                else if (y > h - t) { cursor = 'ns-resize'; action = 'resize-s'; }
                else if (x < t) { cursor = 'ew-resize'; action = 'resize-w'; }
                else if (x > w - t) { cursor = 'ew-resize'; action = 'resize-e'; }
                
                highlight.style.cursor = cursor;
                highlight.dataset.action = action; 
            });

            highlight.addEventListener('mousedown', function(e) {
                isDraggingBox = true;
                activeHighlight = highlight;
                currentAction = highlight.dataset.action || 'move';
                
                startX = e.clientX;
                startY = e.clientY;
                startTop = highlight.offsetTop;
                startLeft = highlight.offsetLeft;
                startW = highlight.offsetWidth;
                startH = highlight.offsetHeight;
                
                e.preventDefault(); 
            });
        }

        // ================= MESIN PENGGERAK BEBAS DI SELURUH LAYAR =================
        document.addEventListener('mousemove', function(e) {
            if (!isDraggingBox || !activeHighlight) return;
            
            let dx = (e.clientX - startX);
            let dy = (e.clientY - startY);
            
            if (currentAction === 'move') {
                activeHighlight.style.top = (startTop + dy) + 'px';
                activeHighlight.style.left = (startLeft + dx) + 'px';
            } else {
                if (currentAction.includes('e')) {
                    activeHighlight.style.width = Math.max(20, startW + dx) + 'px';
                }
                if (currentAction.includes('s')) {
                    activeHighlight.style.height = Math.max(20, startH + dy) + 'px';
                }
                if (currentAction.includes('w')) {
                    let newW = startW - dx;
                    if (newW > 20) {
                        activeHighlight.style.left = (startLeft + dx) + 'px';
                        activeHighlight.style.width = newW + 'px';
                    }
                }
                if (currentAction.includes('n')) {
                    let newH = startH - dy;
                    if (newH > 20) {
                        activeHighlight.style.top = (startTop + dy) + 'px';
                        activeHighlight.style.height = newH + 'px';
                    }
                }
            }
        });

        document.addEventListener('mouseup', function() {
            isDraggingBox = false;
            activeHighlight = null;
        });

        // ================= DOUBLE CLICK UNTUK SPAWN INSTAN =================
        document.getElementById('pdf-wrapper').addEventListener('dblclick', function(e) {
            // Hindari double click pada kotak yang sudah ada
            if(e.target.classList.contains('pdf-highlight') || e.target.closest('.pdf-highlight')) return;

            document.querySelectorAll('.pdf-highlight').forEach(el => el.remove());
            const highlight = document.createElement('div');
            highlight.className = 'pdf-highlight';
            
            const rect = this.getBoundingClientRect();
            // Ambil posisi Y dari titik klik
            const clickY = e.clientY - rect.top;
            
            highlight.style.left = '2%'; 
            highlight.style.width = '96%'; 
            highlight.style.top = Math.max(0, clickY - 20) + 'px'; // Center-kan height 40px ke titik klik
            highlight.style.height = '40px'; 
            
            this.appendChild(highlight);
            pasangEventKotak(highlight);
        });

        // ================= TANGKAP KOORDINAT SAAT EKSPOR =================
        document.getElementById('form-potong').addEventListener('submit', function(e) {
            const highlight = document.querySelector('.pdf-highlight');
            if (highlight) {
                const canvasHeight = document.getElementById('pdf-canvas').height;
                const canvasWidth = document.getElementById('pdf-canvas').width;
                
                document.getElementById('hl-y').value = (highlight.offsetTop / canvasHeight) * 100;
                document.getElementById('hl-x').value = (highlight.offsetLeft / canvasWidth) * 100;
                document.getElementById('hl-h').value = (highlight.offsetHeight / canvasHeight) * 100;
                document.getElementById('hl-w').value = (highlight.offsetWidth / canvasWidth) * 100;
                document.getElementById('hl-halaman').value = pageNum;
            }
        });
    </script>
</x-app-layout>