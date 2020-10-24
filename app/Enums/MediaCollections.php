<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static ProfilePicture()
 */
final class MediaCollections extends Enum
{
    const CompanyDocuments = 'company_documents';
    const VideoCurriculum = 'video_curriculum';
    const ProfilePicture = 'profile_picture';
    const FeaturedImage = 'featured_image';
    const Logo = 'logo';
}
