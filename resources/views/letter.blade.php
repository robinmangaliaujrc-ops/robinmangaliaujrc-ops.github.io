<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English:ital@0;1&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080604;
            --fg: #f7f9f2;
            --hint: rgba(130,220,140,.8);
            --accent: #56b36f;
            --accent-strong: #1f6d36;
            --card-bg: #0f3c16;
            --card-bg-mid: #1a5728;
            --card-bg-dark: #214d26;
            --card-border: rgba(255,255,255,.12);
            --card-shadow: rgba(0,0,0,.4);
            --modal-bg: #eef8ee;
            --modal-bg-alt: #cfe8d4;
            --modal-header: #1d4c25;
            --modal-header-alt: #2d6e31;
            --modal-title: #c5f2ac;
            --modal-text: #214c2e;
            --button-border: rgba(80,180,100,.4);
            --button-color: rgba(120,220,120,.95);
            --button-hover: rgba(80,180,100,.12);
            --control-bg: rgba(255,255,255,.08);
            --control-border: rgba(255,255,255,.12);
            --confirmation-bg: rgba(255,255,255,.15);
            --confirmation-text: #0f3c16;
            --card-flap: #1f712d;
            --card-bottom: #5ab877;
            --glow: rgba(86,179,111,.38);
            --glow-strong: rgba(86,179,111,.55);
        }

        .theme-light {
            --bg: #f3f3e8;
            --fg: #1c2c1d;
            --hint: rgba(76,114,86,.9);
            --accent: #5a8a54;
            --accent-strong: #2c5938;
            --card-bg: #dfe8d6;
            --card-bg-mid: #c9d6c4;
            --card-bg-dark: #b3c1ac;
            --card-flap: #aec2a4;
            --card-bottom: #85b379;
            --glow: rgba(90,138,84,.36);
            --glow-strong: rgba(90,138,84,.5);
            --card-border: rgba(30,70,30,.16);
            --card-shadow: rgba(0,0,0,.18);
            --modal-bg: #f7faf5;
            --modal-bg-alt: #d6e4d7;
            --modal-header: #5a7e5a;
            --modal-header-alt: #4d6e4e;
            --modal-title: #edf5e9;
            --modal-text: #2e472f;
            --button-border: rgba(80,180,100,.35);
            --button-color: rgba(45,90,45,.95);
            --button-hover: rgba(80,180,100,.14);
            --control-bg: rgba(20,60,20,.08);
            --control-border: rgba(20,60,20,.18);
            --confirmation-bg: rgba(255,255,255,.9);
            --confirmation-text: #1d3d22;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--fg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'IM Fell English', serif;
        }

        /* ── Scene ── */
        .iv-scene {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.25rem;
            width: auto;
            max-width: none;
            background: transparent;
            border-radius: 0;
            padding: 0;
            overflow: visible;
        }

        .iv-fog {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 40%, rgba(60,180,100,.14) 0%, transparent 70%);
            pointer-events: none;
        }

        .iv-hint {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            letter-spacing: .15em;
            color: var(--accent);
            text-transform: uppercase;
            text-shadow: 0 0 20px rgba(0,0,0,.28), 0 0 26px rgba(255,255,255,.12);
        }

        /* ── 3-D wrapper ── */
        .iv-wrapper {
            perspective: 900px;
            cursor: grab;
            user-select: none;
            touch-action: none;
        }
        .iv-wrapper:active { cursor: grabbing; }

        .iv-letter {
            width: 460px;
            height: 280px;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            transform-origin: center center;
            transform: rotateX(12deg) rotateY(-22deg);
            position: relative;
        }

        /* ── Faces ── */
        .iv-face {
            position: absolute;
            inset: 0;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            border-radius: 8px;
            overflow: hidden;
        }

        .iv-front {
            -webkit-transform: rotateY(0deg) translateZ(1px);
            transform: rotateY(0deg) translateZ(1px);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: 2;
            background: linear-gradient(145deg, var(--card-bg) 0%, var(--card-bg-mid) 55%, var(--card-bg-dark) 100%);
            border: 1px solid var(--card-border);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.08), 0 18px 40px var(--card-shadow);
            color: var(--fg);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 48px;
        }

        .iv-front::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.55) 0%, rgba(255,255,255,0) 45%);
            opacity: .14;
            pointer-events: none;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .iv-front::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 15% 20%, rgba(255,255,255,.08) 0, transparent 12%),
                radial-gradient(circle at 75% 10%, rgba(255,255,255,.06) 0, transparent 14%),
                linear-gradient(180deg, rgba(255,255,255,.03) 0%, transparent 30%, transparent 70%, rgba(255,255,255,.03) 100%),
                repeating-linear-gradient(0deg, rgba(255,255,255,.02), rgba(255,255,255,.02) 1px, transparent 1px, transparent 4px),
                repeating-linear-gradient(90deg, rgba(255,255,255,.015), rgba(255,255,255,.015) 1px, transparent 1px, transparent 5px);
            opacity: .6;
            pointer-events: none;
            mix-blend-mode: screen;
            filter: saturate(1.1) contrast(1.05);
        }

        .iv-back {
            -webkit-transform: rotateY(180deg) translateZ(1px);
            transform: rotateY(180deg) translateZ(1px);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: 1;
            background: linear-gradient(145deg, var(--card-bg-dark) 0%, var(--card-bg-mid) 55%, var(--card-bg) 100%);
            border: 1px solid rgba(80,140,70,.3);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.12);
        }

        .iv-back-flap {
            position: absolute;
            inset: 0;
            clip-path: polygon(0 0, 100% 0, 50% 60%, 0 0);
            background: linear-gradient(135deg, var(--card-flap) 0%, var(--card-bg) 100%);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: 0;
        }

        .iv-back-flap::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.08) 1px, transparent 1px);
            background-size: 12px 12px;
            opacity: .35;
            pointer-events: none;
        }

        .iv-title {
            position: relative;
            z-index: 1;
            font-size: 14px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255,255,255,.96);
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            margin-top: -8px;
            text-shadow: 0 0 26px rgba(0,0,0,.45), 0 0 18px rgba(255,255,255,.18);
        }

        .iv-date {
            position: relative;
            z-index: 1;
            text-align: right;
            color: rgba(255,255,255,.84);
            font-size: 16px;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-weight: 600;
            text-shadow: 0 0 18px rgba(0,0,0,.3);
            margin-top: 12px;
        }

        .iv-stamp {
            position: absolute;
            top: 120px;
            right: 200px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #ffffff;
            color: var(--accent-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            letter-spacing: .14em;
            text-transform: uppercase;
            border: 1px solid rgba(31,109,54,.18);
            box-shadow: 0 2px 6px rgba(0,0,0,.14);
            z-index: 1;
        }

        .iv-address {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 10px;
            font-size: 16px;
            color: var(--fg);
            line-height: 1.1;
            margin-top: 72px;
            padding-right: 12px;
        }

        .iv-address span {
            display: block;
        }

        .iv-side-r {
            width: 10px;
            height: 100%;
            right: -10px;
            top: 0;
            background: linear-gradient(to right, var(--card-bottom), var(--card-bg-mid));
            transform: rotateY(90deg);
            transform-origin: left;
            border-radius: 0 8px 8px 0;
        }

        .iv-side-b {
            width: 100%;
            height: 10px;
            bottom: -10px;
            left: 0;
            background: linear-gradient(to bottom, var(--card-bottom), var(--card-bg-mid));
            transform: rotateX(-90deg);
            transform-origin: top;
            border-radius: 0 0 8px 8px;
        }

        .iv-letter .iv-front,
        .iv-letter .iv-back {
            transition: transform .15s ease, opacity .15s ease;
        }


        /* ── Float animation ── */
        .floating {
            animation: iv-float 3s ease-in-out infinite;
        }

        @keyframes iv-float {
            0%,100% { filter: drop-shadow(0 8px 24px var(--glow)); }
            50%      { filter: drop-shadow(0 20px 36px var(--glow-strong)); }
        }

        /* ── Open button ── */
        .iv-open-btn {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: .22em;
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            padding: 16px 40px;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 4px;
            transition: background .2s, color .2s, border-color .2s, box-shadow .2s;
        }
        .iv-open-btn:hover {
            background: var(--button-hover);
            color: var(--accent);
            border-color: var(--accent-strong);
            box-shadow: 0 0 22px rgba(0,0,0,.08);
        }

        .iv-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .iv-settings {
            position: absolute;
            top: 8px;
            right: 12px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
            z-index: 10;
        }

        .iv-settings-toggle {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: .22em;
            color: var(--accent);
            background: rgba(0,0,0,.18);
            border: 1px solid var(--accent);
            border-radius: 999px;
            padding: 12px 18px;
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }
        .iv-settings-toggle:hover {
            background: rgba(255,255,255,.08);
            transform: translateY(-1px);
        }

        .iv-settings-panel {
            position: relative;
            width: min(360px, calc(100vw - 32px));
            background: rgba(16,20,12,.92);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(0,0,0,.28);
            overflow: hidden;
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
            max-height: 0;
            padding: 0 18px;
            transition: opacity .26s ease, transform .26s ease, max-height .26s ease, padding .26s ease;
        }
        .iv-settings.open .iv-settings-panel {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            max-height: 240px;
            padding: 16px 18px 18px;
        }

        .iv-settings-panel::before {
            content: '';
            position: absolute;
            top: 100%;
            right: 26px;
            width: 12px;
            height: 12px;
            background: rgba(16,20,12,.92);
            border-left: 1px solid rgba(255,255,255,.1);
            border-top: 1px solid rgba(255,255,255,.1);
            transform: translateY(-50%) rotate(45deg);
            z-index: -1;
        }

        .iv-theme-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .iv-theme-switcher {
            display: inline-flex;
            border: 1px solid var(--control-border);
            border-radius: 999px;
            overflow: hidden;
            background: var(--control-bg);
        }

        .iv-theme-btn {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: .2em;
            padding: 10px 14px;
            border: none;
            color: var(--fg);
            background: transparent;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .iv-theme-btn--active,
        .iv-theme-btn:hover {
            background: rgba(255,255,255,.12);
        }

        .iv-color-picker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            letter-spacing: .14em;
            color: var(--fg);
            padding: 10px 12px;
            border-radius: 999px;
            background: var(--control-bg);
            border: 1px solid var(--control-border);
        }

        .iv-color-picker input {
            width: 34px;
            height: 34px;
            border: none;
            padding: 0;
            background: transparent;
            cursor: pointer;
        }

        /* ── Modal ── */
        .iv-modal-bg {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(5,3,0,.88);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            border-radius: 0;
        }
        .iv-modal-bg[hidden] { display: none; }

        html.iv-modal-open,
        body.iv-modal-open {
            overflow: hidden;
            height: 100%;
        }

        .iv-modal {
            background: linear-gradient(170deg, var(--modal-bg), var(--modal-bg-alt));
            width: 860px;
            min-width: 720px;
            max-width: calc(100vw - 32px);
            border-radius: 8px;
            box-shadow: 0 0 90px rgba(40,180,90,.35);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .iv-modal.opening {
            animation: iv-unfold .4s cubic-bezier(.2,.8,.3,1) both;
        }

        @keyframes iv-unfold {
            from { transform: scale(.7) rotateX(8deg); opacity: 0; }
            to   { transform: scale(1) rotateX(0);     opacity: 1; }
        }

        .iv-modal-header {
            background: linear-gradient(135deg, var(--modal-header), var(--modal-header-alt));
            padding: 14px 18px;
            border-bottom: 2px solid rgba(60,180,100,.6);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .iv-modal-title {
            font-family: 'Cinzel', serif;
            color: var(--modal-title);
            font-size: 13px;
            letter-spacing: .15em;
        }

        .iv-close-btn {
            background: none;
            border: none;
            color: #c5f2ac;
            font-size: 18px;
            cursor: pointer;
            line-height: 1;
            padding: 2px 6px;
            border-radius: 2px;
            transition: color .2s;
            font-family: serif;
        }
        .iv-close-btn:hover { color: #ecffe9; }

        .iv-modal-body {
            padding: 28px 32px;
            font-family: 'IM Fell English', serif;
        }
        .iv-modal-body p {
            font-size: 15px;
            color: var(--modal-text);
            line-height: 1.8;
            margin-bottom: 16px;
        }
        .iv-modal-body p:last-child { margin-bottom: 0; }

        .iv-rsvp-row {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .iv-rsvp-btn {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: .16em;
            text-transform: uppercase;
            padding: 14px 28px;
            border-radius: 999px;
            border: 1px solid rgba(31,109,54,.25);
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .iv-rsvp-btn--yes {
            background: var(--accent);
            color: #f7fdf5;
        }

        .iv-rsvp-btn--no {
            background: #ffffff;
            color: var(--accent-strong);
            box-shadow: inset 0 0 0 1px rgba(31,109,54,.18);
        }

        .iv-rsvp-btn:hover {
            transform: translateY(-1px);
            opacity: .95;
        }

        .iv-rsvp-confirmation {
            margin-top: 0;
            padding: 0 18px;
            border-radius: 6px;
            background: rgba(255,255,255,.15);
            color: #0f3c16;
            font-size: 14px;
            text-align: center;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            letter-spacing: .02em;
            border: 1px solid rgba(255,255,255,.12);
            transform: scale(0.96);
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: transform .18s ease, opacity .18s ease, box-shadow .18s ease, max-height .18s ease, margin-top .18s ease, padding .18s ease;
        }

        .iv-rsvp-confirmation.pop {
            margin-top: 18px;
            padding: 14px 18px;
            min-height: 42px;
            max-height: 120px;
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 12px 28px rgba(0,0,0,.12);
        }

        .iv-rsvp-confirmation.pop::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 6px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.22);
            pointer-events: none;
        }

        .iv-divider {
            width: 60%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(60,180,100,.8), transparent);
            margin: 10px auto;
        }

        .iv-sig {
            text-align: right;
            font-style: italic;
            font-size: 12px !important;
            color: #3b6c3e !important;
            margin-top: 8px !important;
        }
    </style>
</head>
<body>
{{-- Trigger button — change label here --}}
        <div class="iv-settings" id="iv-settings">
            <button class="iv-settings-toggle" id="iv-settings-toggle" aria-expanded="false" aria-controls="iv-settings-panel">
                Settings
            </button>
            <div class="iv-settings-panel" id="iv-settings-panel">
                <div class="iv-theme-controls">
                    <div class="iv-theme-switcher" role="group" aria-label="Theme mode toggle">
                        <button class="iv-theme-btn iv-theme-btn--active" type="button" data-theme="dark">Dark</button>
                        <button class="iv-theme-btn" type="button" data-theme="light">Light</button>
                    </div>
                    <label class="iv-color-picker">
                        <span>Accent</span>
                        <input type="color" id="iv-theme-color" value="#56b36f" aria-label="Accent color picker">
                    </label>
                </div>
            </div>
        </div>
    {{-- ============================================================
         ITEM VIEWER
         To customise: edit the text content in the HTML below.
         To use as a reusable Blade component, move this into
         resources/views/components/item-viewer.blade.php and
         replace hardcoded values with $props.
    ============================================================ --}}

    <div class="iv-scene" role="region" aria-label="Item Viewer">

        <div class="iv-fog" aria-hidden="true"></div>

        <p class="iv-hint" aria-hidden="true">— you are invited! —</p>

        {{-- 3-D Letter --}}
        <div class="iv-wrapper" role="img" aria-label="3D rotating letter">
            <div class="iv-letter floating" id="iv-letter">
                <div class="iv-face iv-front">
                    <div class="iv-back-flap"></div>
                    <div class="iv-title">Wedding Invitation<br>03/14/2032</div>
                    <div class="iv-stamp">G&R</div>
                    <div class="iv-address">
                        <!-- <span>Guest Name</span>
                        <span>Baguio Cathedral and Diocesan Shrine of Our Lady of the Atonement</span>
                        <span>Baguio, Benguet</span> -->
                    </div>
                </div>
                <div class="iv-face iv-back"></div>
                <div class="iv-face iv-side-r"></div>
                <div class="iv-face iv-side-b"></div>
            </div>
        </div>

        
        <div class="iv-actions">
            <button class="iv-open-btn" id="iv-open-btn" aria-haspopup="dialog" aria-label="Open letter">
                Open Letter
            </button>
        </div>

        {{-- Modal --}}
        <div class="iv-modal-bg" id="iv-modal" role="dialog" aria-modal="true" aria-label="Confidential Correspondence" hidden>
            <div class="iv-modal">
                <div class="iv-modal-header">
                    {{-- Change modal title here --}}
                    <span class="iv-modal-title">Confidential Correspondence</span>
                    <button class="iv-close-btn" id="iv-close-btn" aria-label="Close">✕</button>
                </div>
                        <div class="iv-modal-body">
                    {{-- Change letter content here --}}
                    <p>Dear Friend,</p>
                    <p>We are delighted to invite you to celebrate our wedding ceremony and reception. Please join us for an evening of vows, dinner, and dancing as we begin our new life together.</p>
                    <p><strong>Date:</strong> Sunday, March 14, 2032<br>
                    <strong>Time:</strong> 4:30 PM<br>
                    <strong>Venue:</strong> Baguio Cathedral and Diocesan Shrine of Our Lady of the Atonement</p>
                    <p>Your presence would mean the world to us.</p>
                    <p class="iv-sig">With love,<br>Glen &amp; Robin</p>
                    <div class="iv-divider" aria-hidden="true"></div>
                    <div class="iv-rsvp-row">
                        <button class="iv-rsvp-btn iv-rsvp-btn--yes" type="button">Going</button>
                        <button class="iv-rsvp-btn iv-rsvp-btn--no" type="button">Not Going</button>
                    </div>
                    <div class="iv-rsvp-confirmation" id="iv-rsvp-confirmation" aria-live="polite"></div>
                </div>
            </div>
        </div>

    </div>

    <script>
    (function () {
        const letter   = document.getElementById('iv-letter');
        const wrapper  = document.querySelector('.iv-wrapper');
        const openBtn  = document.getElementById('iv-open-btn');
        const modal    = document.getElementById('iv-modal');
        const closeBtn = document.getElementById('iv-close-btn');
        const yesBtn   = modal.querySelector('.iv-rsvp-btn--yes');
        const noBtn    = modal.querySelector('.iv-rsvp-btn--no');
        const confirmation = document.getElementById('iv-rsvp-confirmation');
        const body     = document.body;
        const themeButtons = document.querySelectorAll('.iv-theme-btn');
        const themeColor  = document.getElementById('iv-theme-color');
        const settingsToggle = document.getElementById('iv-settings-toggle');
        const settingsPanel = document.getElementById('iv-settings-panel');
        const settingsContainer = document.getElementById('iv-settings');
        const root        = document.documentElement;

        let dragging = false, lastX = 0, lastY = 0, rx = 10, ry = -20;

        function applyTransform() {
            letter.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
        }

        function clampAngle(value, min, max) {
            return Math.min(Math.max(value, min), max);
        }

        function hexToRgb(hex) {
            const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
            hex = hex.replace(shorthandRegex, function(m, r, g, b) {
                return r + r + g + g + b + b;
            });
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function rgbToHsl(r, g, b) {
            r /= 255;
            g /= 255;
            b /= 255;
            const max = Math.max(r, g, b);
            const min = Math.min(r, g, b);
            let h, s;
            const l = (max + min) / 2;
            if (max === min) {
                h = s = 0;
            } else {
                const d = max - min;
                s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
                switch (max) {
                    case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                    case g: h = (b - r) / d + 2; break;
                    case b: h = (r - g) / d + 4; break;
                }
                h /= 6;
            }
            return { h, s, l };
        }

        function hslToHex(h, s, l) {
            let r, g, b;
            if (s === 0) {
                r = g = b = l;
            } else {
                const hue2rgb = function(p, q, t) {
                    if (t < 0) t += 1;
                    if (t > 1) t -= 1;
                    if (t < 1/6) return p + (q - p) * 6 * t;
                    if (t < 1/2) return q;
                    if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                    return p;
                };
                const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                const p = 2 * l - q;
                r = hue2rgb(p, q, h + 1/3);
                g = hue2rgb(p, q, h);
                b = hue2rgb(p, q, h - 1/3);
            }
            const toHex = function(x) {
                const hex = Math.round(x * 255).toString(16);
                return hex.length === 1 ? '0' + hex : hex;
            };
            return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
        }

        function updateCardPalette(hex) {
            const rgb = hexToRgb(hex);
            if (!rgb) return;
            const hsl = rgbToHsl(rgb.r, rgb.g, rgb.b);
            const isLight = root.classList.contains('theme-light');
            const baseLight = isLight ? 0.72 : 0.25;
            const midLight = isLight ? 0.62 : 0.35;
            const darkLight = isLight ? 0.52 : 0.45;
            root.style.setProperty('--accent', hex);
            root.style.setProperty('--accent-strong', hslToHex(hsl.h, Math.min(1, hsl.s * 1.1), Math.max(0, hsl.l - 0.22)));
            root.style.setProperty('--card-bg', hslToHex(hsl.h, Math.min(1, hsl.s * 0.9), baseLight));
            root.style.setProperty('--card-bg-mid', hslToHex(hsl.h, Math.min(1, hsl.s * 0.75), midLight));
            root.style.setProperty('--card-bg-dark', hslToHex(hsl.h, Math.min(1, hsl.s * 0.6), darkLight));
            root.style.setProperty('--card-flap', hslToHex(hsl.h, Math.min(1, hsl.s * 0.65), Math.max(0, hsl.l - 0.12)));
            root.style.setProperty('--card-bottom', hslToHex(hsl.h, Math.min(1, hsl.s * 1.05), Math.min(1, hsl.l + 0.16)));
            root.style.setProperty('--glow', `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, .34)`);
            root.style.setProperty('--glow-strong', `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, .58)`);
            root.style.setProperty('--button-border', hex + '55');
            root.style.setProperty('--button-hover', `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, .14)`);
        }

        applyTransform();

        // Mouse drag
        wrapper.addEventListener('mousedown', function (e) {
            dragging = true;
            lastX = e.clientX;
            lastY = e.clientY;
            letter.classList.remove('floating');
            e.preventDefault();
        });

        document.addEventListener('mousemove', function (e) {
            if (!dragging) return;
            ry = clampAngle(ry + (e.clientX - lastX) * 0.5, -45, 45);
            rx = clampAngle(rx - (e.clientY - lastY) * 0.5, -30, 30);
            lastX = e.clientX;
            lastY = e.clientY;
            applyTransform();
        });

        document.addEventListener('mouseup', function () {
            if (dragging) {
                dragging = false;
                letter.classList.add('floating');
                applyTransform();
            }
        });

        // Touch drag
        wrapper.addEventListener('touchstart', function (e) {
            dragging = true;
            lastX = e.touches[0].clientX;
            lastY = e.touches[0].clientY;
            letter.classList.remove('floating');
        }, { passive: true });

        document.addEventListener('touchmove', function (e) {
            if (!dragging) return;
            ry = clampAngle(ry + (e.touches[0].clientX - lastX) * 0.5, -45, 45);
            rx = clampAngle(rx - (e.touches[0].clientY - lastY) * 0.5, -30, 30);
            lastX = e.touches[0].clientX;
            lastY = e.touches[0].clientY;
            applyTransform();
        }, { passive: true });

        document.addEventListener('touchend', function () {
            if (dragging) {
                dragging = false;
                letter.classList.add('floating');
                applyTransform();
            }
        });

        let confirmationTimeout;

        function openModal() {
            modal.hidden = false;
            body.classList.add('iv-modal-open');
            document.documentElement.classList.add('iv-modal-open');
            confirmation.textContent = '';
            confirmation.classList.remove('pop');
            clearTimeout(confirmationTimeout);
            const m = modal.querySelector('.iv-modal');
            m.classList.remove('opening');
            void m.offsetWidth;
            m.classList.add('opening');
        }

        function closeModal() {
            const m = modal.querySelector('.iv-modal');
            modal.hidden = true;
            body.classList.remove('iv-modal-open');
            document.documentElement.classList.remove('iv-modal-open');
            m.classList.remove('opening');
            confirmation.textContent = '';
            confirmation.classList.remove('pop');
            clearTimeout(confirmationTimeout);
        }

        // Theme controls
        themeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                themeButtons.forEach(function (other) {
                    other.classList.remove('iv-theme-btn--active');
                });
                btn.classList.add('iv-theme-btn--active');
                root.classList.toggle('theme-light', btn.dataset.theme === 'light');
                updateCardPalette(themeColor.value);
            });
        });

        settingsToggle.addEventListener('click', function () {
            const open = settingsContainer.classList.toggle('open');
            settingsToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        themeColor.addEventListener('input', function () {
            updateCardPalette(themeColor.value);
        });

        updateCardPalette(themeColor.value);

        // Open modal
        openBtn.addEventListener('click', openModal);

        // Close modal
        closeBtn.addEventListener('click', closeModal);

        function showConfirmation(message) {
            confirmation.textContent = message;
            confirmation.classList.remove('pop');
            void confirmation.offsetWidth;
            confirmation.classList.add('pop');
            clearTimeout(confirmationTimeout);
            confirmationTimeout = setTimeout(function () {
                confirmation.classList.remove('pop');
            }, 3200);
        }

        // RSVP buttons
        yesBtn.addEventListener('click', function () {
            showConfirmation('Wonderful! We look forward to celebrating with you.');
        });

        noBtn.addEventListener('click', function () {
            showConfirmation('Thank you for letting us know. We will miss you at the celebration.');
        });

        // Click outside modal to close
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        // Escape key to close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.hidden) closeModal();
        });
    })();
    </script>

</body>
</html>