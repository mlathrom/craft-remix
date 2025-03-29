const findReplaceTemplates = {
	stripArticles: {
			find: '^(The|A)\\s+',
			replace: '',
			ignoreCase: true,
			regex: true
	},
	stripPunctuation: {
			find: '[^\\w\\s]',
			replace: '',
			ignoreCase: false,
			regex: true
	},
	stripSpecial: {
			find: '[^a-zA-Z0-9\\s]',
			replace: '',
			ignoreCase: false,
			regex: true
	},
	spacesToDashes: {
			find: '\\s+',
			replace: '-',
			ignoreCase: false,
			regex: true
	},
	dashesToUnderscores: {
			find: '-',
			replace: '_',
			ignoreCase: false,
			regex: false
	},
};

// Global settings object - holds the current state
const remixSettings = {
	findReplaceRules: [],
	textTransform: 'none',
	prepend: '',
	append: ''
}

// --- Core Transformation Logic ---
function applyRemixTransformations(text, settings) {
	let result = text;

	// 1. Apply Find/Replace rules sequentially
	if (settings.findReplaceRules.length) {
		settings.findReplaceRules.forEach(rule => {
				try {
						const flags = rule.ignoreCase ? 'gi' : 'g';
						let findPattern;
	
						if (rule.regex) {
								findPattern = new RegExp(rule.find, flags);
						} else {
								const escapedFind = rule.find.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
								findPattern = new RegExp(escapedFind, flags);
						}
						result = result.replace(findPattern, rule.replace);
				} catch (e) {
						console.error("Remix Preview: Invalid Regex in rule:", rule, e);
				}
		});
	}

	// 2. Apply Text Transformation
	switch (settings.textTransform) {
			case 'lowercase':
					result = result.toLowerCase();
					break;
			case 'uppercase':
					result = result.toUpperCase();
					break;
			case 'titlecase':
					result = result.toLowerCase().replace(/(?:^|\s|-)\w/g, (match) => match.toUpperCase());
					break;
	}

	result = settings.prepend + result + settings.append;
	return result;
}

const templateButtons = document.querySelectorAll('.remix-templates button');
const remixFindReplaceRulesContainer = document.querySelector('.remix-find-replace-rules');
const addRuleButton = document.querySelector('.remix-find-replace-rules button.add');
const textTransformGroup = document.querySelector('.remix-transform-radios');
const textTransformRadios = textTransformGroup.querySelectorAll('input');
const prependInput = document.querySelector('.remix-prepend-input');
const appendInput = document.querySelector('.remix-append-input');
const previewInput = document.querySelector('.remix-preview-input');
const previewOutput = document.querySelector('.remix-preview-output');

if (!previewInput || !previewOutput || !prependInput || !appendInput) {
	console.error(previewInput);
} else {
	
	function updateRemixSettingsFromDOM() {
			const findReplaceRows = remixFindReplaceRulesContainer.querySelectorAll('tbody > tr');
			remixSettings.findReplaceRules = [];
			findReplaceRows.forEach(row => {
						const findInput = row.querySelector('td:nth-child(1) textarea');
						const replaceInput = row.querySelector('td:nth-child(2) textarea');
						const ignoreCaseInput = row.querySelector('td:nth-child(3) input[type="checkbox"]');
						const regexInput = row.querySelector('td:nth-child(4) input[type="checkbox"]');

						if (findInput && replaceInput && ignoreCaseInput && regexInput) {
								const find = findInput.value;
								const replace = replaceInput.value;
								const ignoreCase = ignoreCaseInput.checked;
								const regex = regexInput.checked;

								if (find) {
										remixSettings.findReplaceRules.push({ find, replace, ignoreCase, regex });
								}
						} else {
								console.warn("Remix: Could not find all inputs in a find/replace row.", row);
						}
			});

			// Update Text Transform
			const checkedTransformRadio = textTransformGroup.querySelector('input:checked');
			remixSettings.textTransform = checkedTransformRadio ? checkedTransformRadio.value : 'none';

			// Update Prepend/Append
			remixSettings.prepend = prependInput.value;
			remixSettings.append = appendInput.value;
	}
	
	// Updates settings, refresh preview
	function updatePreview() {
			updateRemixSettingsFromDOM();
			const inputText = previewInput.value;
			const outputText = applyRemixTransformations(inputText, remixSettings);
			previewOutput.textContent = outputText;
	}

	// --- Event Listeners ---
	
	// Template Buttons
	templateButtons.forEach(button => {
			button.addEventListener('click', (event) => {
					event.preventDefault();
					const patternName = button.dataset.pattern;
					if (!findReplaceTemplates[patternName]) return;
					
					const findReplaceTemplate = findReplaceTemplates[patternName];

					if (addRuleButton) {
								addRuleButton.click();
								setTimeout(() => {
									const lastRow = remixFindReplaceRulesContainer.querySelector('tbody > tr:last-child');
									if (lastRow) {
											const findInput = lastRow.querySelector('td:nth-child(1) textarea');
											const replaceInput = lastRow.querySelector('td:nth-child(2) textarea');
											const ignoreCaseInput = lastRow.querySelector('td:nth-child(3) input[type="checkbox"]');
											const regexInput = lastRow.querySelector('td:nth-child(4) input[type="checkbox"]');

											if(findInput) findInput.value = findReplaceTemplate.find;
											if(replaceInput) replaceInput.value = findReplaceTemplate.replace;
											if(ignoreCaseInput) ignoreCaseInput.checked = findReplaceTemplate.ignoreCase;
											if(regexInput) regexInput.checked = findReplaceTemplate.regex;

											if(findInput) findInput.dispatchEvent(new Event('input', { bubbles: true }));

											updatePreview();
									} else {
												console.error("Remix: Could not find the newly added row to apply template.");
									}
								}, 50);

					} else {
							console.error("Remix: Could not find the 'Add a rule' button to programmatically add a row.");
					}
			});
	});

	// Detect Find Replace rule changes
	remixFindReplaceRulesContainer.addEventListener('input', (event) => {
			if (event.target.matches('textarea, input[type="checkbox"]') && event.target.closest('tr')) {
					updatePreview();
			}
	});

	// Detect row addition/deletion/reordering
	const observer = new MutationObserver((mutationsList) => {
			let needsUpdate = false;
			for(const mutation of mutationsList) {
					if (mutation.type === 'childList') {
								const changedNodes = [...mutation.addedNodes, ...mutation.removedNodes];
								if (changedNodes.some(node => node.nodeName === 'TR')) {
									needsUpdate = true;
									break;
								}
					}
			}
			if (needsUpdate) {
					updatePreview();
			}
	});

	observer.observe(remixFindReplaceRulesContainer, {
			childList: true,
			subtree: true
	});

	textTransformRadios.forEach(radio => {
			radio.addEventListener('change', updatePreview);
	});

	prependInput.addEventListener('input', updatePreview);
	appendInput.addEventListener('input', updatePreview);

	previewInput.addEventListener('input', updatePreview);

	updatePreview();
}
