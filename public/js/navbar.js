class Navbar extends HTMLElement {
  async connectedCallback() {
    try {
      // Inject CSS dynamically
      const style = document.createElement('link');
      style.rel = 'stylesheet';
      style.href = 'css/navbar.css';  // Link to your navbar CSS file
      document.head.appendChild(style);

      // Fetch user data from PHP
      const response = await fetch('php/get_user.php');
      const data = await response.json();

      let fullName = '';

      // Display the user's full name only if it exists
      if (data.first_name && data.last_name) {
        fullName = `${data.first_name} ${data.last_name}`;
      }

      this.innerHTML = `
        <div class="navbar">
          <div class="left">
            <h3>${fullName}</h3>
          </div>
          <div class="mid">
            <a href="dashboard.php">Dashboard</a>
            <a href="attendance.php">Attendance</a>
            <a href="students.php">Students</a>
            <a href="about.php">About</a>
          </div>
          <div class="right">
            <!-- Dark Mode Toggle -->
            <label class="switch">
              <input type="checkbox" id="darkModeToggle">
              <span class="slider"></span>
            </label>

            <form action="php/signout.php" method="POST" style="display: inline;">
              <button type="submit">Sign Out</button>
            </form>
          </div>
        </div>
      `;

      // Initialize dark mode toggle after rendering the navbar
      const toggle = document.getElementById('darkModeToggle');
      
      // Check for saved preference
      const darkMode = localStorage.getItem('darkMode') === 'true';
      
      // Set initial state
      if (darkMode) {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
      }

      // Add event listener
      toggle.addEventListener('change', () => {
        document.body.classList.toggle('dark-mode');
        // Save preference
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
      });
      
    } catch (error) {
      console.error('Error fetching user data:', error);

      // If there's an error, keep the navbar without any name
      this.innerHTML = `
        <div class="navbar">
          <div class="left">
            <h3></h3>
          </div>
          <div class="mid">
            <a href="dashboard.php">Dashboard</a>
            <a href="attendance.php">Attendance</a>
            <a href="students.php">Students</a>
            <a href="about.php">About</a>
          </div>
          <div class="right">
            <!-- Dark Mode Toggle -->
            <label class="switch">
              <input type="checkbox" id="darkModeToggle">
              <span class="slider"></span>
            </label>

            <form action="php/signout.php" method="POST" style="display: inline;">
              <button type="submit">Sign Out</button>
            </form>
          </div>
        </div>
      `;
      
      // Initialize dark mode toggle even in error case
      const toggle = document.getElementById('darkModeToggle');
      
      // Check for saved preference
      const darkMode = localStorage.getItem('darkMode') === 'true';
      
      // Set initial state
      if (darkMode) {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
      }

      // Add event listener
      toggle.addEventListener('change', () => {
        document.body.classList.toggle('dark-mode');
        // Save preference
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
      });
    }
  }
}

customElements.define('nav-bar', Navbar);