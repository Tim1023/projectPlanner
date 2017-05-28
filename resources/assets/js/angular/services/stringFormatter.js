function StringFormatter()
{
	function formatNumber(value, maxDigits)
	{
		if (!value)
		{
			return applyNumberFormat(0);
		}

		var absValue = Math.abs(value);

		if (absValue >= 100000000000)
		{
			//123B
			return applyNumberFormat(value / 1000000000, maxDigits - 3) + 'B';
		}
		if (absValue >= 10000000000)
		{
			//12.3B
			return applyNumberFormat(value / 1000000000, maxDigits - 2) + 'B';
		}
		if (absValue >= 1000000000)
		{
			//1.23B
			return applyNumberFormat(value / 1000000000, maxDigits - 1) + 'B';
		}

		if (absValue >= 100000000)
		{
			//123M
			return applyNumberFormat(value / 1000000, maxDigits - 3) + 'M';
		}
		if (absValue >= 10000000)
		{
			//12.3M
			return applyNumberFormat(value / 1000000, maxDigits - 2) + 'M';
		}
		if (absValue >= 1000000)
		{
			//1.23M
			return applyNumberFormat(value / 1000000, maxDigits - 1) + 'M';
		}

		if (absValue >= 100000)
		{
			//123K
			return applyNumberFormat(value / 1000, maxDigits - 3) + 'K';
		}
		if (absValue >= 10000)
		{
			//12.3K
			return applyNumberFormat(value / 1000, maxDigits - 2) + 'K';
		}
		if (absValue >= 1000)
		{
			//1.23K
			return applyNumberFormat(value / 1000, maxDigits - 1) + 'K';
		}

		return applyNumberFormat(value, 2);
	}

	function applyNumberFormat(value, decimalPlaces)
	{
		return parseFloat(value.toFixed(decimalPlaces));
	}

	return {
		formatAsShortCurrency: function(value, maxDigits)
		{
			if (!maxDigits)
			{
				maxDigits = 3;
			}
			return '$' + formatNumber(value, maxDigits);
		},

		formatAsShortNumber: function(value, maxDigits)
		{
			if (!maxDigits)
			{
				maxDigits = 3;
			}
			return formatNumber(value, maxDigits);
		}
	}
}

//expose this as a service you can inject into your controllers
programPlannerModule.factory('stringFormatter', [StringFormatter]);

//and as a filter you can use in your angular markup
programPlannerModule.filter('shortCurrency', ['stringFormatter', function(stringFormatter)
{
	return function(input)
	{
		return stringFormatter.formatAsShortCurrency(input);
	}
}]);