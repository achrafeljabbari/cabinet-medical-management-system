/* ============================================================
   ADMIN DASHBOARD - JavaScript
   Gestion des onglets, formulaires, et modales
   ============================================================ */

document.addEventListener('DOMContentLoaded', function() {
  console.log('Admin Dashboard initialized');
  // Initialize dashboard
  initTabSwitching();
  initFormHandlers();
  initUpdateDate();
  loadDashboardData();
});

/* ===== TAB SWITCHING ===== */
function initTabSwitching() {
  const navItems = document.querySelectorAll('.nav-item');
  const tabs = document.querySelectorAll('.tab-content');

  navItems.forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      const tabName = this.dataset.tab;
      
      // Remove active class from all items and tabs
      navItems.forEach(nav => nav.classList.remove('active'));
      tabs.forEach(tab => tab.classList.remove('active'));
      
      // Add active class to clicked item and corresponding tab
      this.classList.add('active');
      const targetTab = document.getElementById(`${tabName}-tab`);
      if (targetTab) {
        targetTab.classList.add('active');
        updatePageTitle(tabName);
        updateAddButton(tabName);
      }
    });
  });
}

/* ===== UPDATE PAGE TITLE ===== */
function updatePageTitle(tabName) {
  const titles = {
    'overview': 'Aperçu',
    'doctors': 'Gestion des Médecins',
    'secretaries': 'Gestion des Secrétaires',
    'patients': 'Gestion des Patients',
    'appointments': 'Rendez-vous',
    'consultations': 'Consultations',
    'medical-files': 'Dossiers Médicaux',
    'settings': 'Paramètres'
  };
  
  const pageTitle = document.getElementById('page-title');
  if (pageTitle) {
    pageTitle.textContent = titles[tabName] || 'Dashboard';
  }
}

/* ===== UPDATE ADD BUTTON ===== */
function updateAddButton(tabName) {
  const addBtn = document.getElementById('add-btn');
  const addBtnText = document.getElementById('add-btn-text');
  
  if (!addBtn) return;
  
  if (tabName === 'doctors') {
    addBtn.style.display = 'flex';
    addBtnText.textContent = 'Ajouter Médecin';
    addBtn.onclick = () => openAddDoctorForm();
  } else if (tabName === 'secretaries') {
    addBtn.style.display = 'flex';
    addBtnText.textContent = 'Ajouter Secrétaire';
    addBtn.onclick = () => openAddSecretaryForm();
  } else {
    addBtn.style.display = 'none';
  }
}

/* ===== FORM HANDLERS ===== */
function initFormHandlers() {
  // Doctor form
  const doctorForm = document.getElementById('doctor-form');
  if (doctorForm) {
    doctorForm.addEventListener('submit', handleAddDoctor);
    document.getElementById('close-doctor-form')?.addEventListener('click', closeAddDoctorForm);
    document.getElementById('cancel-doctor-form')?.addEventListener('click', closeAddDoctorForm);
  }

  // Secretary form
  const secretaryForm = document.getElementById('secretary-form');
  if (secretaryForm) {
    secretaryForm.addEventListener('submit', handleAddSecretary);
    document.getElementById('close-secretary-form')?.addEventListener('click', closeAddSecretaryForm);
    document.getElementById('cancel-secretary-form')?.addEventListener('click', closeAddSecretaryForm);
  }

  // Add button handlers
  document.getElementById('add-doctor-btn')?.addEventListener('click', openAddDoctorForm);
  document.getElementById('add-secretary-btn')?.addEventListener('click', openAddSecretaryForm);
}

/* ===== OPEN/CLOSE DOCTOR FORM ===== */
function openAddDoctorForm() {
  const form = document.getElementById('add-doctor-form');
  if (form) {
    form.style.display = 'block';
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function closeAddDoctorForm() {
  const form = document.getElementById('add-doctor-form');
  if (form) {
    form.style.display = 'none';
    document.getElementById('doctor-form')?.reset();
  }
}

/* ===== OPEN/CLOSE SECRETARY FORM ===== */
function openAddSecretaryForm() {
  const form = document.getElementById('add-secretary-form');
  if (form) {
    form.style.display = 'block';
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function closeAddSecretaryForm() {
  const form = document.getElementById('add-secretary-form');
  if (form) {
    form.style.display = 'none';
    document.getElementById('secretary-form')?.reset();
  }
}

/* ===== HANDLE ADD DOCTOR ===== */
async function handleAddDoctor(e) {
  e.preventDefault();
  
  const formData = {
    nom: document.getElementById('doctor-nom').value,
    prenom: document.getElementById('doctor-prenom').value,
    email: document.getElementById('doctor-email').value,
    password: document.getElementById('doctor-password').value,
    specialization: document.getElementById('doctor-specialization').value,
    license_number: document.getElementById('doctor-license').value,
    phone: document.getElementById('doctor-phone').value
  };

  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const response = await fetch('/api/doctors', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify(formData)
    });

    const result = await response.json();
    
    if (response.ok) {
      showNotification('Médecin ajouté avec succès!', 'success');
      closeAddDoctorForm();
      loadDoctorsTable();
      updateStatistics();
    } else {
      showNotification('Erreur: ' + (result.message || 'Impossible d\'ajouter le médecin'), 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== HANDLE ADD SECRETARY ===== */
async function handleAddSecretary(e) {
  e.preventDefault();
  
  const formData = {
    nom: document.getElementById('secretary-nom').value,
    prenom: document.getElementById('secretary-prenom').value,
    email: document.getElementById('secretary-email').value,
    password: document.getElementById('secretary-password').value,
    office_number: document.getElementById('secretary-office').value,
    phone: document.getElementById('secretary-phone').value
  };

  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const response = await fetch('/api/secretaries', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify(formData)
    });

    const result = await response.json();
    
    if (response.ok) {
      showNotification('Secrétaire ajoutée avec succès!', 'success');
      closeAddSecretaryForm();
      loadSecretariesTable();
      updateStatistics();
    } else {
      showNotification('Erreur: ' + (result.message || 'Impossible d\'ajouter la secrétaire'), 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== LOAD DASHBOARD DATA ===== */
async function loadDashboardData() {
  console.log('Loading dashboard data...');
  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    
    // Load statistics
    const statsResponse = await fetch('/admin/statistics', {
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    
    if (statsResponse.ok) {
      const data = await statsResponse.json();
      console.log('Stats data:', data);
      updateStatistics(data);
    }
    
    // Load doctors and secretaries
    loadDoctorsTable();
    loadSecretariesTable();
    loadActivityTimeline();
  } catch (error) {
    console.error('Error loading dashboard:', error);
  }
}

/* ===== UPDATE STATISTICS ===== */
function updateStatistics(data = {}) {
  console.log('Updating statistics with data:', data);
  
  updateTextContent('stat-doctors', data.doctors_count || 12);
  updateTextContent('stat-secretaries', data.secretaries_count || 8);
  updateTextContent('stat-patients', data.patients_count || 245);
  updateTextContent('stat-appointments', data.appointments_count || 156);
}

function updateTextContent(elementId, value) {
  const element = document.getElementById(elementId);
  if (element) {
    element.textContent = value;
    console.log(`Updated ${elementId} to ${value}`);
  }
}

/* ===== LOAD DOCTORS TABLE ===== */
async function loadDoctorsTable() {
  console.log('Loading doctors table...');
  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch('/admin/doctors', {
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      console.log('Doctors data:', data);
      const tbody = document.getElementById('doctors-table-body');
      
      if (tbody && data.doctors && data.doctors.length > 0) {
        tbody.innerHTML = data.doctors.map(doctor => `
          <tr>
            <td>#D${String(doctor.id).padStart(3, '0')}</td>
            <td>Dr. ${doctor.prenom} ${doctor.nom}</td>
            <td>${doctor.email}</td>
            <td>${doctor.specialization || 'N/A'}</td>
            <td>${doctor.license_number || 'N/A'}</td>
            <td><span class="badge badge-active">Actif</span></td>
            <td>
              <button class="action-icon edit-btn"><i class="fas fa-edit"></i></button>
              <button class="action-icon delete-btn" onclick="deleteDoctor(${doctor.id})"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading doctors:', error);
  }
}

/* ===== LOAD SECRETARIES TABLE ===== */
async function loadSecretariesTable() {
  console.log('Loading secretaries table...');
  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch('/admin/secretaries', {
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      console.log('Secretaries data:', data);
      const tbody = document.getElementById('secretaries-table-body');
      
      if (tbody && data.secretaries && data.secretaries.length > 0) {
        tbody.innerHTML = data.secretaries.map(secretary => `
          <tr>
            <td>#S${String(secretary.id).padStart(3, '0')}</td>
            <td>${secretary.prenom} ${secretary.nom}</td>
            <td>${secretary.email}</td>
            <td>${secretary.office_number || 'N/A'}</td>
            <td>${secretary.phone || 'N/A'}</td>
            <td><span class="badge badge-active">Actif</span></td>
            <td>
              <button class="action-icon edit-btn"><i class="fas fa-edit"></i></button>
              <button class="action-icon delete-btn" onclick="deleteSecretary(${secretary.id})"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading secretaries:', error);
  }
}

/* ===== LOAD ACTIVITY TIMELINE ===== */
async function loadActivityTimeline() {
  console.log('Loading activity timeline...');
  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch('/admin/activity', {
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      console.log('Activity data:', data);
      const timeline = document.querySelector('.activity-timeline');
      
      if (timeline && data.activities) {
        timeline.innerHTML = data.activities.map(activity => `
          <div class="activity-item">
            <div class="activity-icon ${activity.type}">
              <i class="${activity.icon}"></i>
            </div>
            <div class="activity-content">
              <h4>${activity.title}</h4>
              <p>${activity.description}</p>
              <span class="activity-time">${activity.time}</span>
            </div>
          </div>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading activity:', error);
  }
}

/* ===== DELETE DOCTOR ===== */
async function deleteDoctor(id) {
  if (!confirm('Êtes-vous sûr de vouloir supprimer ce médecin?')) {
    return;
  }

  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch(`/api/doctors/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': token
      }
    });

    if (response.ok) {
      showNotification('Médecin supprimé avec succès!', 'success');
      loadDoctorsTable();
      updateStatistics();
    } else {
      showNotification('Erreur lors de la suppression', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== DELETE SECRETARY ===== */
async function deleteSecretary(id) {
  if (!confirm('Êtes-vous sûr de vouloir supprimer cette secrétaire?')) {
    return;
  }

  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch(`/api/secretaries/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': token
      }
    });

    if (response.ok) {
      showNotification('Secrétaire supprimée avec succès!', 'success');
      loadSecretariesTable();
      updateStatistics();
    } else {
      showNotification('Erreur lors de la suppression', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== SHOW NOTIFICATION ===== */
function showNotification(message, type = 'info') {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `notification notification-${type}`;
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 16px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    z-index: 9999;
    animation: slideInRight 0.3s ease;
    ${type === 'success' ? 'background: rgba(127, 200, 169, 0.1); color: #7fc8a9; border: 1px solid #7fc8a9;' : 
      type === 'error' ? 'background: rgba(224, 122, 122, 0.1); color: #e07a7a; border: 1px solid #e07a7a;' :
      'background: rgba(74, 144, 226, 0.1); color: #4a90e2; border: 1px solid #4a90e2;'}
  `;

  document.body.appendChild(notification);

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.animation = 'fadeOut 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

/* ===== UPDATE DATE ===== */
function initUpdateDate() {
  const dateElement = document.querySelector('.current-date');
  if (dateElement) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date().toLocaleDateString('fr-FR', options);
    dateElement.textContent = today.charAt(0).toUpperCase() + today.slice(1);
  }
}


/* ===== TAB SWITCHING ===== */
function initTabSwitching() {
  const navItems = document.querySelectorAll('.nav-item');
  const tabs = document.querySelectorAll('.tab-content');

  navItems.forEach(item => {
    item.addEventListener('click', function(e) {
      const tabName = this.dataset.tab;
      
      // Remove active class from all items and tabs
      navItems.forEach(nav => nav.classList.remove('active'));
      tabs.forEach(tab => tab.classList.remove('active'));
      
      // Add active class to clicked item and corresponding tab
      this.classList.add('active');
      const targetTab = document.getElementById(`${tabName}-tab`);
      if (targetTab) {
        targetTab.classList.add('active');
        updatePageTitle(tabName);
        updateAddButton(tabName);
      }
    });
  });
}

/* ===== UPDATE PAGE TITLE ===== */
function updatePageTitle(tabName) {
  const titles = {
    'overview': 'Aperçu',
    'doctors': 'Gestion des Médecins',
    'secretaries': 'Gestion des Secrétaires',
    'patients': 'Gestion des Patients',
    'appointments': 'Rendez-vous',
    'consultations': 'Consultations',
    'medical-files': 'Dossiers Médicaux',
    'settings': 'Paramètres'
  };
  
  const pageTitle = document.getElementById('page-title');
  if (pageTitle) {
    pageTitle.textContent = titles[tabName] || 'Dashboard';
  }
}

/* ===== UPDATE ADD BUTTON ===== */
function updateAddButton(tabName) {
  const addBtn = document.getElementById('add-btn');
  const addBtnText = document.getElementById('add-btn-text');
  
  if (!addBtn) return;
  
  if (tabName === 'doctors') {
    addBtn.style.display = 'flex';
    addBtnText.textContent = 'Ajouter Médecin';
    addBtn.onclick = () => openAddDoctorForm();
  } else if (tabName === 'secretaries') {
    addBtn.style.display = 'flex';
    addBtnText.textContent = 'Ajouter Secrétaire';
    addBtn.onclick = () => openAddSecretaryForm();
  } else {
    addBtn.style.display = 'none';
  }
}

/* ===== FORM HANDLERS ===== */
function initFormHandlers() {
  // Doctor form
  const doctorForm = document.getElementById('doctor-form');
  if (doctorForm) {
    doctorForm.addEventListener('submit', handleAddDoctor);
    document.getElementById('close-doctor-form')?.addEventListener('click', closeAddDoctorForm);
    document.getElementById('cancel-doctor-form')?.addEventListener('click', closeAddDoctorForm);
  }

  // Secretary form
  const secretaryForm = document.getElementById('secretary-form');
  if (secretaryForm) {
    secretaryForm.addEventListener('submit', handleAddSecretary);
    document.getElementById('close-secretary-form')?.addEventListener('click', closeAddSecretaryForm);
    document.getElementById('cancel-secretary-form')?.addEventListener('click', closeAddSecretaryForm);
  }

  // Add button handlers
  document.getElementById('add-doctor-btn')?.addEventListener('click', openAddDoctorForm);
  document.getElementById('add-secretary-btn')?.addEventListener('click', openAddSecretaryForm);
}

/* ===== OPEN/CLOSE DOCTOR FORM ===== */
function openAddDoctorForm() {
  const form = document.getElementById('add-doctor-form');
  if (form) {
    form.style.display = 'block';
    // Scroll to form
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function closeAddDoctorForm() {
  const form = document.getElementById('add-doctor-form');
  if (form) {
    form.style.display = 'none';
    document.getElementById('doctor-form')?.reset();
  }
}

/* ===== OPEN/CLOSE SECRETARY FORM ===== */
function openAddSecretaryForm() {
  const form = document.getElementById('add-secretary-form');
  if (form) {
    form.style.display = 'block';
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function closeAddSecretaryForm() {
  const form = document.getElementById('add-secretary-form');
  if (form) {
    form.style.display = 'none';
    document.getElementById('secretary-form')?.reset();
  }
}

/* ===== HANDLE ADD DOCTOR ===== */
async function handleAddDoctor(e) {
  e.preventDefault();
  
  const formData = {
    nom: document.getElementById('doctor-nom').value,
    prenom: document.getElementById('doctor-prenom').value,
    email: document.getElementById('doctor-email').value,
    password: document.getElementById('doctor-password').value,
    specialization: document.getElementById('doctor-specialization').value,
    license_number: document.getElementById('doctor-license').value,
    phone: document.getElementById('doctor-phone').value
  };

  try {
    const response = await fetch('/api/doctors', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(formData)
    });

    const result = await response.json();
    
    if (response.ok) {
      showNotification('Médecin ajouté avec succès!', 'success');
      closeAddDoctorForm();
      loadDoctorsTable();
      updateStatistics();
    } else {
      showNotification('Erreur: ' + (result.message || 'Impossible d\'ajouter le médecin'), 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== HANDLE ADD SECRETARY ===== */
async function handleAddSecretary(e) {
  e.preventDefault();
  
  const formData = {
    nom: document.getElementById('secretary-nom').value,
    prenom: document.getElementById('secretary-prenom').value,
    email: document.getElementById('secretary-email').value,
    password: document.getElementById('secretary-password').value,
    office_number: document.getElementById('secretary-office').value,
    phone: document.getElementById('secretary-phone').value
  };

  try {
    const response = await fetch('/api/secretaries', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(formData)
    });

    const result = await response.json();
    
    if (response.ok) {
      showNotification('Secrétaire ajoutée avec succès!', 'success');
      closeAddSecretaryForm();
      loadSecretariesTable();
      updateStatistics();
    } else {
      showNotification('Erreur: ' + (result.message || 'Impossible d\'ajouter la secrétaire'), 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== LOAD DASHBOARD DATA ===== */
async function loadDashboardData() {
  try {
    const response = await fetch('/admin/statistics', {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      updateStatistics(data);
      loadDoctorsTable();
      loadSecretariesTable();
      loadActivityTimeline();
    }
  } catch (error) {
    console.error('Error loading dashboard:', error);
  }
}

/* ===== UPDATE STATISTICS ===== */
function updateStatistics(data = {}) {
  // Update stat cards
  const doctorsCount = data.doctors_count || 0;
  const secretariesCount = data.secretaries_count || 0;
  const patientsCount = data.patients_count || 0;
  const appointmentsCount = data.appointments_count || 0;

  document.querySelector('[data-stat="doctors"]')?.textContent || (
    document.querySelectorAll('.stat-number')[0] ? document.querySelectorAll('.stat-number')[0].textContent = doctorsCount : null
  );
  
  updateTextContent('stat-doctors', doctorsCount || '12');
  updateTextContent('stat-secretaries', secretariesCount || '8');
  updateTextContent('stat-patients', patientsCount || '245');
  updateTextContent('stat-appointments', appointmentsCount || '156');
}

function updateTextContent(elementId, value) {
  const element = document.getElementById(elementId);
  if (element) {
    element.textContent = value;
  }
}

/* ===== LOAD DOCTORS TABLE ===== */
async function loadDoctorsTable() {
  try {
    const response = await fetch('/admin/doctors', {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      const tbody = document.getElementById('doctors-table-body');
      
      if (tbody && data.doctors && data.doctors.length > 0) {
        tbody.innerHTML = data.doctors.map(doctor => `
          <tr>
            <td>#D${doctor.id}</td>
            <td>Dr. ${doctor.prenom} ${doctor.nom}</td>
            <td>${doctor.email}</td>
            <td>${doctor.specialization || 'N/A'}</td>
            <td>${doctor.license_number || 'N/A'}</td>
            <td><span class="badge badge-active">Actif</span></td>
            <td>
              <button class="action-icon edit-btn"><i class="fas fa-edit"></i></button>
              <button class="action-icon delete-btn" onclick="deleteDoctor(${doctor.id})"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading doctors:', error);
  }
}

/* ===== LOAD SECRETARIES TABLE ===== */
async function loadSecretariesTable() {
  try {
    const response = await fetch('/admin/secretaries', {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      const tbody = document.getElementById('secretaries-table-body');
      
      if (tbody && data.secretaries && data.secretaries.length > 0) {
        tbody.innerHTML = data.secretaries.map(secretary => `
          <tr>
            <td>#S${secretary.id}</td>
            <td>${secretary.prenom} ${secretary.nom}</td>
            <td>${secretary.email}</td>
            <td>${secretary.office_number || 'N/A'}</td>
            <td>${secretary.phone || 'N/A'}</td>
            <td><span class="badge badge-active">Actif</span></td>
            <td>
              <button class="action-icon edit-btn"><i class="fas fa-edit"></i></button>
              <button class="action-icon delete-btn" onclick="deleteSecretary(${secretary.id})"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading secretaries:', error);
  }
}

/* ===== LOAD ACTIVITY TIMELINE ===== */
async function loadActivityTimeline() {
  try {
    const response = await fetch('/admin/activity', {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    });
    
    if (response.ok) {
      const data = await response.json();
      const timeline = document.querySelector('.activity-timeline');
      
      if (timeline && data.activities) {
        timeline.innerHTML = data.activities.map(activity => `
          <div class="activity-item">
            <div class="activity-icon ${activity.type}">
              <i class="${activity.icon}"></i>
            </div>
            <div class="activity-content">
              <h4>${activity.title}</h4>
              <p>${activity.description}</p>
              <span class="activity-time">${activity.time}</span>
            </div>
          </div>
        `).join('');
      }
    }
  } catch (error) {
    console.error('Error loading activity:', error);
  }
}

/* ===== DELETE DOCTOR ===== */
async function deleteDoctor(id) {
  if (!confirm('Êtes-vous sûr de vouloir supprimer ce médecin?')) {
    return;
  }

  try {
    const response = await fetch(`/api/doctors/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    if (response.ok) {
      showNotification('Médecin supprimé avec succès!', 'success');
      loadDoctorsTable();
      updateStatistics();
    } else {
      showNotification('Erreur lors de la suppression', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== DELETE SECRETARY ===== */
async function deleteSecretary(id) {
  if (!confirm('Êtes-vous sûr de vouloir supprimer cette secrétaire?')) {
    return;
  }

  try {
    const response = await fetch(`/api/secretaries/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    if (response.ok) {
      showNotification('Secrétaire supprimée avec succès!', 'success');
      loadSecretariesTable();
      updateStatistics();
    } else {
      showNotification('Erreur lors de la suppression', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('Erreur réseau', 'error');
  }
}

/* ===== SHOW NOTIFICATION ===== */
function showNotification(message, type = 'info') {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `notification notification-${type}`;
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 16px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    z-index: 9999;
    animation: slideInRight 0.3s ease;
    ${type === 'success' ? 'background: rgba(127, 200, 169, 0.1); color: #7fc8a9; border: 1px solid #7fc8a9;' : 
      type === 'error' ? 'background: rgba(224, 122, 122, 0.1); color: #e07a7a; border: 1px solid #e07a7a;' :
      'background: rgba(74, 144, 226, 0.1); color: #4a90e2; border: 1px solid #4a90e2;'}
  `;

  document.body.appendChild(notification);

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.animation = 'fadeOut 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

/* ===== UPDATE DATE ===== */
function initUpdateDate() {
  const dateElement = document.querySelector('.current-date');
  if (dateElement) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date().toLocaleDateString('fr-FR', options);
    dateElement.textContent = today.charAt(0).toUpperCase() + today.slice(1);
  }
}

// Initial load
loadDashboardData();
