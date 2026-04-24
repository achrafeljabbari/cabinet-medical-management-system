@extends('layouts.auth-neumorphism')
@section('title', 'Inscription - MediCare')
@section('content')

<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style>
*, *::after, *::before {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  user-select: none;
}

:root {
    --primary:        #4a90e2;
    --secondary:      #7baedc;
    --accent:         #a3c9f9;
    --light-accent:   #b5e0f5;
    
    --bg-light:       #f9fbfd;
    --bg-card:        #ffffff;
    --border-light:   #dbe4ec;
    
    --text-primary:   #1f2d3d;
    --text-secondary: #5c6f7a;
    --text-muted:     #9aa8b3;
    
    --gradient-primary: linear-gradient(135deg, #4a90e2 0%, #7baedc 45%, #a3c9f9 100%);
    --shadow-sm:      0 2px 4px rgba(74, 144, 226, 0.05);
    --shadow-md:      0 8px 24px rgba(74, 144, 226, 0.08);
    --shadow-lg:      0 12px 40px rgba(74, 144, 226, 0.1);
}

html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Montserrat', 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    background-color: var(--bg-light);
    color: var(--text-secondary);
}

.auth-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.btn-back {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1001;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: var(--bg-card);
    border: 1.5px solid var(--border-light);
    border-radius: 10px;
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.btn-back:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateX(-2px);
    box-shadow: var(--shadow-md);
}

.auth-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    /* Scrollbar SEULEMENT sur le container, pas sur le formulaire */
    overflow-y: auto;
}

.auth-content {
    width: 100%;
    max-width: 450px;
    padding: 40px;
    background-color: var(--bg-card);
    border-radius: 20px;
    box-shadow: 0 16px 40px rgba(26, 124, 135, 0.1);
}

.form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
}

.form__title {
    font-size: 28px;
    font-weight: 700;
    line-height: 1.5;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 8px;
}

.form__description {
    font-size: 13px;
    letter-spacing: 0.25px;
    text-align: center;
    line-height: 1.6;
    color: var(--text-secondary);
    margin-bottom: 25px;
}

.form__group {
    width: 100%;
    margin-bottom: 15px;
}

.form__input {
    width: 100%;
    height: 45px;
    padding: 0 18px;
    font-size: 13px;
    letter-spacing: 0.15px;
    border: 1.5px solid var(--border-light);
    outline: none;
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-light);
    transition: all 0.3s ease;
    border-radius: 10px;
    box-sizing: border-box;
    color: var(--text-primary);
}

.form__input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.08);
}

.form__input::placeholder {
    color: var(--text-muted);
}

.form__select {
    width: 100%;
    height: 45px;
    padding: 0 18px;
    font-size: 13px;
    border: 1.5px solid var(--border-light);
    outline: none;
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-light);
    transition: all 0.3s ease;
    border-radius: 10px;
    box-sizing: border-box;
    color: var(--text-primary);
}

.form__select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.08);
}

.error-box {
    width: 100%;
    font-size: 12px;
    color: #c7254e;
    margin-bottom: 15px;
    padding: 12px;
    background: #f2dede;
    border-radius: 8px;
    border-left: 4px solid #a94442;
    text-align: center;
    box-sizing: border-box;
}

.success-box {
    width: 100%;
    font-size: 12px;
    color: #155724;
    margin-bottom: 15px;
    padding: 12px;
    background: #d4edda;
    border-radius: 8px;
    border-left: 4px solid #28a745;
    text-align: center;
    box-sizing: border-box;
}

.button {
    width: 100%;
    height: 45px;
    border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.8px;
    background: var(--gradient-primary);
    color: white;
    box-shadow: var(--shadow-md);
    border: none;
    outline: none;
    cursor: pointer;
    font-family: 'Montserrat', sans-serif;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-sizing: border-box;
}

.button:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.button:active {
    transform: translateY(0);
}

.button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.loading {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

.button.is-loading .loading {
    display: block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.form__footer {
    text-align: center;
    font-size: 13px;
    color: var(--text-secondary);
}

.form__link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    display: inline-block;
    margin-left: 4px;
}

.form__link:hover {
    color: var(--secondary);
    text-decoration: underline;
}

@media (max-width: 500px) {
    .auth-content {
        padding: 30px 20px;
    }

    .form__title {
        font-size: 24px;
    }
}
</style>

<div class="auth-wrapper">
    <a href="{{ url('/') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        Retour
    </a>
    
    <div class="auth-container">
        <div class="auth-content">
            <form class="form" id="register-form">
                <h2 class="form__title">S'inscrire</h2>
                <p class="form__description">Créer votre compte patient MediCare</p>

                <div id="register-messages"></div>

                <div class="form__group">
                    <input 
                        type="text" 
                        name="nom" 
                        class="form__input" 
                        placeholder="Nom"
                        required>
                </div>

                <div class="form__group">
                    <input 
                        type="text" 
                        name="prenom" 
                        class="form__input" 
                        placeholder="Prénom"
                        required>
                </div>

                <div class="form__group">
                    <input 
                        type="email" 
                        name="email" 
                        class="form__input" 
                        placeholder="Adresse email"
                        required>
                </div>

                <div class="form__group">
                    <input 
                        type="date" 
                        name="date_of_birth" 
                        class="form__input" 
                        placeholder="Date de naissance">
                </div>

                <div class="form__group">
                    <select name="gender" class="form__select">
                        <option value="">Sexe</option>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div class="form__group">
                    <input 
                        type="tel" 
                        name="telephone" 
                        class="form__input" 
                        placeholder="Téléphone">
                </div>

                <div class="form__group">
                    <input 
                        type="password" 
                        name="password" 
                        class="form__input" 
                        placeholder="Mot de passe (min 8 caractères)"
                        required>
                </div>

                <div class="form__group">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form__input" 
                        placeholder="Confirmer mot de passe"
                        required>
                </div>

                <button type="submit" class="button" id="register-btn">
                    <span class="loading"></span>
                    <span>SE CONNECTER</span>
                </button>

                <div class="form__footer">
                    Déjà inscrit ?
                    <a href="{{ url('/connexion') }}" class="form__link">Se connecter ici</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('register-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const messagesDiv = document.getElementById('register-messages');
    const btnRegister = document.getElementById('register-btn');
    const formData = new FormData(e.target);
    
    const email = formData.get('email');
    const password = formData.get('password');
    const passwordConfirm = formData.get('password_confirmation');
    const nom = formData.get('nom');
    const prenom = formData.get('prenom');

    // Nettoyer les messages
    messagesDiv.innerHTML = '';

    // Validations
    if (!nom || !prenom || !email || !password || !passwordConfirm) {
        messagesDiv.innerHTML = '<div class="error-box">Tous les champs obligatoires doivent être remplis</div>';
        return;
    }

    if (password !== passwordConfirm) {
        messagesDiv.innerHTML = '<div class="error-box">Les mots de passe ne correspondent pas</div>';
        return;
    }

    if (password.length < 8) {
        messagesDiv.innerHTML = '<div class="error-box">Le mot de passe doit contenir au moins 8 caractères</div>';
        return;
    }

    // Loading
    btnRegister.classList.add('is-loading');
    btnRegister.disabled = true;

    try {
        const registrationData = {
            nom: nom,
            prenom: prenom,
            email: email,
            password: password,
            password_confirmation: passwordConfirm,
            date_of_birth: formData.get('date_of_birth') || null,
            gender: formData.get('gender') || null,
            telephone: formData.get('telephone') || null
        };

        const result = await registerPatient(registrationData);
        
        messagesDiv.innerHTML = '<div class="success-box">✓ Inscription réussie! Redirection vers connexion...</div>';
        
        setTimeout(() => {
            window.location.href = '/connexion';
        }, 1500);
    } catch (error) {
        messagesDiv.innerHTML = `<div class="error-box">✗ ${error.message}</div>`;
        btnRegister.classList.remove('is-loading');
        btnRegister.disabled = false;
    }
});
</script>
@endpush

@endsection
