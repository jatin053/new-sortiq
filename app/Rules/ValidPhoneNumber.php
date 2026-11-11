<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (blank($value)) {
            return;
        }

        $phone = preg_replace('/\D/', '', (string) $value);
        $rawCountryCode = (string) ($this->data['country_code'] ?? '91');
        $dialCode = preg_replace('/\D/', '', $rawCountryCode);
        if ($dialCode === '') {
            $dialCode = '91';
        }

        $length = strlen($phone);

        // 1. India (+91)
        if ($dialCode === '91') {
            if ($length !== 10 || !preg_match('/^[6-9][0-9]{9}$/', $phone)) {
                $fail('The phone number must be a valid 10-digit Indian phone number starting with 6, 7, 8, or 9.');
            }
            return;
        }

        // 2. Known Country Phone Lengths
        $knownLengths = [
            '1'   => [10],           // USA, Canada
            '7'   => [10],           // Russia, Kazakhstan
            '20'  => [10],           // Egypt
            '27'  => [9],            // South Africa
            '30'  => [10],           // Greece
            '31'  => [9],            // Netherlands
            '32'  => [9],            // Belgium
            '33'  => [9],            // France
            '34'  => [9],            // Spain
            '36'  => [9],            // Hungary
            '39'  => [9, 10],        // Italy
            '40'  => [9],            // Romania
            '41'  => [9],            // Switzerland
            '43'  => [10, 11],       // Austria
            '44'  => [10, 11],       // UK
            '45'  => [8],            // Denmark
            '46'  => [9],            // Sweden
            '47'  => [8],            // Norway
            '48'  => [9],            // Poland
            '49'  => [10, 11],       // Germany
            '51'  => [9],            // Peru
            '52'  => [10],           // Mexico
            '54'  => [10],           // Argentina
            '55'  => [10, 11],       // Brazil
            '56'  => [9],            // Chile
            '57'  => [10],           // Colombia
            '60'  => [9, 10],        // Malaysia
            '61'  => [9],            // Australia
            '62'  => [10, 11, 12],   // Indonesia
            '63'  => [10],           // Philippines
            '64'  => [8, 9, 10],     // New Zealand
            '65'  => [8],            // Singapore
            '66'  => [9],            // Thailand
            '81'  => [10],           // Japan
            '82'  => [9, 10],        // South Korea
            '84'  => [9, 10],        // Vietnam
            '86'  => [11],           // China
            '90'  => [10],           // Turkey
            '92'  => [10],           // Pakistan
            '93'  => [9],            // Afghanistan
            '94'  => [9],            // Sri Lanka
            '95'  => [8, 9, 10],     // Myanmar
            '98'  => [10],           // Iran
            '212' => [9],            // Morocco
            '213' => [9],            // Algeria
            '216' => [8],            // Tunisia
            '233' => [9],            // Ghana
            '234' => [10],           // Nigeria
            '254' => [9],            // Kenya
            '351' => [9],            // Portugal
            '352' => [9],            // Luxembourg
            '353' => [9],            // Ireland
            '354' => [7],            // Iceland
            '355' => [9],            // Albania
            '356' => [8],            // Malta
            '357' => [8],            // Cyprus
            '358' => [9, 10],        // Finland
            '359' => [8, 9],         // Bulgaria
            '370' => [8],            // Lithuania
            '371' => [8],            // Latvia
            '372' => [7, 8],         // Estonia
            '380' => [9],            // Ukraine
            '381' => [8, 9],         // Serbia
            '385' => [8, 9],         // Croatia
            '420' => [9],            // Czech Republic
            '421' => [9],            // Slovakia
            '852' => [8],            // Hong Kong
            '880' => [10],           // Bangladesh
            '886' => [9],            // Taiwan
            '961' => [7, 8],         // Lebanon
            '962' => [9],            // Jordan
            '964' => [10],           // Iraq
            '965' => [8],            // Kuwait
            '966' => [9],            // Saudi Arabia
            '968' => [8],            // Oman
            '971' => [9],            // UAE
            '972' => [9],            // Israel
            '973' => [8],            // Bahrain
            '974' => [8],            // Qatar
            '977' => [10],           // Nepal
        ];

        if (isset($knownLengths[$dialCode])) {
            if (!in_array($length, $knownLengths[$dialCode], true)) {
                $allowed = implode(' or ', $knownLengths[$dialCode]);
                $fail("The phone number does not match the selected country (+{$dialCode}). It must be {$allowed} digits.");
                return;
            }
        } elseif ($length < 6 || $length > 15) {
            $fail("The phone number must be between 6 and 15 digits for the selected country (+{$dialCode}).");
            return;
        }
    }
}

