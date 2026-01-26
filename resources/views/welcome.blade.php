<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnel Management System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            padding: 1rem 0;
        }

        .navbar-custom .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .container-main {
            padding: 2rem 0;
        }

        .page-header {
            text-align: center;
            color: #fff;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.25);
        }

        .card-header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            border: none;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-danger {
            border-radius: 6px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
        }

        .btn-warning {
            border-radius: 6px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            border-radius: 6px;
            font-weight: 600;
            border: none;
            background-color: #6c757d;
        }

        .search-box {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            pointer-events: none;
        }

        .table {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .table thead th {
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #333;
        }

        .badge-department {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #999;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .modal-header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.95);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }

        .stat-card .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .table {
                font-size: 0.9rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>

</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="fas fa-users-cog"></i> Personnel Management System
            </span>
            <div class="ms-auto">
                <span class="text-white">Manage Staff & Personnel Records</span>
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
        // Initialize from localStorage
        let personnel = JSON.parse(localStorage.getItem('personnel')) || [];
        const addModal = new bootstrap.Modal(document.getElementById('addPersonnelModal'));

        // Load personnel on page load
        document.addEventListener('DOMContentLoaded', function() {
            displayPersonnel();
            populateDepartmentFilter();
            updateStats();
        });

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
        function editPersonnel(id) {
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
        }

        // Delete personnel
        function deletePersonnel(id) {
            if (confirm('Are you sure you want to delete this personnel record?')) {
                personnel = personnel.filter(p => p.id !== id);
                localStorage.setItem('personnel', JSON.stringify(personnel));
                displayPersonnel();
                populateDepartmentFilter();
                updateStats();
            }
        }

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
    </script>

</body>
</html>
