class Navbar extends HTMLElement {
  async connectedCallback() {
    try {
      const style = document.createElement('link');
      style.rel = 'stylesheet';
      style.href = '/css/navbar.css';
      document.head.appendChild(style);
      const response = await fetch('/api/user', {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      const data = await response.json();
      let fullName = '';
      if (data && data.first_name && data.last_name) {
        fullName = `${data.first_name} ${data.last_name}`;
      }

      this.innerHTML = `
        <div class="navbar">
          <div class="left">
            <h3>${fullName}</h3>
          </div>

          <div class="mid">
            <a href="/dashboard">Dashboard</a>
            <a href="/attendance">Attendance</a>
            <a href="/students">Students</a>
            <a href="/about">About</a>
          </div>

          <div class="right">
            <!-- Dark Mode Toggle -->
            <label class="switch">
              <input type="checkbox" id="darkModeToggle">
              <span class="slider"></span>
            </label>

            <button id="logoutBtn">Sign Out</button>
          </div>
        </div>
      `;

      this.initDarkMode();
      this.initLogout();

    } catch (error) {
      console.error('Error loading navbar:', error);
    }
  }
  initDarkMode() {
    const toggle = document.getElementById('darkModeToggle');

    const darkMode = localStorage.getItem('darkMode') === 'true';

    if (darkMode) {
      document.body.classList.add('dark-mode');
      toggle.checked = true;
    }

    toggle.addEventListener('change', () => {
      document.body.classList.toggle('dark-mode');
      localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    });
  }
  initLogout() {
    const logoutBtn = document.getElementById('logoutBtn');

    logoutBtn.addEventListener('click', async () => {
      try {
        await fetch('/logout', {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
          }
        });
        window.location.href = '/login';
      } catch (err) {
        console.error('Logout failed:', err);
      }
    });
  }
}

customElements.define('nav-bar', Navbar);