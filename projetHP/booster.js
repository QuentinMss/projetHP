"use strict";

// Fonction pour récupérer aléatoirement un personnage
function getRandomCharacter() {
    // Appelle l'API pour récupérer tous les personnages
    return fetch('https://hp-api.lainocs.fr/characters/')
        .then(response => response.json())
        .then(data => {
            // Choisit un personnage
            const randomIndex = Math.floor(Math.random() * data.length);
            return data[randomIndex];
        });
}

// Ouvrir le booster
async function openBooster() {
    const boosterResults = document.getElementById('boosterResults');
    boosterResults.innerHTML = '';

    try {
        const character = await getRandomCharacter();
        const resultElement = document.createElement('div');
        resultElement.classList.add('result');
        resultElement.textContent = `Vous avez obtenu : ${character.name}`;
        boosterResults.appendChild(resultElement);
    } catch (error) {
        console.error('Erreur lors de la récupération du personnage :', error);
        const errorElement = document.createElement('div');
        errorElement.classList.add('error');
        errorElement.textContent = 'Une erreur est survenue lors de l\'ouverture du booster.';
        boosterResults.appendChild(errorElement);
    }
}

// Ajoute un événement au bouton pour ouvrir le booster
document.getElementById('openBoosterBtn').addEventListener('click', openBooster);
