document.addEventListener('DOMContentLoaded', function(){
i18next
.use(i18nextHttpBackend)
.init({
    lng: 'es',
    backend: {
        loadPath: '../../../config/{{lng}}.json'
    }
}, function(err, t) {
    updateContent();
});

const selectores = document.querySelectorAll('.idioma');
selectores.forEach(selector => {
    selector.addEventListener('change', function() {
        const selectedLanguage = this.value;
        localStorage.setItem('language', selectedLanguage);
        i18next.changeLanguage(selectedLanguage, (err, t) => {
            updateContent();
        });
})
});

window.onload = function() {
const savedLanguage = localStorage.getItem('language') || 'es';
selectores.forEach(selector => {
selector.value = savedLanguage;
});
i18next.changeLanguage(savedLanguage, (err, t) => {
    updateContent();
});
};
});

function updateContent() {
    const translations = [];

    const translateElements = document.querySelectorAll('[data-translate]');
    const newTranslations = Array.from(translateElements).map(element=> element.getAttribute('data-translate'));

    newTranslations.forEach(translation => {
        if (!translations.includes(translation)) {
            translations.push(translation);
        }
    });

    translations.forEach(key => {
        const translatedText = i18next.t(key);
        const elements = document.querySelectorAll(`[data-translate="${key}"]`);
        elements.forEach(element => {
            element.textContent = translatedText;
        });
    
    });
}