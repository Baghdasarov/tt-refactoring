<?php

namespace TestRefactor\Entity;

enum Country: string
{

    case AT = 'AT';
    case BE = 'BE';
    case BG = 'BG';
    case CY = 'CY';
    case CZ = 'CZ';
    case DE = 'DE';
    case DK = 'DK';
    case EE = 'EE';
    case ES = 'ES';
    case FI = 'FI';
    case FR = 'FR';
    case GR = 'GR';
    case HR = 'HR';
    case HU = 'HU';
    case IE = 'IE';
    case IT = 'IT';
    case LT = 'LT';
    case LU = 'LU';
    case LV = 'LV';
    case MT = 'MT';
    case NL = 'NL';
    case PO = 'PO';
    case PT = 'PT';
    case RO = 'RO';
    case SE = 'SE';
    case SI = 'SI';
    case SK = 'SK';

    /**
     * Check if the provided country is in the EU
     */
    public static function isInEu(string $country): bool
    {
        return in_array($country, [
            self::AT, self::BE, self::BG,
            self::CY, self::CZ, self::DE,
            self::DK, self::EE, self::ES,
            self::FI, self::FR, self::GR,
            self::HR, self::HU, self::IE,
            self::IT, self::LT, self::LU,
            self::LV, self::MT, self::NL,
            self::PO, self::PT, self::RO,
            self::SE, self::SI, self::SK,
        ]);
    }

}
