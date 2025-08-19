<?php
/*
 * @copyright C UAB NFQ Technologies
 *
 * This Software is the property of NFQ Technologies
 * and is protected by copyright law – it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * Contact UAB NFQ Technologies:
 * E-mail: info@nfq.lt
 * http://www.nfq.lt
 *
 */

namespace Kunstmaan\MediaBundle\Entity;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kuma_media_translations",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
#[ORM\Entity]
#[ORM\Table(
    name: "kuma_media_translations",
    uniqueConstraints: [
        new ORM\UniqueConstraint(
            name: "lookup_unique_idx",
            columns: ["locale", "object_id", "field"]
        )
    ]
)]
class Translation extends AbstractPersonalTranslation implements TranslationInterface
{
    public function __construct(string $locale, string $field, ?string $value)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($value);
    }

    /**
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Media::class, inversedBy: "translations")]
    #[ORM\JoinColumn(name: "object_id", referencedColumnName: "id", onDelete: "CASCADE")]
    protected $object;
}
