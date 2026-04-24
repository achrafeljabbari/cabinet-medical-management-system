<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Medecin | Medicare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/doctor-dashboard.css') }}">
</head>
<body class="doctor-dashboard-page">
    <div class="app-container">
        <button class="hamburger-btn" id="hamburger-btn" type="button" aria-label="Ouvrir la navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="overlay" id="overlay"></div>

        <div class="notification" id="notification">
            <i class="fas fa-circle-check"></i>
            <span id="notification-text">Dashboard charge.</span>
        </div>

        <div class="doctor-view">
            <aside class="sidebar" id="sidebar">
                <div class="logo">
                    <i class="fas fa-heartbeat"></i>
                    <span>Medicare</span>
                </div>

                <nav class="nav-menu" aria-label="Navigation principale">
                    <button class="nav-item active" data-view="dashboard" type="button">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </button>
                    <button class="nav-item" data-view="schedule" type="button">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schedule</span>
                    </button>
                    <button class="nav-item" data-view="patients" type="button">
                        <i class="fas fa-users"></i>
                        <span>Patients</span>
                    </button>
                    <button class="nav-item" data-view="consultations" type="button">
                        <i class="fas fa-stethoscope"></i>
                        <span>Consultations</span>
                    </button>
                    <button class="nav-item" data-view="records" type="button">
                        <i class="fas fa-file-medical"></i>
                        <span>Dossiers medicaux</span>
                    </button>
                    <button class="nav-item" data-view="contacts" type="button">
                        <i class="fas fa-address-book"></i>
                        <span>Contacts</span>
                    </button>
                    <button class="nav-item" data-view="about" type="button">
                        <i class="fas fa-circle-info"></i>
                        <span>About</span>
                    </button>
                </nav>

                <div class="doctor-profile">
                    <div class="doctor-avatar">DW</div>
                    <div class="doctor-info">
                        <h3>Dr. Dean Walsh</h3>
                        <p>Cardiologist</p>
                    </div>
                </div>
            </aside>

            <main class="main-content">
                <header class="header">
                    <div class="date-info">
                        <h1 id="view-title">Dashboard</h1>
                        <p id="current-date">Chargement de la date...</p>
                    </div>

                    <div class="header-actions">
                        <button class="btn btn-primary" id="next-patient-btn" type="button">
                            <i class="fas fa-user-clock"></i>
                            <span>Next Patient</span>
                        </button>
                        <button class="btn btn-secondary" id="print-report-btn" type="button">
                            <i class="fas fa-print"></i>
                            <span>Print Report</span>
                        </button>
                        <button class="btn btn-success" id="print-ordonnance-btn" type="button">
                            <i class="fas fa-prescription-bottle-medical"></i>
                            <span>Print Ordonnance</span>
                        </button>
                    </div>
                </header>

                <section class="view-container active" id="dashboard-view">
                    <div class="dashboard-grid">
                        <div class="left-column">
                            <article class="current-patient-card">
                                <div class="card-header">
                                    <h2>Current Consultation</h2>
                                    <div class="live-badge">LIVE</div>
                                </div>

                                <div class="patient-info">
                                    <div class="patient-avatar" id="current-patient-avatar">NA</div>
                                    <div class="patient-details">
                                        <h3 id="current-patient-name">Patient</h3>
                                        <p>
                                            <i class="fas fa-id-card"></i>
                                            <span>Numero de tour : <strong id="current-patient-turn">-</strong></span>
                                        </p>
                                        <p>
                                            <i class="fas fa-cake-candles"></i>
                                            <span id="current-patient-age">-</span>
                                        </p>
                                        <p>
                                            <i class="fas fa-heart-pulse"></i>
                                            <span id="current-patient-condition">-</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="patient-navigation">
                                    <button class="nav-btn" id="prev-patient-btn" type="button">
                                        <i class="fas fa-chevron-left"></i>
                                        Previous
                                    </button>

                                    <div class="current-turn">
                                        <span>Current Turn</span>
                                        <h4 id="current-turn-display">-</h4>
                                    </div>

                                    <button class="nav-btn" id="next-patient-inline-btn" type="button">
                                        Next
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>

                                <form class="medical-notes" id="medical-notes-form">
                                    <h4><i class="fas fa-file-medical-alt"></i> Medical Notes</h4>

                                    <div class="input-group">
                                        <label for="diagnosis"><i class="fas fa-stethoscope"></i> Diagnostic</label>
                                        <input type="text" id="diagnosis" name="diagnosis">
                                    </div>

                                    <div class="input-group">
                                        <label for="symptoms"><i class="fas fa-notes-medical"></i> Symptomes</label>
                                        <input type="text" id="symptoms" name="symptoms">
                                    </div>

                                    <div class="input-group">
                                        <label for="treatment"><i class="fas fa-syringe"></i> Plan de traitement</label>
                                        <textarea id="treatment" name="treatment"></textarea>
                                    </div>

                                    <div class="input-group">
                                        <label for="next-visit"><i class="fas fa-calendar-check"></i> Prochaine visite</label>
                                        <input type="date" id="next-visit" name="nextVisit">
                                    </div>

                                    <div class="action-buttons">
                                        <button class="btn btn-primary" id="save-notes-btn" type="submit">
                                            <i class="fas fa-save"></i>
                                            Save Notes
                                        </button>
                                        <button class="btn btn-success" id="complete-visit-btn" type="button">
                                            <i class="fas fa-check-circle"></i>
                                            Complete Visit
                                        </button>
                                        <button class="btn btn-warning" id="reschedule-btn" type="button">
                                            <i class="fas fa-clock"></i>
                                            Reschedule
                                        </button>
                                    </div>
                                </form>
                            </article>
                        </div>

                        <div class="right-column">
                            <article class="queue-card">
                                <div class="queue-header">
                                    <h3><i class="fas fa-list-ol"></i> Patient Queue</h3>
                                    <div class="queue-count" id="queue-count">0 waiting</div>
                                </div>

                                <div class="queue-list" id="patient-queue"></div>
                            </article>

                            <article class="stats-card">
                                <h3><i class="fas fa-chart-column"></i> Today's Statistics</h3>
                                <div class="stat-row">
                                    <span>Total Patients</span>
                                    <strong id="total-patients">0</strong>
                                </div>
                                <div class="stat-row">
                                    <span>Completed</span>
                                    <strong id="completed-patients">0</strong>
                                </div>
                                <div class="stat-row">
                                    <span>Waiting</span>
                                    <strong id="waiting-patients">0</strong>
                                </div>
                                <div class="stat-row">
                                    <span>Average Time</span>
                                    <strong id="avg-time">0 min</strong>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" id="progress-fill"></div>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="view-container" id="schedule-view">
                    <div class="calendar-view">
                        <div class="calendar-header">
                            <h2>Schedule &amp; Appointments</h2>
                            <button class="btn btn-primary" id="add-appointment-btn" type="button">
                                <i class="fas fa-plus"></i>
                                Add Appointment
                            </button>
                        </div>

                        <div class="calendar-grid">
                            <div class="calendar-main">
                                <div class="calendar-controls">
                                    <div class="month-nav">
                                        <button class="btn-icon" id="prev-month" type="button" aria-label="Mois precedent">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="btn-icon today-chip" id="today-btn" type="button">Today</button>
                                        <button class="btn-icon" id="next-month" type="button" aria-label="Mois suivant">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <h3 id="current-month">Mois</h3>
                                </div>

                                <div class="calendar-container">
                                    <div class="calendar-weekdays">
                                        <div>Dim</div>
                                        <div>Lun</div>
                                        <div>Mar</div>
                                        <div>Mer</div>
                                        <div>Jeu</div>
                                        <div>Ven</div>
                                        <div>Sam</div>
                                    </div>
                                    <div class="calendar-days" id="calendar-days"></div>
                                </div>
                            </div>

                            <div class="appointments-sidebar">
                                <div class="appointments-list">
                                    <h3>Today's Appointments</h3>
                                    <div id="today-appointments"></div>
                                </div>
                                <div class="appointments-list">
                                    <h3>Upcoming This Week</h3>
                                    <div id="upcoming-appointments"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="view-container" id="patients-view">
                    <div class="patients-view">
                        <div class="patients-header">
                            <h2>Patient Records</h2>
                            <button class="btn btn-primary" id="new-patient-btn" type="button">
                                <i class="fas fa-user-plus"></i>
                                New Patient
                            </button>
                        </div>

                        <div class="search-bar">
                            <input type="text" id="patient-search" placeholder="Search by name, ID or condition...">
                            <button class="btn btn-secondary" id="search-patient-btn" type="button">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                        </div>

                        <div class="patients-grid">
                            <div class="patients-list">
                                <h3>Patient List</h3>
                                <div id="patient-list"></div>
                            </div>

                            <div class="patient-history">
                                <h3>Medical History</h3>
                                <div class="history-list" id="patient-history-list"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="view-container" id="consultations-view">
                    <div class="patients-view">
                        <div class="patients-header">
                            <h2>Consultations</h2>
                            <button class="btn btn-primary" id="new-consultation-btn" type="button">
                                <i class="fas fa-plus-circle"></i>
                                Start Consultation
                            </button>
                        </div>

                        <div class="consultation-list" id="consultation-list"></div>
                    </div>
                </section>

                <section class="view-container" id="records-view">
                    <div class="patients-view">
                        <div class="patients-header">
                            <h2>Dossiers medicaux</h2>
                            <button class="btn btn-primary" id="export-records-btn" type="button">
                                <i class="fas fa-file-export"></i>
                                Export Records
                            </button>
                        </div>

                        <div class="record-grid" id="record-grid"></div>
                    </div>
                </section>

                <section class="view-container" id="contacts-view">
                    <div class="patients-view">
                        <div class="patients-header">
                            <h2>Contacts</h2>
                            <button class="btn btn-primary" id="new-contact-btn" type="button">
                                <i class="fas fa-phone-plus"></i>
                                Add Contact
                            </button>
                        </div>

                        <div class="contact-grid" id="contact-grid"></div>
                    </div>
                </section>

                <section class="view-container" id="about-view">
                    <div class="patients-view">
                        <div class="patients-header">
                            <h2>About</h2>
                            <button class="btn btn-secondary" id="about-action-btn" type="button">
                                <i class="fas fa-circle-question"></i>
                                View Guidelines
                            </button>
                        </div>

                        <div class="about-panel">
                            <div class="about-hero">
                                <span class="about-badge">Cabinet Medicare</span>
                                <h3>Un dashboard medecin concu pour la consultation, le suivi et la coordination.</h3>
                                <p>
                                    Cette interface respecte l'organisation attendue dans votre projet:
                                    sidebar fixe, header contextuel, vues modulaires et composants reutilisables
                                    pour la consultation, le planning et les dossiers.
                                </p>
                            </div>

                            <div class="about-columns">
                                <article class="about-card">
                                    <h4><i class="fas fa-layer-group"></i> Architecture</h4>
                                    <p>La page est divisee en vues internes pour faciliter le branchement futur au backend Laravel.</p>
                                </article>
                                <article class="about-card">
                                    <h4><i class="fas fa-palette"></i> Style</h4>
                                    <p>Les variables et classes principales de l'exemple ont ete conservees pour garder la meme signature visuelle.</p>
                                </article>
                                <article class="about-card">
                                    <h4><i class="fas fa-rocket"></i> Integration</h4>
                                    <p>Les donnees actuelles sont mockees et peuvent etre remplacees ensuite par vos controllers et modeles.</p>
                                </article>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        window.doctorDashboardInitialView = @json($initialView ?? 'dashboard');
    </script>
    <script src="{{ asset('js/doctor-dashboard.js') }}"></script>
</body>
</html>
