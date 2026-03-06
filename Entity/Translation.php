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
 *         "locale", "object_id", "field", "domain"
 *     })}
 * )
 */
#[ORM\Entity]
#[ORM\Table(
    name: "kuma_media_translations",
    uniqueConstraints: [
        new ORM\UniqueConstraint(
            name: "lookup_unique_idx",
            columns: ["locale", "object_id", "field", "domain"]
        )
    ]
)]
class Translation extends AbstractPersonalTranslation implements TranslationInterface
{
    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    protected ?string $domain = null;

    public function __construct(string $locale, string $field, ?string $value, ?string $domain = null)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($value);
        $this->setDomain($domain);
    }

    /**
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Media::class, inversedBy: "translations")]
    #[ORM\JoinColumn(name: "object_id", referencedColumnName: "id", onDelete: "CASCADE")]
    protected $object;

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
}
