<x-landing>
  <x-slot:title>Semesta Buku | View {{ $book->title }}</x-slot:title>

  <section class="product_details_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3>{{ $book->title }}</h3>
            </div>
            <div class="card-body">
              <div id="pdf-viewer" class="text-center"></div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <script>
    const url = "{{ route('user-view.book', basename($book->file_url)) }}";

    const pdfjsLib = window['pdfjsLib'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

    // Load PDF
    pdfjsLib.getDocument(url).promise.then(pdf => {
      console.log("PDF Loaded, Total Pages:", pdf.numPages);

      // Fungsi untuk render tiap halaman secara berurutan
      function renderPage(pageNumber) {
        pdf.getPage(pageNumber).then(page => {
          const scale = 1.5;
          const viewport = page.getViewport({
            scale
          });

          const canvas = document.createElement('canvas');
          const context = canvas.getContext('2d');

          canvas.height = viewport.height;
          canvas.width = viewport.width;

          const renderContext = {
            canvasContext: context,
            viewport: viewport
          };

          document.getElementById('pdf-viewer').appendChild(canvas);

          page.render(renderContext).promise.then(() => {
            console.log("Rendered page:", pageNumber);
            if (pageNumber < pdf.numPages) {
              renderPage(pageNumber + 1); // Render halaman berikutnya
            }
          });
        });
      }

      renderPage(1); // Mulai render dari halaman pertama
    }).catch(error => {
      console.error("Error loading PDF:", error);
    });
  </script>

  <script>
    document.addEventListener('contextmenu', function(event) {
      event.preventDefault();
      const menu = document.createElement('div');
      menu.style.position = 'absolute';
      menu.style.top = `${event.clientY}px`;
      menu.style.left = `${event.clientX}px`;
      menu.style.backgroundColor = '#fff';
      menu.style.border = '1px solid #ccc';
      menu.style.padding = '10px';
      menu.style.zIndex = 1000;
      menu.innerHTML = '<a href="{{ route('home') }}">Kembali ke Home</a>';
      document.body.appendChild(menu);

      document.addEventListener('click', function() {
        menu.remove();
      }, {
        once: true
      });
    });
  </script>
</x-landing>


yang tampil hanya halaman pertama pada pdf saya ingin semuanya tampil?
