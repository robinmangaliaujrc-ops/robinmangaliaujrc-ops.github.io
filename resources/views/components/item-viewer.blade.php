{{-- 
  RE-style 3D Item Viewer Component
  Usage: <x-item-viewer 
            title="Confidential Letter"
            seal-letter="S"
            subtitle="Spencer Mansion, 1998"
            modal-title="Confidential Correspondence"
            :content="[
                'Do not trust the others. The virus has spread...',
                'The key is hidden behind the painting in the east corridor.',
            ]"
            signature="— R. B."
         />
  Or call the Blade component with a slot for custom modal body.
--}}

@props([
    'title'       => 'Examine Item',
    'sealLetter'  => 'S',
    'subtitle'    => 'Unknown origin',
    'modalTitle'  => 'Item Details',
    'content'     => [],
    'signature'   => null,
    'btnLabel'    => 'Examine',
])

<div class="iv-scene" role="region" aria-label="{{ $title }}">

    {{-- Ambient fog ring --}}
    <div class="iv-fog" aria-hidden="true"></div>

    <p class="iv-hint" aria-hidden="true">— drag to examine —</p>

    {{-- 3D Letter --}}
    <div class="iv-wrapper" role="img" aria-label="3D rotating {{ $title }}">
        <div class="iv-letter floating" id="iv-letter-{{ $loop->index ?? '0' }}">
            <div class="iv-face iv-front">
                <div class="iv-seal">{{ $sealLetter }}</div>
                <div class="iv-address">{{ $subtitle }}</div>
            </div>
            <div class="iv-face iv-back"></div>
            <div class="iv-face iv-side-r"></div>
            <div class="iv-face iv-side-b"></div>
        </div>
    </div>

    {{-- Trigger button --}}
    <button class="iv-open-btn"
            data-iv-open
            aria-haspopup="dialog"
            aria-label="Open {{ $title }}">
        {{ $btnLabel }}
    </button>

    {{-- Modal overlay --}}
    <div class="iv-modal-bg" data-iv-modal role="dialog" aria-modal="true" aria-label="{{ $modalTitle }}" hidden>
        <div class="iv-modal">
            <div class="iv-modal-header">
                <span class="iv-modal-title">{{ $modalTitle }}</span>
                <button class="iv-close-btn" data-iv-close aria-label="Close">✕</button>
            </div>
            <div class="iv-modal-body">
                {{-- Slot for custom content --}}
                {{ $slot }}

                {{-- Or use the :content prop array --}}
                @foreach($content as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @if(!$loop->last)
                        <div class="iv-divider" aria-hidden="true"></div>
                    @endif
                @endforeach

                @if($signature)
                    <p class="iv-sig">{{ $signature }}</p>
                @endif
            </div>
        </div>
    </div>

</div>

@once
    @push('styles')
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+English:ital@0;1&family=Cinzel:wght@400;600&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    .iv-scene {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1.25rem;
        min-height: 420px;
        background: #0d0b08;
        border-radius: 12px;
        padding: 2rem;
        overflow: hidden;
        font-family: 'IM Fell English', serif;
    }

    .iv-fog {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 40%, rgba(180,140,60,.12) 0%, transparent 70%);
        pointer-events: none;
    }

    .iv-hint {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        letter-spacing: .15em;
        color: rgba(180,140,60,.5);
        text-transform: uppercase;
    }

    /* ── 3-D wrapper ── */
    .iv-wrapper {
        perspective: 800px;
        cursor: grab;
        user-select: none;
        touch-action: none;
    }
    .iv-wrapper:active { cursor: grabbing; }

    .iv-letter {
        width: 140px;
        height: 190px;
        transform-style: preserve-3d;
        transform: rotateX(10deg) rotateY(-20deg);
        position: relative;
    }

    /* Faces */
    .iv-face {
        position: absolute;
        inset: 0;
        backface-visibility: hidden;
        border-radius: 3px;
    }

    .iv-front {
        background: linear-gradient(160deg, #f5ecd5 0%, #ede0bc 60%, #d9cc9e 100%);
        box-shadow: 0 0 40px rgba(180,140,60,.3), inset 0 0 30px rgba(0,0,0,.08);
        border: 1px solid rgba(160,120,40,.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .iv-back {
        background: linear-gradient(160deg, #e8d9b0 0%, #d9c98a 100%);
        transform: rotateY(180deg);
        border: 1px solid rgba(160,120,40,.3);
    }

    .iv-side-r {
        width: 8px;
        height: 100%;
        right: -8px;
        top: 0;
        background: linear-gradient(to right, #c9b878, #a89050);
        transform: rotateY(90deg);
        transform-origin: left;
        border-radius: 0 3px 3px 0;
    }

    .iv-side-b {
        width: 100%;
        height: 8px;
        bottom: -8px;
        left: 0;
        background: linear-gradient(to bottom, #c9b878, #a89050);
        transform: rotateX(-90deg);
        transform-origin: top;
        border-radius: 0 0 3px 3px;
    }

    .iv-seal {
        width: 38px;
        height: 38px;
        background: radial-gradient(circle, #8b1a1a 0%, #5a0f0f 100%);
        border-radius: 50%;
        border: 2px solid #a03030;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cinzel', serif;
        font-size: 14px;
        color: #f5d080;
        font-weight: 600;
        letter-spacing: .05em;
        box-shadow: 0 2px 8px rgba(0,0,0,.5), inset 0 1px 2px rgba(255,200,100,.2);
    }

    .iv-address {
        font-size: 9px;
        color: #5a4020;
        text-align: center;
        line-height: 1.7;
        font-style: italic;
    }

    /* Floating animation */
    .floating {
        animation: iv-float 3s ease-in-out infinite;
    }

    @keyframes iv-float {
        0%,100% { filter: drop-shadow(0 8px 24px rgba(180,140,60,.4)); }
        50%      { filter: drop-shadow(0 20px 36px rgba(180,140,60,.6)); }
    }

    /* Open button */
    .iv-open-btn {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: .2em;
        background: transparent;
        border: 1px solid rgba(180,140,60,.4);
        color: rgba(180,140,60,.8);
        padding: 8px 20px;
        cursor: pointer;
        text-transform: uppercase;
        border-radius: 2px;
        transition: background .2s, color .2s, border-color .2s;
    }
    .iv-open-btn:hover {
        background: rgba(180,140,60,.1);
        color: #c8a840;
        border-color: rgba(200,168,64,.7);
    }

    /* ── Modal ── */
    .iv-modal-bg {
        position: absolute;
        inset: 0;
        background: rgba(5,3,0,.88);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px;
    }
    .iv-modal-bg[hidden] { display: none; }

    .iv-modal {
        background: linear-gradient(170deg, #f5ecd5, #e8d5a8);
        width: 300px;
        max-width: 90%;
        border-radius: 4px;
        box-shadow: 0 0 60px rgba(180,140,60,.5);
        animation: iv-unfold .4s cubic-bezier(.2,.8,.3,1) both;
        overflow: hidden;
    }

    @keyframes iv-unfold {
        from { transform: scale(.7) rotateX(8deg); opacity: 0; }
        to   { transform: scale(1) rotateX(0);     opacity: 1; }
    }

    .iv-modal-header {
        background: linear-gradient(135deg, #2a1a08, #3d2510);
        padding: 14px 18px;
        border-bottom: 2px solid #a07030;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .iv-modal-title {
        font-family: 'Cinzel', serif;
        color: #d4a840;
        font-size: 13px;
        letter-spacing: .15em;
    }

    .iv-close-btn {
        background: none;
        border: none;
        color: #a07030;
        font-size: 18px;
        cursor: pointer;
        line-height: 1;
        padding: 2px 6px;
        border-radius: 2px;
        transition: color .2s;
        font-family: serif;
    }
    .iv-close-btn:hover { color: #d4a840; }

    .iv-modal-body {
        padding: 20px;
        font-family: 'IM Fell English', serif;
    }
    .iv-modal-body p {
        font-size: 13px;
        color: #3a2510;
        line-height: 1.8;
        margin-bottom: 10px;
    }
    .iv-modal-body p:last-child { margin-bottom: 0; }

    .iv-divider {
        width: 60%;
        height: 1px;
        background: linear-gradient(to right, transparent, #b08840, transparent);
        margin: 10px auto;
    }

    .iv-sig {
        text-align: right;
        font-style: italic;
        font-size: 12px !important;
        color: #6a4020 !important;
        margin-top: 8px !important;
    }
    </style>
    @endpush

    @push('scripts')
    <script>
    (function () {
        document.querySelectorAll('.iv-scene').forEach(function (scene) {
            const letter   = scene.querySelector('.iv-letter');
            const wrapper  = scene.querySelector('.iv-wrapper');
            const openBtn  = scene.querySelector('[data-iv-open]');
            const modal    = scene.querySelector('[data-iv-modal]');
            const closeBtn = scene.querySelector('[data-iv-close]');

            if (!letter || !wrapper) return;

            let dragging = false, lastX = 0, lastY = 0, rx = 10, ry = -20;

            const applyTransform = () => {
                letter.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
            };

            // Mouse drag
            wrapper.addEventListener('mousedown', function (e) {
                dragging = true;
                lastX = e.clientX; lastY = e.clientY;
                letter.classList.remove('floating');
                e.preventDefault();
            });
            document.addEventListener('mousemove', function (e) {
                if (!dragging) return;
                ry += (e.clientX - lastX) * 0.5;
                rx -= (e.clientY - lastY) * 0.5;
                lastX = e.clientX; lastY = e.clientY;
                applyTransform();
            });
            document.addEventListener('mouseup', function () {
                if (dragging) { dragging = false; letter.classList.add('floating'); }
            });

            // Touch drag
            wrapper.addEventListener('touchstart', function (e) {
                dragging = true;
                lastX = e.touches[0].clientX; lastY = e.touches[0].clientY;
                letter.classList.remove('floating');
            }, { passive: true });
            document.addEventListener('touchmove', function (e) {
                if (!dragging) return;
                ry += (e.touches[0].clientX - lastX) * 0.5;
                rx -= (e.touches[0].clientY - lastY) * 0.5;
                lastX = e.touches[0].clientX; lastY = e.touches[0].clientY;
                applyTransform();
            }, { passive: true });
            document.addEventListener('touchend', function () {
                if (dragging) { dragging = false; letter.classList.add('floating'); }
            });

            // Modal open / close
            if (openBtn && modal) {
                openBtn.addEventListener('click', function () {
                    modal.hidden = false;
                    modal.querySelector('.iv-modal').style.animation = 'none';
                    requestAnimationFrame(function () {
                        requestAnimationFrame(function () {
                            modal.querySelector('.iv-modal').style.animation = '';
                        });
                    });
                });
                closeBtn && closeBtn.addEventListener('click', function () {
                    modal.hidden = true;
                });
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) modal.hidden = true;
                });
                // Escape key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !modal.hidden) modal.hidden = true;
                });
            }
        });
    })();
    </script>
    @endpush
@endonce