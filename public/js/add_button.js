class FixedButton extends HTMLElement {
    connectedCallback() {
        const faLink = document.createElement("link");
        faLink.rel = "stylesheet";
        faLink.href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css";
        document.head.appendChild(faLink);

        // Inject CSS for buttons, modal form, and file input
        const style = document.createElement('style');
        style.textContent = `
            .button-container {
                position: fixed;
                bottom: 20px;
                right: 20px;
                display: flex;
                gap: 15px; 
                z-index: 1000;
            }

            .fixed-button {
                background-color: #f74a4a; /* Red for Add */
                color: #fff;
                border: none;
                padding: 15px;
                font-size: 20px;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                cursor: pointer;
                transition: background 0.3s, transform 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                width: 50px;
                height: 50px;
            }

            .fixed-button:hover {
                background-color: #d93a3a;
                transform: scale(1.1);
            }

            .import-button {
                background-color: #4caf50; /* Green for Import */
            }

            .import-button:hover {
                background-color: #45a049;
            }

            .fixed-button i {
                font-size: 24px;
            }

            /* Hidden file input */
            #fileInput {
                display: none;
            }

            /* Modal Styling */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.5);
                transition: opacity 0.3s ease;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 40%;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                transition: transform 0.3s ease;
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 20px;
                margin-bottom: 15px;
            }

            .modal input, .modal select {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .modal button {
                background-color: #4caf50;
                color: white;
                border: none;
                padding: 10px 20px;
                margin: 10px 5px;
                cursor: pointer;
                border-radius: 5px;
                transition: background 0.3s;
            }

            .modal button:hover {
                background-color: #45a049;
            }

            .close {
                color: #aaa;
                font-size: 28px;
                cursor: pointer;
            }
        `;
        document.head.appendChild(style);

        // ✅ Add the button container with Add and Import buttons
        this.innerHTML = `
            <div class="button-container">
                <!-- Add Button -->
                <button class="fixed-button" id="btnAdd" title="Add">
                    <i class="fa-solid fa-plus"></i>
                </button>

                <!-- Import Button -->
                <button class="fixed-button import-button" id="btnImport" title="Import">
                    <i class="fa-solid fa-download"></i>
                </button>

                <!-- Hidden File Input -->
                <input type="file" id="fileInput" accept=".xlsx, .xls" />
            </div>

            <div id="addStudentModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add Student</h2>
                        <span class="close">&times;</span>
                    </div>
                    <form id="addStudentForm">
                        <label>Roll No:</label>
                        <input type="text" id="roll_no" name="roll_no" placeholder="Auto-filled (last roll no + 1)" readonly>

                        <label>PRN No:</label>
                        <input type="text" id="prn_no" name="prn_no" placeholder="MMTCXXX" required>

                        <label>Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required>

                        <label>Class:</label>
                        <select id="class_name" name="class_name" required>
                            <option value="">Select Class</option>
                        </select>

                        <label>Course:</label>
                        <input type="text" id="course" name="course" readonly>

                        <button type="submit">Add Student</button>
                    </form>
                </div>
            </div>
        `;

        // ✅ Modal logic
        const modal = this.querySelector("#addStudentModal");
        const closeModal = this.querySelector(".close");
        const addButton = this.querySelector("#btnAdd");

        addButton.addEventListener("click", () => {
            modal.style.display = "block";
            loadClasses();
        });

        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // ✅ Handle Import Button Click
        this.querySelector("#btnImport").addEventListener("click", () => {
            const fileInput = this.querySelector("#fileInput");
            fileInput.click();  // Trigger file input dialog

            fileInput.onchange = () => {
                const file = fileInput.files[0];

                if (file) {
                    const formData = new FormData();
                    formData.append("excelFile", file);

                    alert("Uploading Excel file...");

                    fetch('php/import_excel.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.success ? `✅ ${data.success}` : `❌ ${data.error}`);
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("❌ Failed to upload file.");
                        });
                }
            };
        });

        // ✅ Fetch the last roll number
        async function getLastRollNo(className) {
            const response = await fetch(`php/get_last_roll_no.php?class_name=${className}`);
            const data = await response.json();

            if (data.last_roll_no) {
                const nextRollNo = parseInt(data.last_roll_no) + 1;
                document.getElementById('roll_no').value = nextRollNo;
            } else {
                document.getElementById('roll_no').value = 1;
            }
        }

        // ✅ Load classes dynamically
        function loadClasses() {
            fetch('php/fetch_classes.php')
                .then(response => response.json())
                .then(classes => {
                    const classDropdown = document.getElementById('class_name');
                    classDropdown.innerHTML = `<option value="">Select Class</option>`;

                    classes.forEach(className => {
                        const option = document.createElement('option');
                        option.value = className;
                        option.textContent = className;
                        classDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading classes:', error));
        }

        // ✅ Auto-fill course when class is selected
        document.getElementById('class_name').addEventListener('change', async () => {
            const className = document.getElementById('class_name').value;

            if (className) {
                const response = await fetch(`php/get_course.php?class_name=${className}`);
                const data = await response.json();
                document.getElementById('course').value = data.course;

                getLastRollNo(className);
            }
        });

        this.querySelector("#addStudentForm").addEventListener("submit", (event) => {
            event.preventDefault();  // Prevent page reload

            const formData = new FormData(event.target);

            fetch("php/add_single_student.php", {   // ← This is the missing line
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.success ? `✅ ${data.success}` : `❌ ${data.error}`);

                    // Close the modal on success
                    if (data.success) {
                        const modal = document.querySelector("#addStudentModal");
                        modal.style.display = "none";
                    }
                })
                .catch(error => console.error("Error:", error));
        });

    }
}

customElements.define("fixed-button", FixedButton);
