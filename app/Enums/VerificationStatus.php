<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static Nil()
 * @method static Pending()
 * @method static Processing()
 * @method static Approved()
 * @method static Declined()
 */
final class VerificationStatus extends Enum
{
    const Nil = 'nil';
    const Pending = 'pending';
    const Processing = 'processing';
    const Approved = 'approved';
    const Declined = 'declined';
}
