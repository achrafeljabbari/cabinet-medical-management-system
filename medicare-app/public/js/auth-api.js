/**
 * MediCare - Authentication API Integration
 * Gère les appels API pour login et registration patient
 */

const API_BASE_URL = 'http://localhost:8000/api'; // À adapter selon votre configuration

/**
 * Stocker les données d'authentification
 */
function saveAuthData(token, user) {
    localStorage.setItem('auth_token', token);
    localStorage.setItem('user', JSON.stringify(user));
    localStorage.setItem('auth_timestamp', new Date().getTime());
}

/**
 * Récupérer les données d'authentification
 */
function getAuthData() {
    return {
        token: localStorage.getItem('auth_token'),
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null
    };
}

/**
 * Vérifier si l'utilisateur est connecté
 */
function isAuthenticated() {
    return !!localStorage.getItem('auth_token');
}

/**
 * Se déconnecter
 */
function logout() {
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user');
    localStorage.removeItem('auth_timestamp');
    window.location.href = '/connexion';
}

/**
 * Faire une requête authentifiée à l'API
 */
async function apiCall(endpoint, method = 'GET', body = null) {
    const token = localStorage.getItem('auth_token');
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    };

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    const options = {
        method,
        headers,
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    try {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, options);
        
        if (response.status === 401) {
            // Token invalide, se déconnecter
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            localStorage.removeItem('auth_timestamp');
            throw new Error('Session expirée');
        }

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Erreur lors de la requête');
        }

        return data;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

/**
 * Connexion (Login)
 */
async function login(email, password) {
    try {
        const response = await fetch(`${API_BASE_URL}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Email ou mot de passe incorrect');
        }

        // Récupérer le token et l'utilisateur
        if (data.data && data.data.access_token && data.data.user) {
            saveAuthData(data.data.access_token, data.data.user);
            return data.data;
        } else if (data.access_token && data.user) {
            saveAuthData(data.access_token, data.user);
            return data;
        }

        throw new Error('Réponse invalide du serveur');
    } catch (error) {
        console.error('Login error:', error);
        throw error;
    }
}

/**
 * Inscription Patient
 */
async function registerPatient(formData) {
    try {
        const response = await fetch(`${API_BASE_URL}/patients/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (!response.ok) {
            // Améliorer le message d'erreur
            let errorMessage = data.message || 'Erreur lors de l\'inscription';
            
            // Si c'est un tableau d'erreurs de validation
            if (data.errors && typeof data.errors === 'object') {
                const firstError = Object.values(data.errors)[0];
                if (Array.isArray(firstError)) {
                    errorMessage = firstError[0];
                } else {
                    errorMessage = firstError;
                }
            }
            
            // Traduire les messages de validation spécifiques
            if (errorMessage.includes('telephone')) {
                errorMessage = 'Veuillez entrer votre numéro de téléphone';
            }
            
            throw new Error(errorMessage);
        }

        // Récupérer le token et l'utilisateur (auto-login après inscription)
        if (data.data && data.data.access_token && data.data.patient) {
            const user = {
                ...data.data.patient.user,
                patient_id: data.data.patient.id
            };
            saveAuthData(data.data.access_token, user);
            return data.data;
        }

        throw new Error('Réponse invalide du serveur');
    } catch (error) {
        console.error('Register error:', error);
        throw error;
    }
}

/**
 * Récupérer les informations de l'utilisateur connecté
 */
async function getCurrentUser() {
    try {
        return await apiCall('/user');
    } catch (error) {
        console.error('Get current user error:', error);
        return null;
    }
}

/**
 * Initialiser au chargement - Nettoyer les sessions invalides
 */
window.addEventListener('load', () => {
    // Au démarrage, vérifier si le token est valide
    // Si pas de token, c'est ok (utilisateur pas connecté)
    // Si token existe mais invalide, il sera nettoyé lors de la première requête API
});

// Exporter pour utilisation en modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        saveAuthData,
        getAuthData,
        isAuthenticated,
        logout,
        apiCall,
        login,
        registerPatient,
        getCurrentUser,
    };
}
