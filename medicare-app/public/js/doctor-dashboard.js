const dashboardData = {
    currentPatientIndex: 0,
    calendarDate: new Date(),
    patients: [
        {
            id: "PT-1042",
            name: "Nadia Rahimi",
            initials: "NR",
            age: 42,
            turn: "A-203",
            condition: "Suivi hypertension",
            specialty: "Cardiologie",
            arrival: "08:40",
            waitMinutes: 18,
            diagnosis: "Hypertension stade 1 stabilisee",
            symptoms: "Palpitations legeres, fatigue matinale",
            treatment: "Poursuite du traitement antihypertenseur, bilan lipidique et conseils nutritionnels.",
            nextVisit: "2026-05-05",
            history: [
                { date: "08 avr. 2026", diagnosis: "Controle tensionnel", doctor: "Dr. Dean Walsh", notes: "Tension plus stable, ajustement du dosage le soir." },
                { date: "12 fevr. 2026", diagnosis: "Bilan cardiovasculaire", doctor: "Dr. Dean Walsh", notes: "ECG rassurant. Activite physique recommandee." },
                { date: "18 nov. 2025", diagnosis: "Consultation initiale", doctor: "Dr. Sarah Kim", notes: "Mise en route du traitement et education therapeutique." }
            ]
        },
        {
            id: "PT-0876",
            name: "Youssef El Idrissi",
            initials: "YE",
            age: 56,
            turn: "A-204",
            condition: "Douleur thoracique atypique",
            specialty: "Cardiologie",
            arrival: "09:00",
            waitMinutes: 23,
            diagnosis: "Observation clinique en cours",
            symptoms: "Gene thoracique intermittente",
            treatment: "ECG de controle et bilan enzymatique.",
            nextVisit: "2026-04-28",
            history: [
                { date: "03 mars 2026", diagnosis: "Check-up cardiaque", doctor: "Dr. Dean Walsh", notes: "RAS, controle annuel recommande." },
                { date: "21 sept. 2025", diagnosis: "Evaluation douleur", doctor: "Dr. Amine Farah", notes: "Tests d'effort a surveiller." }
            ]
        },
        {
            id: "PT-1188",
            name: "Salma Benali",
            initials: "SB",
            age: 31,
            turn: "A-205",
            condition: "Consultation post-partum",
            specialty: "Medecine generale",
            arrival: "09:20",
            waitMinutes: 15,
            diagnosis: "Suivi clinique simple",
            symptoms: "Fatigue, douleurs lombaires",
            treatment: "Complement vitaminique et repos guide.",
            nextVisit: "2026-05-12",
            history: [
                { date: "25 mars 2026", diagnosis: "Controle general", doctor: "Dr. Dean Walsh", notes: "Recuperation correcte. Hydratation renforcee." }
            ]
        },
        {
            id: "PT-0997",
            name: "Hamza Akki",
            initials: "HA",
            age: 64,
            turn: "A-206",
            condition: "Controle diabete",
            specialty: "Endocrinologie",
            arrival: "09:40",
            waitMinutes: 20,
            diagnosis: "HbA1c a reevaluer",
            symptoms: "Soif accrue, glycémie variable",
            treatment: "Bilan biologique et adaptation alimentaire.",
            nextVisit: "2026-05-02",
            history: [
                { date: "14 avr. 2026", diagnosis: "Suivi metabolique", doctor: "Dr. Dean Walsh", notes: "Amelioration partielle. Education therapeutique refaite." }
            ]
        },
        {
            id: "PT-1261",
            name: "Leila Haddad",
            initials: "LH",
            age: 48,
            turn: "A-207",
            condition: "Bilan annuel",
            specialty: "Cardiologie preventive",
            arrival: "10:00",
            waitMinutes: 12,
            diagnosis: "Bilan preventif programme",
            symptoms: "Aucun symptome majeur",
            treatment: "ECG, analyse sanguine, conseils hygiene de vie.",
            nextVisit: "2026-10-21",
            history: [
                { date: "06 mai 2025", diagnosis: "Suivi prevenif", doctor: "Dr. Dean Walsh", notes: "Excellente adherence et bilan stable." }
            ]
        }
    ],
    consultations: [
        {
            patient: "Nadia Rahimi",
            time: "09:10",
            status: "En cours",
            room: "Salle 3",
            notes: "Surveillance de la tension et adaptation du traitement."
        },
        {
            patient: "Youssef El Idrissi",
            time: "09:40",
            status: "A confirmer",
            room: "Salle 2",
            notes: "Priorite moyenne, ECG prepare."
        },
        {
            patient: "Leila Haddad",
            time: "10:30",
            status: "Planifiee",
            room: "Salle 1",
            notes: "Bilan annuel avec prevention cardio."
        }
    ],
    records: [
        { title: "ECG Avril 2026", patient: "Nadia Rahimi", summary: "Rythme sinusal regulier, pas d'anomalie ischemique.", updatedAt: "Aujourd'hui 09:02" },
        { title: "Ordonnance HTA", patient: "Youssef El Idrissi", summary: "Renouvellement traitement et surveillance a domicile.", updatedAt: "Aujourd'hui 08:55" },
        { title: "Compte rendu consultation", patient: "Hamza Akki", summary: "Controle glycémique et recommandations nutritionnelles.", updatedAt: "Hier 17:20" },
        { title: "Bilan annuel", patient: "Leila Haddad", summary: "Examens complementaires planifies sur 2 semaines.", updatedAt: "Hier 14:05" }
    ],
    contacts: [
        { name: "Laboratoire Central", role: "Analyses biologiques", details: "+212 522 00 14 22", extra: "Resultats express avant 18h" },
        { name: "Clinique Radiologie Atlas", role: "Imagerie", details: "+212 522 30 98 77", extra: "IRM et scanner sur rendez-vous" },
        { name: "Urgences Cabinet", role: "Ligne prioritaire", details: "+212 600 45 10 10", extra: "Disponible 24/7" },
        { name: "Coordination Infirmiere", role: "Suivi patient", details: "care@medicare.ma", extra: "Transmission des comptes rendus" }
    ],
    appointments: []
};

const state = {
    filteredPatients: null,
    selectedPatientId: null
};

const els = {};

document.addEventListener("DOMContentLoaded", () => {
    cacheElements();
    seedAppointments();
    bindEvents();
    setCurrentDate();
    renderAll();
    switchView(window.doctorDashboardInitialView || "dashboard");
    showNotification("Le dashboard medecin est pret.");
});

function cacheElements() {
    [
        "view-title",
        "current-date",
        "current-patient-avatar",
        "current-patient-name",
        "current-patient-turn",
        "current-patient-age",
        "current-patient-condition",
        "current-turn-display",
        "diagnosis",
        "symptoms",
        "treatment",
        "next-visit",
        "patient-queue",
        "queue-count",
        "total-patients",
        "completed-patients",
        "waiting-patients",
        "avg-time",
        "progress-fill",
        "calendar-days",
        "current-month",
        "today-appointments",
        "upcoming-appointments",
        "patient-list",
        "patient-history-list",
        "patient-search",
        "consultation-list",
        "record-grid",
        "contact-grid",
        "notification",
        "notification-text",
        "sidebar",
        "overlay",
        "hamburger-btn",
        "prev-patient-btn",
        "next-patient-btn",
        "next-patient-inline-btn",
        "medical-notes-form",
        "complete-visit-btn",
        "save-notes-btn",
        "reschedule-btn",
        "print-report-btn",
        "print-ordonnance-btn",
        "prev-month",
        "next-month",
        "today-btn",
        "add-appointment-btn",
        "new-patient-btn",
        "search-patient-btn",
        "new-consultation-btn",
        "export-records-btn",
        "new-contact-btn",
        "about-action-btn"
    ].forEach((id) => {
        els[id.replace(/-([a-z])/g, (_, c) => c.toUpperCase())] = document.getElementById(id);
    });

    els.navItems = Array.from(document.querySelectorAll(".nav-item"));
    els.viewContainers = Array.from(document.querySelectorAll(".view-container"));
}

function bindEvents() {
    els.navItems.forEach((item) => {
        item.addEventListener("click", () => switchView(item.dataset.view));
    });

    els.hamburgerBtn.addEventListener("click", () => {
        els.sidebar.classList.add("active");
        els.overlay.classList.add("active");
    });

    els.overlay.addEventListener("click", closeSidebar);
    els.prevPatientBtn.addEventListener("click", goToPreviousPatient);
    els.nextPatientBtn.addEventListener("click", goToNextPatient);
    els.nextPatientInlineBtn.addEventListener("click", goToNextPatient);

    els.medicalNotesForm.addEventListener("submit", (event) => {
        event.preventDefault();
        saveCurrentPatientNotes();
    });

    els.completeVisitBtn.addEventListener("click", completeCurrentVisit);
    els.rescheduleBtn.addEventListener("click", () => showNotification("Consultation reprogrammee pour demain matin."));
    els.printReportBtn.addEventListener("click", () => printDocument("report"));
    els.printOrdonnanceBtn.addEventListener("click", () => printDocument("ordonnance"));

    els.prevMonth.addEventListener("click", () => changeMonth(-1));
    els.nextMonth.addEventListener("click", () => changeMonth(1));
    els.todayBtn.addEventListener("click", () => {
        dashboardData.calendarDate = new Date();
        renderCalendar();
    });

    els.addAppointmentBtn.addEventListener("click", () => showNotification("Le formulaire d'ajout sera branche au backend de rendez-vous."));
    els.newPatientBtn.addEventListener("click", () => showNotification("Le bouton New Patient est pret pour votre futur formulaire Laravel."));
    els.searchPatientBtn.addEventListener("click", filterPatients);
    els.patientSearch.addEventListener("input", filterPatients);
    els.newConsultationBtn.addEventListener("click", () => showNotification("Une nouvelle consultation peut etre initialisee depuis ce module."));
    els.exportRecordsBtn.addEventListener("click", () => showNotification("Export PDF a connecter a votre backend."));
    els.newContactBtn.addEventListener("click", () => showNotification("Le carnet de contacts est pret pour les integrations."));
    els.aboutActionBtn.addEventListener("click", () => showNotification("Consultez le fichier FRONTEND_ARCHITECTURE.md pour le branchement backend."));
}

function renderAll() {
    renderCurrentPatient();
    renderQueue();
    renderStats();
    renderCalendar();
    renderPatientList();
    renderConsultations();
    renderRecords();
    renderContacts();
}

function setCurrentDate() {
    const now = new Date();
    els.currentDate.textContent = now.toLocaleDateString("fr-FR", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric"
    });
}

function switchView(viewName) {
    els.navItems.forEach((item) => item.classList.toggle("active", item.dataset.view === viewName));
    els.viewContainers.forEach((container) => container.classList.toggle("active", container.id === `${viewName}-view`));
    els.viewTitle.textContent = getViewLabel(viewName);
    closeSidebar();
}

function getViewLabel(viewName) {
    const labels = {
        dashboard: "Dashboard",
        schedule: "Schedule",
        patients: "Patients",
        consultations: "Consultations",
        records: "Dossiers medicaux",
        contacts: "Contacts",
        about: "About"
    };

    return labels[viewName] || "Dashboard";
}

function getCurrentPatient() {
    return dashboardData.patients[dashboardData.currentPatientIndex];
}

function renderCurrentPatient() {
    const patient = getCurrentPatient();
    if (!patient) {
        return;
    }

    els.currentPatientAvatar.textContent = patient.initials;
    els.currentPatientName.textContent = patient.name;
    els.currentPatientTurn.textContent = patient.turn;
    els.currentPatientAge.textContent = `${patient.age} ans`;
    els.currentPatientCondition.textContent = patient.condition;
    els.currentTurnDisplay.textContent = patient.turn;

    els.diagnosis.value = patient.diagnosis;
    els.symptoms.value = patient.symptoms;
    els.treatment.value = patient.treatment;
    els.nextVisit.value = patient.nextVisit;

    els.prevPatientBtn.disabled = dashboardData.currentPatientIndex === 0;
    const isLast = dashboardData.currentPatientIndex >= dashboardData.patients.length - 1;
    els.nextPatientBtn.disabled = isLast;
    els.nextPatientInlineBtn.disabled = isLast;
}

function renderQueue() {
    const currentIndex = dashboardData.currentPatientIndex;
    const queue = dashboardData.patients.slice(currentIndex);
    els.patientQueue.innerHTML = "";

    queue.forEach((patient, index) => {
        const absoluteIndex = currentIndex + index;
        const item = document.createElement("button");
        item.type = "button";
        item.className = `queue-item${absoluteIndex === currentIndex ? " active" : ""}`;
        item.innerHTML = `
            <div class="queue-avatar">${patient.initials}</div>
            <div class="queue-info">
                <h4>${patient.name}</h4>
                <p>${patient.turn} • ${patient.arrival} • ${patient.specialty}</p>
            </div>
        `;
        item.addEventListener("click", () => {
            dashboardData.currentPatientIndex = absoluteIndex;
            renderCurrentPatient();
            renderQueue();
            renderStats();
        });
        els.patientQueue.appendChild(item);
    });

    const waiting = Math.max(dashboardData.patients.length - currentIndex - 1, 0);
    els.queueCount.textContent = `${waiting} waiting`;
}

function renderStats() {
    const total = dashboardData.patients.length;
    const completed = dashboardData.currentPatientIndex;
    const waiting = Math.max(total - completed - 1, 0);
    const avg = Math.round(dashboardData.patients.reduce((sum, patient) => sum + patient.waitMinutes, 0) / total);
    const progress = Math.round((completed / total) * 100);

    els.totalPatients.textContent = String(total);
    els.completedPatients.textContent = String(completed);
    els.waitingPatients.textContent = String(waiting);
    els.avgTime.textContent = `${avg} min`;
    els.progressFill.style.width = `${progress}%`;
}

function seedAppointments() {
    const base = new Date();
    dashboardData.appointments = [
        { date: shiftDate(base, 0, 9, 15), patient: "Nadia Rahimi", type: "Consultation", doctor: "Dr. Dean Walsh" },
        { date: shiftDate(base, 0, 10, 0), patient: "Youssef El Idrissi", type: "ECG", doctor: "Dr. Dean Walsh" },
        { date: shiftDate(base, 0, 11, 30), patient: "Leila Haddad", type: "Bilan annuel", doctor: "Dr. Dean Walsh" },
        { date: shiftDate(base, 1, 9, 45), patient: "Hamza Akki", type: "Suivi diabete", doctor: "Dr. Dean Walsh" },
        { date: shiftDate(base, 2, 13, 0), patient: "Salma Benali", type: "Controle", doctor: "Dr. Dean Walsh" },
        { date: shiftDate(base, 4, 15, 20), patient: "Nadia Rahimi", type: "Resultats labo", doctor: "Dr. Dean Walsh" }
    ];
}

function shiftDate(base, offsetDays, hour, minute) {
    const date = new Date(base);
    date.setDate(date.getDate() + offsetDays);
    date.setHours(hour, minute, 0, 0);
    return date;
}

function renderCalendar() {
    const date = dashboardData.calendarDate;
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const today = new Date();
    const appointmentDays = new Set(
        dashboardData.appointments
            .filter((appointment) => appointment.date.getMonth() === month && appointment.date.getFullYear() === year)
            .map((appointment) => appointment.date.getDate())
    );

    els.currentMonth.textContent = date.toLocaleDateString("fr-FR", {
        month: "long",
        year: "numeric"
    });

    els.calendarDays.innerHTML = "";

    for (let i = 0; i < firstDay.getDay(); i += 1) {
        const placeholder = document.createElement("div");
        placeholder.className = "calendar-day placeholder";
        els.calendarDays.appendChild(placeholder);
    }

    for (let day = 1; day <= lastDay.getDate(); day += 1) {
        const cell = document.createElement("button");
        cell.type = "button";
        cell.className = "calendar-day";
        cell.textContent = day;

        if (
            day === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear()
        ) {
            cell.classList.add("today");
        }

        if (appointmentDays.has(day)) {
            cell.classList.add("appointment");
        }

        cell.addEventListener("click", () => {
            document.querySelectorAll(".calendar-day.selected").forEach((selected) => selected.classList.remove("selected"));
            cell.classList.add("selected");
            showNotification(`Appointments du ${formatShortDate(new Date(year, month, day))}`);
        });

        els.calendarDays.appendChild(cell);
    }

    renderAppointments();
}

function renderAppointments() {
    const today = new Date();
    const weekLimit = new Date();
    weekLimit.setDate(today.getDate() + 7);

    const todaysAppointments = dashboardData.appointments.filter((appointment) => isSameDay(appointment.date, today));
    const weeklyAppointments = dashboardData.appointments.filter((appointment) => appointment.date > today && appointment.date <= weekLimit);

    els.todayAppointments.innerHTML = todaysAppointments.map(renderAppointmentCard).join("") || emptyBlock("Aucun rendez-vous aujourd'hui.");
    els.upcomingAppointments.innerHTML = weeklyAppointments.map(renderAppointmentCard).join("") || emptyBlock("Aucun rendez-vous cette semaine.");
}

function renderAppointmentCard(appointment) {
    return `
        <div class="appointment-item">
            <div class="appointment-time">
                <i class="fas fa-clock"></i>
                ${appointment.date.toLocaleTimeString("fr-FR", { hour: "2-digit", minute: "2-digit" })}
            </div>
            <div class="appointment-patient">${appointment.patient}</div>
            <div class="appointment-type">${appointment.type} • ${formatShortDate(appointment.date)}</div>
        </div>
    `;
}

function renderPatientList() {
    const patients = state.filteredPatients || dashboardData.patients;
    const selectedId = state.selectedPatientId || getCurrentPatient()?.id;

    els.patientList.innerHTML = patients.map((patient) => `
        <button type="button" class="patient-list-item${patient.id === selectedId ? " active" : ""}" data-patient-id="${patient.id}">
            <div class="patient-list-name">${patient.name}</div>
            <div class="patient-list-details">
                <span>${patient.id}</span>
                <span>${patient.condition}</span>
            </div>
        </button>
    `).join("");

    els.patientList.querySelectorAll("[data-patient-id]").forEach((item) => {
        item.addEventListener("click", () => {
            state.selectedPatientId = item.dataset.patientId;
            renderPatientList();
            renderPatientHistory();
        });
    });

    renderPatientHistory();
}

function renderPatientHistory() {
    const selectedId = state.selectedPatientId || getCurrentPatient()?.id;
    const patient = dashboardData.patients.find((entry) => entry.id === selectedId) || dashboardData.patients[0];

    els.patientHistoryList.innerHTML = patient.history.map((entry) => `
        <div class="history-item">
            <div class="history-date">${entry.date}</div>
            <div class="history-diagnosis">${entry.diagnosis}</div>
            <div class="history-doctor">
                <i class="fas fa-user-md"></i>
                <span>${entry.doctor}</span>
            </div>
            <div class="history-notes">${entry.notes}</div>
        </div>
    `).join("");
}

function renderConsultations() {
    els.consultationList.innerHTML = dashboardData.consultations.map((consultation) => `
        <article class="consultation-item">
            <h3>${consultation.patient}</h3>
            <div class="consultation-meta">
                <span><strong>Heure:</strong> ${consultation.time}</span>
                <span><strong>Salle:</strong> ${consultation.room}</span>
            </div>
            <span class="consultation-status">${consultation.status}</span>
            <p class="consultation-notes">${consultation.notes}</p>
        </article>
    `).join("");
}

function renderRecords() {
    els.recordGrid.innerHTML = dashboardData.records.map((record) => `
        <article class="record-card">
            <h3>${record.title}</h3>
            <div class="record-meta">
                <span><strong>Patient:</strong> ${record.patient}</span>
                <span><strong>Mise a jour:</strong> ${record.updatedAt}</span>
            </div>
            <p>${record.summary}</p>
        </article>
    `).join("");
}

function renderContacts() {
    els.contactGrid.innerHTML = dashboardData.contacts.map((contact) => `
        <article class="contact-card">
            <h3>${contact.name}</h3>
            <div class="contact-meta">
                <span><strong>Role:</strong> ${contact.role}</span>
                <span><strong>Contact:</strong> ${contact.details}</span>
            </div>
            <p>${contact.extra}</p>
        </article>
    `).join("");
}

function filterPatients() {
    const term = els.patientSearch.value.trim().toLowerCase();
    if (!term) {
        state.filteredPatients = null;
        renderPatientList();
        return;
    }

    state.filteredPatients = dashboardData.patients.filter((patient) => {
        return [patient.name, patient.id, patient.condition].some((field) => field.toLowerCase().includes(term));
    });

    if (state.filteredPatients.length) {
        state.selectedPatientId = state.filteredPatients[0].id;
    }

    els.patientHistoryList.innerHTML = state.filteredPatients.length ? "" : emptyBlock("Aucun patient correspondant.");
    renderPatientList();
}

function saveCurrentPatientNotes() {
    const patient = getCurrentPatient();
    patient.diagnosis = els.diagnosis.value;
    patient.symptoms = els.symptoms.value;
    patient.treatment = els.treatment.value;
    patient.nextVisit = els.nextVisit.value;
    showNotification(`Notes de ${patient.name} enregistrees.`);
}

function completeCurrentVisit() {
    const patient = getCurrentPatient();
    showNotification(`Consultation de ${patient.name} terminee.`);
    if (dashboardData.currentPatientIndex < dashboardData.patients.length - 1) {
        dashboardData.currentPatientIndex += 1;
        renderCurrentPatient();
        renderQueue();
        renderStats();
    }
}

function goToNextPatient() {
    if (dashboardData.currentPatientIndex < dashboardData.patients.length - 1) {
        dashboardData.currentPatientIndex += 1;
        renderCurrentPatient();
        renderQueue();
        renderStats();
    }
}

function goToPreviousPatient() {
    if (dashboardData.currentPatientIndex > 0) {
        dashboardData.currentPatientIndex -= 1;
        renderCurrentPatient();
        renderQueue();
        renderStats();
    }
}

function changeMonth(offset) {
    dashboardData.calendarDate = new Date(
        dashboardData.calendarDate.getFullYear(),
        dashboardData.calendarDate.getMonth() + offset,
        1
    );
    renderCalendar();
}

function printDocument(type) {
    const patient = getCurrentPatient();
    const title = type === "report" ? "Rapport de consultation" : "Ordonnance";
    const content = type === "report"
        ? `
            <p><strong>Patient:</strong> ${patient.name}</p>
            <p><strong>ID:</strong> ${patient.id}</p>
            <p><strong>Diagnostic:</strong> ${patient.diagnosis}</p>
            <p><strong>Symptomes:</strong> ${patient.symptoms}</p>
            <p><strong>Plan de traitement:</strong> ${patient.treatment}</p>
            <p><strong>Prochaine visite:</strong> ${patient.nextVisit}</p>
        `
        : `
            <p><strong>Patient:</strong> ${patient.name}</p>
            <p><strong>Prescription:</strong> ${patient.treatment}</p>
            <p><strong>Date:</strong> ${formatShortDate(new Date())}</p>
            <p><strong>Medecin:</strong> Dr. Dean Walsh</p>
        `;

    const printWindow = window.open("", "_blank", "width=900,height=700");
    if (!printWindow) {
        showNotification("La fenetre d'impression a ete bloquee par le navigateur.");
        return;
    }

    printWindow.document.write(`
        <html lang="fr">
            <head>
                <title>${title}</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 40px; color: #163423; }
                    h1 { color: #1a4d2e; margin-bottom: 24px; }
                    p { line-height: 1.6; margin: 0 0 12px; }
                </style>
            </head>
            <body>
                <h1>${title}</h1>
                ${content}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}

function showNotification(message) {
    els.notificationText.textContent = message;
    els.notification.style.display = "flex";
    window.clearTimeout(showNotification.timer);
    showNotification.timer = window.setTimeout(() => {
        els.notification.style.display = "none";
    }, 2600);
}

function closeSidebar() {
    els.sidebar.classList.remove("active");
    els.overlay.classList.remove("active");
}

function formatShortDate(date) {
    return date.toLocaleDateString("fr-FR", {
        day: "2-digit",
        month: "short",
        year: "numeric"
    });
}

function isSameDay(a, b) {
    return a.getDate() === b.getDate() && a.getMonth() === b.getMonth() && a.getFullYear() === b.getFullYear();
}

function emptyBlock(text) {
    return `<div class="appointment-item"><div class="appointment-type">${text}</div></div>`;
}
