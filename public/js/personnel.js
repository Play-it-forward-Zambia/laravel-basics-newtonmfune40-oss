// Personnel Management System - JavaScript

// Initialize personnel array
let personnel = [];
let addModal;

// Load personnel on page load
document.addEventListener('DOMContentLoaded', function() {
    addModal = new bootstrap.Modal(document.getElementById('addPersonnelModal'));
    loadPersonnelFromDatabase();
    setupEventListeners();
});

// Load personnel from database
function loadPersonnelFromDatabase() {
    fetch('/api/personnel', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        personnel = data;
        displayPersonnel();
        populateDepartmentFilter();
        updateStats();
    })
    .catch(error => {
        console.error('Error loading personnel:', error);
    });
}

// Setup all event listeners
function setupEventListeners() {
    // Form submission
    document.getElementById('personnelForm').addEventListener('submit', handleFormSubmit);

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', handleSearch);

    // Department filter
    document.getElementById('departmentFilter').addEventListener('change', handleDepartmentFilter);

    // Modal reset
    document.getElementById('addPersonnelModal').addEventListener('show.bs.modal', resetModalForm);
}

// Handle form submission
function handleFormSubmit(e) {
    e.preventDefault();
    
    const id = document.getElementById('editingId').value;
    const formData = {
        fullName: document.getElementById('fullName').value,
        position: document.getElementById('position').value,
        department: document.getElementById('department').value,
        contact: document.getElementById('contact').value,
        email: document.getElementById('email').value,
        address: document.getElementById('address').value,
        employeeId: document.getElementById('employeeId').value,
    };

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    if (id) {
        // Update existing record
        fetch(`/personnel/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadPersonnelFromDatabase();
                addModal.hide();
                document.getElementById('personnelForm').reset();
                document.getElementById('editingId').value = '';
                showSuccessAlert('Personnel record updated successfully!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert('Error updating personnel record');
        });
    } else {
        // Create new record
        fetch('/personnel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadPersonnelFromDatabase();
                addModal.hide();
                document.getElementById('personnelForm').reset();
                showSuccessAlert('Personnel record saved successfully!');
            } else {
                showErrorAlert(data.message || 'Error saving personnel record');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert('Error saving personnel record');
        });
    }
}

// Display personnel
function displayPersonnel() {
    const table = document.getElementById('personnelTable');
    
    if (personnel.length === 0) {
        table.innerHTML = '<tr id="emptyState"><td colspan="8" class="empty-state"><div><i class="fas fa-inbox"></i><p>No personnel records found. Click "Add New Personnel" to get started.</p></div></td></tr>';
        return;
    }

    let html = '';
    personnel.forEach((person, index) => {
        html += `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${person.full_name}</strong></td>
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
    document.getElementById('fullName').value = person.full_name;
    document.getElementById('position').value = person.position;
    document.getElementById('department').value = person.department;
    document.getElementById('contact').value = person.contact;
    document.getElementById('email').value = person.email;
    document.getElementById('address').value = person.address;
    document.getElementById('employeeId').value = person.employee_id || '';
    
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-edit"></i> Edit Personnel';
    addModal.show();
}

// Delete personnel
function deletePersonnel(id) {
    if (confirm('Are you sure you want to delete this personnel record?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        fetch(`/personnel/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadPersonnelFromDatabase();
                showSuccessAlert('Personnel record deleted successfully!');
            } else {
                showErrorAlert(data.message || 'Error deleting personnel record');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert('Error deleting personnel record');
        });
    }
}

// Reset form for adding new
function resetModalForm() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-plus"></i> Add New Personnel';
    document.getElementById('editingId').value = '';
    document.getElementById('personnelForm').reset();
}

// Search functionality
function handleSearch(e) {
    const query = e.target.value.toLowerCase();
    const filtered = personnel.filter(person => 
        person.full_name.toLowerCase().includes(query) ||
        person.email.toLowerCase().includes(query) ||
        person.contact.includes(query) ||
        person.department.toLowerCase().includes(query) ||
        person.position.toLowerCase().includes(query)
    );

    displayFilteredPersonnel(filtered);
    updateSearchCount(filtered.length);
}

// Department filter
function handleDepartmentFilter(e) {
    const dept = e.target.value;
    const filtered = dept ? personnel.filter(p => p.department === dept) : personnel;
    displayFilteredPersonnel(filtered);
}

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
                <td><strong>${person.full_name}</strong></td>
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

// Show success alert
function showSuccessAlert(message) {
    // Create and show a simple alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show';
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '20px';
    alertDiv.style.right = '20px';
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

// Show error alert
function showErrorAlert(message) {
    // Create and show a simple alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '20px';
    alertDiv.style.right = '20px';
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}
