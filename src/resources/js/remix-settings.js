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
	collapseWhitespace: {
			find: '\\s+',
			replace: ' ',
			ignoreCase: false,
			regex: true
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

// --- Rule-by-Rule Breakdown ---
function generateRuleBreakdown(text, settings) {
	const steps = [];
	let current = text;

	settings.findReplaceRules.forEach((rule, index) => {
		const step = {
			ruleIndex: index + 1,
			find: rule.find,
			replace: rule.replace,
			isRegex: rule.regex,
			ignoreCase: rule.ignoreCase,
			input: current,
			matches: [],
			output: current,
			error: null,
		};

		try {
			const flags = rule.ignoreCase ? 'gi' : 'g';
			let findPattern;

			if (rule.regex) {
				findPattern = new RegExp(rule.find, flags);
			} else {
				const escaped = rule.find.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
				findPattern = new RegExp(escaped, flags);
			}

			// Collect matches
			let match;
			while ((match = findPattern.exec(current)) !== null) {
				step.matches.push(match[0]);
				// Prevent infinite loops on zero-length matches
				if (match[0].length === 0) {
					findPattern.lastIndex++;
				}
			}

			step.output = current.replace(findPattern, rule.replace);
		} catch (e) {
			step.error = e.message;
		}

		steps.push(step);
		current = step.output;
	});

	return { steps, finalAfterRules: current };
}

function escapeHtml(text) {
	const div = document.createElement('div');
	div.textContent = text;
	return div.innerHTML;
}

function renderBreakdown(breakdown, settings) {
	const container = document.querySelector('.remix-breakdown-output');
	if (!container) return;

	if (breakdown.steps.length === 0) {
		container.innerHTML = '<div class="remix-breakdown-empty">Add rules and enter preview text to see the breakdown.</div>';
		return;
	}

	let html = '';

	breakdown.steps.forEach(step => {
		html += '<div class="remix-rule-step">';

		// Rule label with pattern info
		const patternDisplay = escapeHtml(step.find);
		const flags = [];
		if (step.isRegex) flags.push('regex');
		if (step.ignoreCase) flags.push('case-insensitive');
		const flagsStr = flags.length ? ' <span class="remix-rule-flags">(' + flags.join(', ') + ')</span>' : '';

		html += '<div class="remix-rule-label">Rule ' + step.ruleIndex + ': Find "' + patternDisplay + '"' + flagsStr + '</div>';

		if (step.error) {
			html += '<div class="remix-rule-error">⚠ Invalid regex: ' + escapeHtml(step.error) + '</div>';
		} else if (step.matches.length === 0) {
			html += '<div class="remix-rule-no-match">No matches</div>';
		} else {
			const matchList = step.matches.map(m => '"<span class="remix-match-highlight">' + escapeHtml(m) + '</span>"').join(', ');
			html += '<div class="remix-rule-matches">Matches: ' + matchList + '</div>';
			html += '<div class="remix-rule-result">After: ' + escapeHtml(step.output) + '</div>';
		}

		html += '</div>';
	});

	// Show text transform step if not 'none'
	if (settings.textTransform !== 'none') {
		let transformed = breakdown.finalAfterRules;
		switch (settings.textTransform) {
			case 'lowercase': transformed = transformed.toLowerCase(); break;
			case 'uppercase': transformed = transformed.toUpperCase(); break;
			case 'titlecase': transformed = transformed.toLowerCase().replace(/(?:^|\s|-)\w/g, m => m.toUpperCase()); break;
		}
		html += '<div class="remix-breakdown-final">After text transform (' + settings.textTransform + '): ' + escapeHtml(transformed) + '</div>';
	}

	// Show prepend/append if set
	if (settings.prepend || settings.append) {
		let final = breakdown.finalAfterRules;
		if (settings.textTransform !== 'none') {
			switch (settings.textTransform) {
				case 'lowercase': final = final.toLowerCase(); break;
				case 'uppercase': final = final.toUpperCase(); break;
				case 'titlecase': final = final.toLowerCase().replace(/(?:^|\s|-)\w/g, m => m.toUpperCase()); break;
			}
		}
		final = settings.prepend + final + settings.append;
		html += '<div class="remix-breakdown-final">With prepend/append: ' + escapeHtml(final) + '</div>';
	}

	container.innerHTML = html;
}

// --- Inline Regex Validation ---
function validateRegexInline(textarea, isRegex) {
	// Remove existing error
	const existingError = textarea.parentNode.querySelector('.remix-inline-error');
	if (existingError) existingError.remove();

	if (!isRegex || !textarea.value) {
		textarea.style.borderColor = '';
		return;
	}

	try {
		new RegExp(textarea.value);
		textarea.style.borderColor = '';
	} catch (e) {
		textarea.style.borderColor = '#cf1124';
		const errorEl = document.createElement('span');
		errorEl.className = 'remix-inline-error';
		errorEl.textContent = e.message;
		textarea.parentNode.appendChild(errorEl);
	}
}

// --- Helper: find inputs in a row by column handle ---
// Craft's editableTable with named cols generates input names like:
//   findReplaceRules[rowN][find], findReplaceRules[rowN][replace], etc.
// We locate inputs by their name attribute ending with the column handle.
function getRowInputs(row) {
	const findInput = row.querySelector('textarea[name$="[find]"]') || row.querySelector('input[name$="[find]"]');
	const replaceInput = row.querySelector('textarea[name$="[replace]"]') || row.querySelector('input[name$="[replace]"]');
	const ignoreCaseInput = row.querySelector('input[name$="[ignoreCase]"]');
	const regexInput = row.querySelector('input[name$="[regex]"]');
	return { findInput, replaceInput, ignoreCaseInput, regexInput };
}

// --- DOM Setup ---
const templateButtons = document.querySelectorAll('.remix-templates button');
const remixFindReplaceRulesContainer = document.querySelector('.remix-find-replace-rules');
const addRuleButton = document.querySelector('.remix-find-replace-rules button.add');
const textTransformGroup = document.querySelector('.remix-transform-buttons');
const textTransformContainer = textTransformGroup ? textTransformGroup.closest('.field') : null;
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
						const { findInput, replaceInput, ignoreCaseInput, regexInput } = getRowInputs(row);

						if (findInput && replaceInput && ignoreCaseInput && regexInput) {
								const find = findInput.value;
								const replace = replaceInput.value;
								const ignoreCase = ignoreCaseInput.checked;
								const regex = regexInput.checked;

								if (find) {
										remixSettings.findReplaceRules.push({ find, replace, ignoreCase, regex });
								}

								// Inline regex validation
								validateRegexInline(findInput, regex);
						} else {
								console.warn("Remix: Could not find all inputs in a find/replace row.", row);
						}
			});

			// Update Text Transform (button group uses a hidden input)
			const transformInput = textTransformContainer ? textTransformContainer.querySelector('input[type="hidden"]') : null;
			remixSettings.textTransform = transformInput ? transformInput.value : 'none';

			// Update Prepend/Append
			remixSettings.prepend = prependInput.value;
			remixSettings.append = appendInput.value;
	}

	// Updates settings, refresh preview and breakdown
	function updatePreview() {
			updateRemixSettingsFromDOM();
			const inputText = previewInput.value;
			const outputText = applyRemixTransformations(inputText, remixSettings);
			previewOutput.textContent = outputText;

			// Generate and render the rule-by-rule breakdown
			const breakdown = generateRuleBreakdown(inputText, remixSettings);
			renderBreakdown(breakdown, remixSettings);
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
											const { findInput, replaceInput, ignoreCaseInput, regexInput } = getRowInputs(lastRow);

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
			if (event.target.matches('textarea, input[type="checkbox"], input[type="text"]') && event.target.closest('tr')) {
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

	// Button group: listen for clicks on transform buttons
	if (textTransformContainer) {
			textTransformContainer.addEventListener('click', (event) => {
					if (event.target.closest('.btngroup button, .btngroup .btn')) {
							// Small delay to let Craft's Listbox update the hidden input
							setTimeout(updatePreview, 10);
					}
			});
	}

	prependInput.addEventListener('input', updatePreview);
	appendInput.addEventListener('input', updatePreview);

	previewInput.addEventListener('input', updatePreview);

	updatePreview();
}
