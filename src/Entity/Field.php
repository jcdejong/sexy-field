<?php

/*
 * This file is part of the SexyField package.
 *
 * (c) Dion Snoeijen <hallo@dionsnoeijen.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types = 1);

namespace Tardigrades\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tardigrades\SectionField\ValueObject\Created;
use Tardigrades\SectionField\ValueObject\FieldConfig;
use Tardigrades\SectionField\ValueObject\Handle;
use Tardigrades\SectionField\ValueObject\Id;
use Tardigrades\SectionField\ValueObject\Label;
use Tardigrades\SectionField\ValueObject\Name;
use Tardigrades\SectionField\ValueObject\Updated;

class Field implements FieldInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $label;

    /** @var string */
    protected $handle;

    /** @var ArrayCollection */
    protected $sections;

    /** @var FieldType */
    protected $fieldType;

    /** @var array */
    protected $config;

    /** @var \DateTime */
    protected $created;

    /** @var \DateTime */
    protected $updated;

    public function __construct(
        Collection $sections = null
    ) {
        $this->sections = is_null($sections) ? new ArrayCollection() : $sections;
    }

    public function setId(int $id): FieldInterface
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setHandle(string $handle): FieldInterface
    {
        $this->handle = $handle;

        return $this;
    }

    public function getName(): Name
    {
        return Name::fromString($this->name);
    }

    public function setName(string $name): FieldInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): Label
    {
        return Label::fromString($this->label);
    }

    public function setLabel(string $label): FieldInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getHandle(): Handle
    {
        return Handle::fromString($this->handle);
    }

    public function getIdValueObject(): Id
    {
        return Id::fromInt($this->id);
    }

    public function addSection(SectionInterface $section): FieldInterface
    {
        if ($this->sections->contains($section)) {
            return $this;
        }
        $this->sections->add($section);
        $section->addField($this);

        return $this;
    }

    public function removeSection(SectionInterface $section): FieldInterface
    {
        if (!$this->sections->contains($section)) {
            return $this;
        }
        $this->sections->removeElement($section);
        $section->removeField($this);

        return $this;
    }

    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function setFieldType(FieldTypeInterface $fieldType): FieldInterface
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    public function removeFieldType(FieldTypeInterface $fieldType): FieldInterface
    {
        $this->fieldType = null;

        return $this;
    }

    public function getFieldType(): FieldTypeInterface
    {
        return $this->fieldType;
    }

    public function setConfig(array $config): FieldInterface
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig(): FieldConfig
    {
        return FieldConfig::fromArray((array) $this->config);
    }

    public function setCreated(\DateTime $created): FieldInterface
    {
        $this->created = $created;

        return $this;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function getCreatedValueObject(): Created
    {
        return Created::fromDateTime($this->created);
    }

    public function setUpdated(\DateTime $updated): FieldInterface
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    public function getUpdatedValueObject(): Updated
    {
        return Updated::fromDateTime($this->updated);
    }

    public function onPrePersist(): void
    {
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
    }

    public function onPreUpdate(): void
    {
        $this->updated = new \DateTime("now");
    }
}
