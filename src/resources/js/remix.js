const findReplaceTemplates = {
    stripArticles: {
        find: '^(The|A)\\s+',
        replace: '',
        regex: true
    },
    stripPunctuation: {
        find: '[^\\w\\s]',
        replace: '',
        regex: true
    },
    stripSpecial: {
        find: '[^a-zA-Z0-9\\s]',
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

function processRegExtString(input, flags) {
    return new RegExp(input, flags);
}

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

            if (value === '') {
                field.value = '';
                return;
            }

            if (remixSettings.findReplaceRules) {
                Object.values(remixSettings.findReplaceRules).forEach((rule) => {
                    let find = rule[0];
                    const replace = rule[1];
                    const ignoreCase = rule[2];
                    const isRegex = rule[3];
    
                    if (isRegex) {
                        find = find.replace(/\\/g, '\\\\');
                        find = new RegExp(rule[0], 'g');
                        newValue = newValue.replace(find, replace);
                    } else {
                        find = RegExp(find, 'ig');
                        if (ignoreCase) {
                            find = RegExp(find, 'ig');
                            newValue = newValue.replace(find, replace);
                        } else {
                            newValue = newValue.replaceAll(find, replace);
                        }
                    }
                });
            }

            if (remixSettings.textTransform) {
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

            newValue = remixSettings.prepend + newValue + remixSettings.append;

            field.value = newValue;
        });
    });
});
