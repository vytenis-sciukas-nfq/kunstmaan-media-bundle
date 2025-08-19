<?php

namespace Kunstmaan\MediaBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface HasTranslationsInterface
{
    /**
     * @return Collection|TranslationInterface[]
     */
    public function getTranslations(): array|Collection;
    public function addTranslation(TranslationInterface $t): void;
}
