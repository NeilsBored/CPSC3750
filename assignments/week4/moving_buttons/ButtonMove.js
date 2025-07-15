(() => {
  //
  const display = document.getElementById('displayArea');
  const makeBtn = document.getElementById('makeBtn');
  const colorSelect = document.getElementById('colorSelect');
  const totalDisplay = document.getElementById('totalDisplay');
  const moveToggle = document.getElementById('moveToggle');

  /* ---------- view‑toggle DOM refs ---------- */
  const controlsSection = document.getElementById('controls');
  const displaySection  = document.getElementById('displayArea');
  const aboutSection    = document.getElementById('about');

  const controlsLink = document.getElementById('controlsLink');
  const displayLink  = document.getElementById('displayLink');
  const aboutLink    = document.getElementById('aboutLink');

  /* ---------- helper functions ---------- */
  function showMainView(show) {
    if (show) {
      controlsSection.classList.remove('hidden');
      displaySection.classList.remove('hidden');
      aboutSection.classList.add('hidden');
    } else {
      controlsSection.classList.add('hidden');
      displaySection.classList.add('hidden');
    }
  }

  function showAboutView(show) {
    if (show) {
      aboutSection.classList.remove('hidden');
      controlsSection.classList.add('hidden');
      displaySection.classList.add('hidden');
    } else {
      aboutSection.classList.add('hidden');
    }
  }

  // start with the About view hidden
  if (aboutSection) aboutSection.classList.add('hidden');

  /* ---------- nav‑link listeners ---------- */
  if (controlsLink && displayLink && aboutLink) {
    controlsLink.addEventListener('click', e => {
      e.preventDefault();
      const mainVisible = !controlsSection.classList.contains('hidden');
      showMainView(!mainVisible);
    });

    displayLink.addEventListener('click', e => {
      e.preventDefault();
      const mainVisible = !controlsSection.classList.contains('hidden');
      showMainView(!mainVisible);
    });

    aboutLink.addEventListener('click', e => {
      e.preventDefault();
      const aboutVisible = !aboutSection.classList.contains('hidden');
      showAboutView(!aboutVisible);
    });
  }

  let total = 0;
  let buttons = [];
  let timer = null;

  makeBtn.onclick = () => {
    const color = colorSelect.value.toLowerCase();
    const n = Math.floor(Math.random() * 100) + 1;
    const btn = document.createElement('button');
    btn.textContent = n;
    btn.className = 'color-btn';
    btn.style.background = color;

    display.appendChild(btn);

    // position
    const { width: W, height: H } = display.getBoundingClientRect();
    const bw = btn.offsetWidth, bh = btn.offsetHeight;
    const x = Math.random() * (W - bw);
    const y = Math.random() * (H - bh);
    btn.style.left = x + 'px';
    btn.style.top  = y + 'px';

    // store velocity
    const vx = (Math.random() - 0.5) * 4;
    const vy = (Math.random() - 0.5) * 4;
    buttons.push({ btn, vx, vy });

    btn.addEventListener('click', () => {
      btn.style.background = colorSelect.value.toLowerCase();
      total += n;
      totalDisplay.textContent = 'Total clicked sum: ' + total;
    });
  };

  moveToggle.onclick = () => {
    if (timer === null) {
      timer = setInterval(moveAll, 40);
      moveToggle.textContent = 'PAUSE';
    } else {
      clearInterval(timer);
      timer = null;
      moveToggle.textContent = 'MOVE';
    }
  };

  function moveAll() {
    const { width: W, height: H } = display.getBoundingClientRect();
    buttons.forEach(obj => {
      let { btn, vx, vy } = obj;
      let x = parseFloat(btn.style.left),
          y = parseFloat(btn.style.top),
          bw = btn.offsetWidth, bh = btn.offsetHeight;

      x += vx; y += vy;

      // bounce
      if (x <= 0 || x + bw >= W) { vx = -vx; x += vx; }
if (y <= 0 || y + bh >= H) { vy = -vy; y += vy; }

      btn.style.left = Math.max(0, Math.min(W - bw, x)) + 'px';
      btn.style.top  = Math.max(0, Math.min(H - bh, y)) + 'px';

      obj.vx = vx; obj.vy = vy;
    });
  }
})();


