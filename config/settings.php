<?php

return [
    'currencies' => [
        ['code' => 'USD', 'symbol' => '$', 'name' => 'US Dollar'],
        ['code' => 'EUR', 'symbol' => '€', 'name' => 'Euro'],
        ['code' => 'GBP', 'symbol' => '£', 'name' => 'British Pound'],
        ['code' => 'JPY', 'symbol' => '¥', 'name' => 'Japanese Yen'],
        ['code' => 'AUD', 'symbol' => 'A$', 'name' => 'Australian Dollar'],
        ['code' => 'CAD', 'symbol' => 'C$', 'name' => 'Canadian Dollar'],
        ['code' => 'CHF', 'symbol' => 'CHF', 'name' => 'Swiss Franc'],
        ['code' => 'CNY', 'symbol' => '¥', 'name' => 'Chinese Yuan'],
        ['code' => 'SEK', 'symbol' => 'kr', 'name' => 'Swedish Krona'],
        ['code' => 'NZD', 'symbol' => 'NZ$', 'name' => 'New Zealand Dollar'],
        ['code' => 'INR', 'symbol' => '₹', 'name' => 'Indian Rupee'],
        ['code' => 'BRL', 'symbol' => 'R$', 'name' => 'Brazilian Real'],
        ['code' => 'ZAR', 'symbol' => 'R', 'name' => 'South African Rand'],
        ['code' => 'RUB', 'symbol' => '₽', 'name' => 'Russian Ruble'],
        ['code' => 'HKD', 'symbol' => 'HK$', 'name' => 'Hong Kong Dollar'],
        ['code' => 'SGD', 'symbol' => 'S$', 'name' => 'Singapore Dollar'],
        ['code' => 'NOK', 'symbol' => 'kr', 'name' => 'Norwegian Krone'],
        ['code' => 'MXN', 'symbol' => '$', 'name' => 'Mexican Peso'],
        ['code' => 'IDR', 'symbol' => 'Rp', 'name' => 'Indonesian Rupiah'],
        ['code' => 'TRY', 'symbol' => '₺', 'name' => 'Turkish Lira'],
        ['code' => 'KRW', 'symbol' => '₩', 'name' => 'South Korean Won'],
        ['code' => 'THB', 'symbol' => '฿', 'name' => 'Thai Baht'],
        ['code' => 'SAR', 'symbol' => '﷼', 'name' => 'Saudi Riyal'],
        ['code' => 'AED', 'symbol' => 'د.إ', 'name' => 'UAE Dirham'],
        ['code' => 'PLN', 'symbol' => 'zł', 'name' => 'Polish Zloty'],
        ['code' => 'EGP', 'symbol' => '£', 'name' => 'Egyptian Pound'],
        ['code' => 'MYR', 'symbol' => 'RM', 'name' => 'Malaysian Ringgit'],
        ['code' => 'PKR', 'symbol' => '₨', 'name' => 'Pakistani Rupee'],
    ],

    'timezones' => [
        [
            'name' => 'Africa',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::AFRICA),
        ],
        [
            'name' => 'America',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::AMERICA),
        ],
        [
            'name' => 'Asia',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::ASIA),
        ],
        [
            'name' => 'Atlantic',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::ATLANTIC),
        ],
        [
            'name' => 'Australia',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::AUSTRALIA),
        ],
        [
            'name' => 'Europe',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::EUROPE),
        ],
        [
            'name' => 'Indian',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::INDIAN),
        ],
        [
            'name' => 'Pacific',
            'value' => DateTimeZone::listIdentifiers(DateTimeZone::PACIFIC),
        ],
    ],

];
