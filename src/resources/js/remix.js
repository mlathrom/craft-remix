const findReplaceTemplates = {
    stripArticles: {
        find: '/^(The|A)\\s+/',
        replace: '',
        regex: true
    },
    stripPunctuation: {
        find: '/[^\\w\\s]/g',
        replace: '',
        regex: true
    },
    stripSpecial: {
        find: '/[^a-zA-Z0-9\\s]/g',
        replace: '',
        regex: true
    },
    spacesToDashes: {
        find: ' ',
        replace: '-',
        regex: false
    },
    dashesToUnderscores: {
        find: '-',
        replace: '_',
        regex: false
    },
};
  
const buttons = document.querySelectorAll('.remix-templates button');
const regexInput = document.querySelector('.remix-regex-input');
const outputFormat = document.querySelector('.remix-output-format-input');
const findReplaceRules = document.querySelector('.remix-find-replace-rules');
const findReplaceRulesButton = document.querySelector('.remix-find-replace-rules > button.btn');

buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const patternName = button.dataset.pattern;
        const findReplaceTemplate = findReplaceTemplates[patternName];
        findReplaceRulesButton.click();
        findReplaceRow = findReplaceRules.querySelectorAll('tbody > tr:last-child > td');
        findReplaceRow[0].querySelector('textarea').value = findReplaceTemplate.find;
        findReplaceRow[1].querySelector('textarea').value = findReplaceTemplate.replace;
        if (findReplaceTemplate.regex) {
            findReplaceRow[2].querySelector('.checkbox').checked = true;
        }
        button.focus();
    });
});