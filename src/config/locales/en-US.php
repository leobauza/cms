<?php

return [
	'textAttributes' => [
		'positivePrefix' => '',
		'positiveSuffix' => '',
		'negativePrefix' => '-',
		'negativeSuffix' => '',
		'paddingCharacter' => '*',
		'currencyCode' => '',
		'defaultRuleset' => '',
		'publicRulesets' => '',
	],
	'numberSymbols' => [
		'decimalSeparator' => '.',
		'groupingSeparator' => ',',
		'patternSeparator' => ';',
		'percent' => '%',
		'zeroDigit' => '0',
		'digit' => '#',
		'minusSign' => '-',
		'plusSign' => '+',
		'currency' => '$',
		'intlCurrency' => 'USD',
		'monetarySeparator' => '.',
		'exponential' => 'E',
		'permill' => '‰',
		'padEscape' => '*',
		'infinity' => '∞',
		'nan' => 'NaN',
		'significantDigit' => '@',
		'monetaryGroupingSeparator' => ',',
	],
	'dateFormats' => [
		'short' => [
			'date' => 'n/j/y',
			'time' => 'H:i',
			'datetime' => 'n/j/y H:i',
		],
		'medium' => [
			'date' => 'M j, Y',
			'time' => 'g:i:s A',
			'datetime' => 'M j, Y g:i:s A',
		],
		'long' => [
			'date' => 'F j, Y',
			'time' => 'g:i:sA',
			'datetime' => 'F j, Y g:i:sA',
		],
		'full' => [
			'date' => 'l, F j, Y',
			'time' => 'g:i:sA T',
			'datetime' => 'l, F j, Y g:i:sA T',
		],
	],
];
