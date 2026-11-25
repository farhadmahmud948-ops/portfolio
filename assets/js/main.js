(() => {
    const still = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const hero = document.querySelector('.hero');
    const pointer = { x: -9999, y: -9999, on: false };

    hero.addEventListener('pointermove', (event) => {
        if (event.pointerType === 'touch') return;
        const box = hero.getBoundingClientRect();
        pointer.x = event.clientX - box.left;
        pointer.y = event.clientY - box.top;
        pointer.on = true;
    });
    hero.addEventListener('pointerleave', () => { pointer.on = false; });

    /* ---------- Name: each letter's width follows the pointer ---------- */
    const MIN = 50, MAX = 150;
    const words = [...document.querySelectorAll('.word')].map((el) => {
        const text = el.textContent.trim();
        el.textContent = '';
        const letters = [...text].map((char) => {
            const span = document.createElement('span');
            span.textContent = char;
            el.append(span);
            return { el: span, now: MIN, target: 85, drawn: 0, center: 0 };
        });
        return { el, letters, base: 85 };
    });

    const setWidth = (letter, value) => { letter.el.style.fontStretch = value.toFixed(1) + '%'; };
    const total = (word) => word.letters.reduce((sum, l) => sum + l.el.getBoundingClientRect().width, 0);

    // Find the letter width that fills the space beside the portrait.
    function fit() {
        const origin = hero.getBoundingClientRect();
        for (const word of words) {
            const style = getComputedStyle(word.el);
            const inner = word.el.clientWidth - parseFloat(style.paddingLeft) - parseFloat(style.paddingRight);
            const room = inner * 0.97;
            let low = MIN, high = MAX;
            for (let i = 0; i < 8; i++) {
                const mid = (low + high) / 2;
                word.letters.forEach((l) => setWidth(l, mid));
                if (total(word) > room) high = mid; else low = mid;
            }
            word.base = low;
            word.letters.forEach((l) => setWidth(l, low));
            const top = word.el.getBoundingClientRect();
            word.y = top.top - origin.top + top.height / 2;
            word.letters.forEach((l) => {
                const r = l.el.getBoundingClientRect();
                l.center = r.left - origin.left + r.width / 2;
                setWidth(l, still ? low : l.now);
            });
        }
    }

    function moveLetters() {
        for (const word of words) {
            const reach = hero.clientWidth * 0.16;
            const near = word.letters.map((l) => {
                if (!pointer.on) return 0;
                const dx = (pointer.x - l.center) / reach;
                const dy = (pointer.y - word.y) / (reach * 1.3);
                return Math.exp(-(dx * dx + dy * dy));
            });
            // Wider letters are paid for by the others, so the word keeps its length.
            const mean = near.reduce((a, b) => a + b, 0) / near.length;
            const swing = Math.min(45, word.base - MIN, MAX - word.base);
            word.letters.forEach((l, i) => {
                l.target = word.base + (near[i] - mean) * swing * 1.3;
                l.now += (l.target - l.now) * 0.09;
                if (Math.abs(l.now - l.drawn) > 0.15) { setWidth(l, l.now); l.drawn = l.now; }
            });
        }
    }

    /* ---------- Background: the jacket's pinstripes, bent by the pointer ---------- */
    const canvas = document.querySelector('.threads');
    const ctx = canvas.getContext('2d');
    const lens = { x: 0, y: 0, power: 0 };
    let w = 0, h = 0;

    function resize() {
        const ratio = Math.min(devicePixelRatio || 1, 2);
        w = canvas.clientWidth;
        h = canvas.clientHeight;
        canvas.width = w * ratio;
        canvas.height = h * ratio;
        ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
    }

    function drawThreads(time) {
        ctx.clearRect(0, 0, w, h);
        ctx.lineWidth = 1;
        ctx.strokeStyle = 'rgba(44, 67, 255, 0.2)';
        ctx.beginPath();
        const radius = Math.max(170, w * 0.15);
        for (let band = 26; band < h + 60; band += 74) {
            for (let line = 0; line < 4; line++) {
                const y0 = band + line * 7;
                for (let x = 0; x <= w + 14; x += 14) {
                    let y = y0 + Math.sin(x * 0.0042 + time * 0.00035 + band * 0.012) * 7;
                    if (lens.power > 0.01) {
                        const dx = x - lens.x, dy = y - lens.y;
                        const pull = Math.exp(-(dx * dx + dy * dy) / (radius * radius));
                        y += dy * pull * 0.75 * lens.power;
                    }
                    if (x === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
                }
            }
        }
        ctx.stroke();
    }

    function frame(time) {
        if (inView) {
            lens.power += ((pointer.on ? 1 : 0) - lens.power) * 0.06;
            if (pointer.on) {
                lens.x += (pointer.x - lens.x) * 0.12;
                lens.y += (pointer.y - lens.y) * 0.12;
            }
            drawThreads(time);
            moveLetters();
            requestAnimationFrame(frame);
        } else {
            running = false;
        }
    }

    let inView = true, running = false;
    function start() {
        if (running || still) return;
        running = true;
        requestAnimationFrame(frame);
    }

    function layout() { resize(); fit(); if (still) drawThreads(0); }

    layout();
    start();
    document.fonts.ready.then(layout);
    addEventListener('resize', layout);
    new IntersectionObserver(([entry]) => {
        inView = entry.isIntersecting;
        if (inView) start();
    }).observe(hero);
})();
