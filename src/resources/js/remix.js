const findReplaceTemplates = {
    stripArticles: {
        find: '/^(The|A)\\s+/g',
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
const findReplaceRules = document.querySelector('.remix-find-replace-rules');
const findReplaceRulesButton = document.querySelector('.remix-find-replace-rules button.btn');

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
    });
});

// Entry Page Actions
document.addEventListener('DOMContentLoaded', () => {
    const remixFields = document.querySelectorAll('.remix-field');

    if (!remixFields) {
        return;
    }

    remixFields.forEach((field) => {
        const id = field.id.replace('fields-', '');
        const remixSettingsJson = window['remixSettings_' + id];
        const remixSettings = JSON.parse(remixSettingsJson);
        const target = document.querySelector('#' + remixSettings.target);

        target.addEventListener('input', () => {
            const value = target.value;
            let newValue = value;

            if (remixSettings.findReplaceRules[0]) {
                remixSettings.findReplaceRules[0].forEach((rule) => {
                    const find = rule[0];
                    const replace = rule[1];
                    const regex = rule[2];
    
                    if (regex) {
                        const findRegex = new RegExp(find);
                        newValue = newValue.replace(findRegex, replace);
                    } else {
                        newValue = newValue.replace(find, replace);
                    }
                });
            }

            if (remixSettings.prepend) {
                newValue = remixSettings.prepend + newValue;
            }

            if(remixSettings.append) {
                newValue = newValue + remixSettings.append;
            }

            if (remixSettings.RemixTextTransform) {
                switch (remixSettings.textTransform) {
                    case 'uppercase':
                        newValue = newValue.toUpperCase();
                        break;
                    case 'lowercase':
                        newValue = newValue.toLowerCase();
                        break;
                    case 'titlecase':
                        newValue = newValue.replace(/\b\w/g, (char) => char.toUpperCase());
                        break;
                    default:
                        break;
                }
            }

            field.value = newValue;
        });
    });
});
