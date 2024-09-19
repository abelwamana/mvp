function translate() {
    const contentToTranslate = document.querySelector('p').textContent;
    const targetLanguage = document.getElementById('language').value;

    const url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${targetLanguage}&dt=t&q=${encodeURIComponent(contentToTranslate)}';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const translatedText = data[0][0][0];
            document.getElementById('translated-content').textContent = translatedText;
        })
        .catch(error => console.error('Erro ao traduzir:', error));
}