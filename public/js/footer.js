class Footer extends HTMLElement {
    connectedCallback() {
        // Add Font Awesome link dynamically
        const faLink = document.createElement("link");
        faLink.rel = "stylesheet";
        faLink.href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css";
        document.head.appendChild(faLink);

        // Add CSS for the footer
        const cssLink = document.createElement("link");
        cssLink.rel = "stylesheet";
        cssLink.href = "css/footer.css";
        cssLink.type = "text/css";
        document.head.appendChild(cssLink);

        // Set the inner HTML of the footer component with classes for each element
        this.innerHTML = `
          <div class="footer-container">
              <div class="footer-section footer-links-section">
                  <h3 class="footer-heading">Quick Links</h3>
                  <ul class="footer-list">
                      <li class="footer-list-item"><a class="footer-link" href="dashboard.php">Dashboard</a></li>
                      <li class="footer-list-item"><a class="footer-link" href="attendance.php">Attendance</a></li>
                      <li class="footer-list-item"><a class="footer-link" href="students.php">Students</a></li>
                      <li class="footer-list-item"><a class="footer-link" href="about.php">About</a></li>
                  </ul>
              </div>
  
              <div class="footer-section footer-contact-section">
                  <h3 class="footer-heading">Contact Us</h3>
                  <p class="footer-contact-item"><span class="footer-contact-label">Email:</span> <a class="footer-link footer-email-link" href="mailto:info@example.com">info@example.com</a></p>
                  <p class="footer-contact-item"><span class="footer-contact-label">Phone:</span> <a class="footer-link footer-phone-link" href="tel:+1234567890">+1 234 567 890</a></p>
                  <p class="footer-contact-item"><span class="footer-contact-label">Address:</span> <span class="footer-address">123 Main Street, City, Country</span></p>
              </div>
  
              <div class="footer-section footer-social-section">
                  <h3 class="footer-heading">Follow Us</h3>
                  <div class="footer-social-links">
                      <a class="footer-social-link footer-facebook-link" href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                          <i class="fab fa-facebook footer-social-icon"></i>
                      </a>
                      <span class="footer-social-divider">|</span>
                      <a class="footer-social-link footer-twitter-link" href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                          <i class="fab fa-twitter footer-social-icon"></i>
                      </a>
                      <span class="footer-social-divider">|</span>
                      <a class="footer-social-link footer-instagram-link" href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                          <i class="fab fa-instagram footer-social-icon"></i>
                      </a>
                  </div>
              </div>
          </div>
      `;
    }
}

customElements.define("foot-ter", Footer);