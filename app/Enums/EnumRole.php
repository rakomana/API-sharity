<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static FilePrimaryAdmin()
 * @method static CompanyPrimaryAdmin()
 */
final class EnumRole extends Enum
{
    const FilePrimaryAdmin = 'FilePrimaryAdmin';
    const CompanyPrimaryAdmin = 'CompanyPrimaryAdmin';
}
