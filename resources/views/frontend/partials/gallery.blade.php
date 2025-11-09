@php
    $contents = App\Models\Content::with('images')->where('type', 1)->whereHas('images')->where('status', 1)->get();
@endphp

@if ($contents->isNotEmpty())
    <style>
        .gallery-card {
            border: 0;
            border-radius: .75rem;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .thumb {
            position: relative;
            overflow: hidden;
            border-radius: .5rem;
            cursor: pointer;
        }

        .thumb img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform .4s ease, filter .4s ease;
            display: block;
        }

        .thumb:hover img {
            transform: scale(1.06);
            filter: brightness(.95);
        }

        .category-list .list-group-item {
            border: 0;
            border-radius: .5rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .category-list .list-group-item.active {
          background: #c5a572;
          color: #fff;
          box-shadow: 0 6px 18px rgba(0, 114, 255, 0.25);
          border: none;
        }

        /* Modal large image */
        .viewer-img {
            max-height: 70vh;
            object-fit: contain;
        }

        .nav-arrow {
            background: rgba(0, 0, 0, 0.45);
            color: #fff;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 0;
            outline: 0;
        }

        /* Responsive tweaks */
        @media (max-width:767px) {
            .thumb img {
                height: 160px;
            }
        }

        @media (max-width:575px) {
            .thumb img {
                height: 140px;
            }
        }
    </style>

    <section id="team" class="team section">
        <div class="site-section slider-team-wrap">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="200">
                        <div class="features-content">
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <!-- Left: Gallery -->
                    <div class="col-12 col-md-9 order-2 order-md-1">
                        <div class="card gallery-card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong id="resultsLabel">All images</strong>
                                    <span class="text-muted ms-2 d-none" id="resultsCount">(0)</span>
                                </div>
                                <!-- mobile toggle for categories -->
                                <div class="d-md-none">
                                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#mobileCats" aria-expanded="false">Categories</button>
                                </div>
                            </div>

                            <!-- Grid -->
                            <div id="galleryGrid" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3">
                                <!-- Thumbnails injected by JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Right: Categories -->
                    <div class="col-12 col-md-3 order-1 order-md-2">
                        <div class="card gallery-card p-3">
                            <h6 class="mb-2">Categories</h6>

                            <!-- Collapsible for mobile -->
                            <div class="collapse d-md-block" id="mobileCats">
                                <div class="list-group category-list" id="categoryList">
                                    <!-- Category items injected by JS -->
                                </div>
                            </div>

                            <hr>
                            <small class="text-muted">Tap a category to filter. Click image to open viewer. Use arrow
                                keys ← → inside viewer.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="viewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative d-flex align-items-center justify-content-center">

                    <button class="position-absolute top-50 start-0 translate-middle-y ms-2 nav-arrow" id="prevBtn"
                        aria-label="Previous image">&#10094;</button>

                    <div class="d-flex flex-column align-items-center w-100">
                        <img id="viewerImage" src="" alt="" class="viewer-img img-fluid rounded" />
                        <div class="mt-2 text-center text-white">
                            <small id="viewerCaption" class="bg-dark bg-opacity-50 px-2 py-1 rounded"></small>
                        </div>
                    </div>

                    <button class="position-absolute top-50 end-0 translate-middle-y me-2 nav-arrow" id="nextBtn"
                        aria-label="Next image">&#10095;</button>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const IMAGES = [
            @foreach ($contents as $content)
                @foreach ($content->images as $image)
                    {
                        id: {{ $image->id }},
                        title: "{{ addslashes($content->short_title) }}",
                        category: ["{{ addslashes($content->short_title) }}"],
                        thumb: "{{ asset('images/content/' . $image->image) }}",
                        full: "{{ asset('images/content/' . $image->image) }}",
                        desc: "{{ addslashes($content->short_desc) }}",
                        tags: [
                            @foreach ($content->tags as $tag)
                                "{{ addslashes($tag->name) }}"
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        ]
                    }
                    @if (!($loop->parent->last && $loop->last))
                        ,
                    @endif
                @endforeach
            @endforeach
        ];

        // Compute all categories from data
        const CATEGORIES = ['All', ...Array.from(new Set(IMAGES.flatMap(i => i.category))).sort()];

        const galleryGrid = document.getElementById('galleryGrid');
        const categoryList = document.getElementById('categoryList');
        const resultsCount = document.getElementById('resultsCount');
        const resultsLabel = document.getElementById('resultsLabel');

        let activeCategory = 'All';
        let filteredList = IMAGES.slice();
        let currentIndex = 0; // index within filteredList for viewer

        function buildCategories() {
            categoryList.innerHTML = '';
            CATEGORIES.forEach(cat => {
                const a = document.createElement('button');
                a.className = 'list-group-item list-group-item-action text-start';
                if (cat === 'All') a.classList.add('active');
                a.dataset.category = cat;
                a.innerHTML =
                    `${cat} <span class='small text-muted ms-2 d-none'>${cat==='All'?IMAGES.length:IMAGES.filter(i=>i.category.includes(cat)).length}</span>`;
                a.addEventListener('click', () => selectCategory(cat, a));
                categoryList.appendChild(a);
            });
        }

        function buildGrid(list) {
            galleryGrid.innerHTML = '';

            const visibleList = list.slice(0, 9);

            visibleList.forEach((item, idx) => {
                const col = document.createElement('div');
                col.className = 'col';

                const card = document.createElement('div');
                card.className = 'thumb';
                card.title = item.title;
                card.tabIndex = 0;
                card.setAttribute('role', 'button');
                card.dataset.index = idx;

                const img = document.createElement('img');
                img.loading = 'lazy';
                img.src = item.thumb;
                img.alt = item.title;

                card.appendChild(img);
                col.appendChild(card);
                galleryGrid.appendChild(col);

                card.addEventListener('click', () => openViewer(idx));
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        openViewer(idx);
                    }
                });
            });

            resultsCount.textContent = `(${visibleList.length})`;
            resultsLabel.textContent = activeCategory === 'All' ? 'All Images' : activeCategory;
        }

        function selectCategory(cat, el) {
            activeCategory = cat;
            // update active class
            Array.from(categoryList.children).forEach(ch => ch.classList.remove('active'));
            el.classList.add('active');

            if (cat === 'All') filteredList = IMAGES.slice();
            else filteredList = IMAGES.filter(i => i.category.includes(cat));

            buildGrid(filteredList);

            // hide mobile collapse after selection
            const collapseEl = document.getElementById('mobileCats');
            if (collapseEl.classList.contains('show')) {
                new bootstrap.Collapse(collapseEl).toggle();
            }
        }

        // Viewer controls
        const viewerModal = new bootstrap.Modal(document.getElementById('viewerModal'), {
            keyboard: true
        });
        const viewerImage = document.getElementById('viewerImage');
        const viewerCaption = document.getElementById('viewerCaption');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        function openViewer(index) {
            currentIndex = index;
            const item = filteredList[currentIndex];
            viewerImage.src = item.full;
            viewerImage.alt = item.title;
            viewerCaption.textContent = `${item.title} — ${item.desc}`;
            viewerModal.show();
        }

        function showPrev() {
            if (filteredList.length === 0) return;
            currentIndex = (currentIndex - 1 + filteredList.length) % filteredList.length;
            updateViewer();
        }

        function showNext() {
            if (filteredList.length === 0) return;
            currentIndex = (currentIndex + 1) % filteredList.length;
            updateViewer();
        }

        function updateViewer() {
            const item = filteredList[currentIndex];
            viewerImage.src = item.full;
            viewerImage.alt = item.title;
            viewerCaption.textContent = `${item.title} — ${item.desc}`;
        }

        prevBtn.addEventListener('click', showPrev);
        nextBtn.addEventListener('click', showNext);

        // keyboard navigation when modal open
        document.addEventListener('keydown', (e) => {
            if (document.querySelector('.modal.show')) {
                if (e.key === 'ArrowLeft') showPrev();
                if (e.key === 'ArrowRight') showNext();
                if (e.key === 'Escape') viewerModal.hide();
            }
        });

        // initialize
        buildCategories();
        buildGrid(filteredList);

        // OPTIONAL: expose function to programmatically add images (for future integration)
        window.GalleryAPI = {
            addImage(obj) {
                IMAGES.push(obj); /* update categories & grid */
            },
            filterCategory(c) {
                selectCategory(c, Array.from(categoryList.children).find(n => n.dataset.category === c));
            }
        };
    </script>
@endif