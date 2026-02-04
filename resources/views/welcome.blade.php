<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffFlow</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>
<body>

    <!-- Login Page -->
    <div id="loginPage" class="login-form active">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h2>StaffFlow</h2>
                    <p>Personnel Management System</p>
                </div>
                <form id="loginFormSubmit">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" id="loginUsername" class="form-control form-control-lg" 
                               placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" id="loginPassword" class="form-control form-control-lg" 
                               placeholder="Enter your password" required>
                    </div>
                    <div id="loginError" class="alert alert-danger" style="display: none; margin-bottom: 1rem;"></div>
                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    <div class="mt-3 text-center">
                        <small class="text-muted">Demo: username: <strong>admin</strong> | password: <strong>password</strong></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content (Hidden until login) -->
    <div id="mainContent" class="main-content">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="fas fa-users-cog"></i> StaffFlow
            </span>
            <div class="navbar-content">
                <span class="navbar-text">Welcome, <strong id="userNameDisplay">User</strong></span>
                <button type="button" id="logoutBtn" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container container-main">

        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-building"></i> Personnel Records</h1>
            <p>Manage and organize staff information for schools, organizations, and clinics</p>
        </div>

        <!-- Statistics -->
        <div class="stats-container">
            <div class="stat-card">
                <i class="fas fa-users" style="font-size: 2rem; color: #667eea;"></i>
                <div class="stat-number" id="totalCount">0</div>
                <div class="stat-label">Total Personnel</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-briefcase" style="font-size: 2rem; color: #764ba2;"></i>
                <div class="stat-number" id="departmentCount">0</div>
                <div class="stat-label">Departments</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-search" style="font-size: 2rem; color: #667eea;"></i>
                <div class="stat-number" id="searchCount">0</div>
                <div class="stat-label">Search Results</div>
            </div>
        </div>

        <!-- Add Personnel Button -->
        <div class="row mb-4">
            <div class="col">
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addPersonnelModal">
                    <i class="fas fa-plus"></i> Add New Personnel
                </button>
            </div>
        </div>

        <!-- Personnel Records Card -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i> Personnel Records
                    </div>
                    <div class="card-body">
                        <!-- Search Box -->
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" class="form-control form-control-lg" 
                                   placeholder="Search by name, email, phone, department, or position...">
                        </div>

                        <!-- Filter Options -->
                        <div class="mb-3">
                            <label class="form-label">Filter by Department:</label>
                            <select id="departmentFilter" class="form-select">
                                <option value="">All Departments</option>
                            </select>
                        </div>

                        <!-- Records Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="personnelTable">
                                    <tr id="emptyState">
                                        <td colspan="8" class="empty-state">
                                            <div>
                                                <i class="fas fa-inbox"></i>
                                                <p>No personnel records found. Click "Add New Personnel" to get started.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    <!-- Add/Edit Personnel Modal -->
    <div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="fas fa-user-plus"></i> Add New Personnel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="personnelForm">
                        <input type="hidden" id="editingId">
                        
                        <div class="form-row">
                            <div>
                                <label class="form-label">Full Name</label>
                                <input type="text" id="fullName" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Position</label>
                                <input type="text" id="position" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div>
                                <label class="form-label">Department</label>
                                <input type="text" id="department" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Contact Number</label>
                                <input type="tel" id="contact" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div>
                                <label class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Employee ID</label>
                                <input type="text" id="employeeId" class="form-control">
                            </div>
                        </div>

                        <div class="form-row full">
                            <div>
                                <label class="form-label">Address</label>
                                <textarea id="address" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                <i class="fas fa-save"></i> Save Personnel
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Personnel Management Script -->
    <script>
        // Hardcoded credentials for demo (in production, use proper authentication)
        const VALID_CREDENTIALS = {
            username: 'admin',
            password: 'password'
        };

        // Check if user is logged in on page load
        window.addEventListener('DOMContentLoaded', function() {
            const currentUser = localStorage.getItem('currentUser');
            if (currentUser) {
                loginUser(currentUser);
            }
        });

        // Login form submission
        document.getElementById('loginFormSubmit').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('loginUsername').value;
            const password = document.getElementById('loginPassword').value;
            const errorDiv = document.getElementById('loginError');
            
            if (username === VALID_CREDENTIALS.username && password === VALID_CREDENTIALS.password) {
                errorDiv.style.display = 'none';
                localStorage.setItem('currentUser', username);
                loginUser(username);
            } else {
                errorDiv.textContent = 'Invalid username or password. Try admin/password';
                errorDiv.style.display = 'block';
            }
        });

        // Login user function
        function loginUser(username) {
            document.getElementById('loginPage').classList.remove('active');
            document.getElementById('mainContent').classList.add('active');
            document.getElementById('userNameDisplay').textContent = username;
            
            // Initialize personnel data
            initializePersonnelData();
        }

        // Logout function
        document.getElementById('logoutBtn').addEventListener('click', function() {
            localStorage.removeItem('currentUser');
            document.getElementById('loginPage').classList.add('active');
            document.getElementById('mainContent').classList.remove('active');
            document.getElementById('loginFormSubmit').reset();
            document.getElementById('loginError').style.display = 'none';
        });

        // Initialize Personnel Management
        function initializePersonnelData() {
            let personnel = JSON.parse(localStorage.getItem('personnel')) || [];
            const addModal = new bootstrap.Modal(document.getElementById('addPersonnelModal'));

            // Load personnel on page load
            displayPersonnel();
            populateDepartmentFilter();
            updateStats();

            // Form submission
            document.getElementById('personnelForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const id = document.getElementById('editingId').value;
                const newRecord = {
                    id: id || Date.now(),
                    fullName: document.getElementById('fullName').value,
                    position: document.getElementById('position').value,
                    department: document.getElementById('department').value,
                    contact: document.getElementById('contact').value,
                    email: document.getElementById('email').value,
                    address: document.getElementById('address').value,
                    employeeId: document.getElementById('employeeId').value,
                    dateAdded: id ? (personnel.find(p => p.id == id)?.dateAdded || new Date().toLocaleDateString()) : new Date().toLocaleDateString()
                };

                if (id) {
                    personnel = personnel.map(p => p.id == id ? newRecord : p);
                } else {
                    personnel.push(newRecord);
                }

                localStorage.setItem('personnel', JSON.stringify(personnel));
                displayPersonnel();
                populateDepartmentFilter();
                updateStats();
                addModal.hide();
                this.reset();
                document.getElementById('editingId').value = '';
            });

            // Display personnel
            function displayPersonnel() {
                const table = document.getElementById('personnelTable');
                const empty = document.getElementById('emptyState');
                
                if (personnel.length === 0) {
                    table.innerHTML = '<tr id="emptyState"><td colspan="8" class="empty-state"><div><i class="fas fa-inbox"></i><p>No personnel records found. Click "Add New Personnel" to get started.</p></div></td></tr>';
                    return;
                }

                let html = '';
                personnel.forEach((person, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${person.fullName}</strong></td>
                            <td>${person.position}</td>
                            <td><span class="badge-department">${person.department}</span></td>
                            <td>${person.contact}</td>
                            <td><a href="mailto:${person.email}">${person.email}</a></td>
                            <td><small>${person.address}</small></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editPersonnel(${person.id})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deletePersonnel(${person.id})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                table.innerHTML = html;
            }

            // Edit personnel
            window.editPersonnel = function(id) {
                const person = personnel.find(p => p.id == id);
                if (!person) return;

                document.getElementById('editingId').value = id;
                document.getElementById('fullName').value = person.fullName;
                document.getElementById('position').value = person.position;
                document.getElementById('department').value = person.department;
                document.getElementById('contact').value = person.contact;
                document.getElementById('email').value = person.email;
                document.getElementById('address').value = person.address;
                document.getElementById('employeeId').value = person.employeeId || '';
                
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-edit"></i> Edit Personnel';
                addModal.show();
            };

            // Delete personnel
            window.deletePersonnel = function(id) {
                if (confirm('Are you sure you want to delete this personnel record?')) {
                    personnel = personnel.filter(p => p.id !== id);
                    localStorage.setItem('personnel', JSON.stringify(personnel));
                    displayPersonnel();
                    populateDepartmentFilter();
                    updateStats();
                }
            };

            // Reset form for adding new
            document.getElementById('addPersonnelModal').addEventListener('show.bs.modal', function() {
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-plus"></i> Add New Personnel';
                document.getElementById('editingId').value = '';
                document.getElementById('personnelForm').reset();
            });

            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const filtered = personnel.filter(person => 
                    person.fullName.toLowerCase().includes(query) ||
                    person.email.toLowerCase().includes(query) ||
                    person.contact.includes(query) ||
                    person.department.toLowerCase().includes(query) ||
                    person.position.toLowerCase().includes(query)
                );

                displayFilteredPersonnel(filtered);
                updateSearchCount(filtered.length);
            });

            // Department filter
            document.getElementById('departmentFilter').addEventListener('change', function() {
                const dept = this.value;
                const filtered = dept ? personnel.filter(p => p.department === dept) : personnel;
                displayFilteredPersonnel(filtered);
            });

            // Display filtered personnel
            function displayFilteredPersonnel(filtered) {
                const table = document.getElementById('personnelTable');
                
                if (filtered.length === 0) {
                    table.innerHTML = '<tr><td colspan="8" class="text-center text-muted py-4"><i class="fas fa-search"></i> No records found</td></tr>';
                    return;
                }

                let html = '';
                filtered.forEach((person, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${person.fullName}</strong></td>
                            <td>${person.position}</td>
                            <td><span class="badge-department">${person.department}</span></td>
                            <td>${person.contact}</td>
                            <td><a href="mailto:${person.email}">${person.email}</a></td>
                            <td><small>${person.address}</small></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editPersonnel(${person.id})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deletePersonnel(${person.id})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                table.innerHTML = html;
            }

            // Populate department filter
            function populateDepartmentFilter() {
                const departments = [...new Set(personnel.map(p => p.department))].sort();
                const select = document.getElementById('departmentFilter');
                const currentValue = select.value;
                
                select.innerHTML = '<option value="">All Departments</option>';
                departments.forEach(dept => {
                    const option = document.createElement('option');
                    option.value = dept;
                    option.textContent = dept;
                    select.appendChild(option);
                });
                
                select.value = currentValue;
            }

            // Update statistics
            function updateStats() {
                document.getElementById('totalCount').textContent = personnel.length;
                const uniqueDepts = new Set(personnel.map(p => p.department)).size;
                document.getElementById('departmentCount').textContent = uniqueDepts;
                document.getElementById('searchCount').textContent = personnel.length;
            }

            // Update search count
            function updateSearchCount(count) {
                document.getElementById('searchCount').textContent = count;
            }
        }
    </script>

</body>
</html>