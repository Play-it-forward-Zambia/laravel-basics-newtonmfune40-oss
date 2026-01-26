<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personnel Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/personnel.css') }}" rel="stylesheet">

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
    <script src="{{ asset('js/personnel.js') }}"></script>

</body>
</html>
