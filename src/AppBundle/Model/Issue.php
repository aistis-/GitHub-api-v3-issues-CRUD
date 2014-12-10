<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Issue model.
 */
class Issue
{
    /**
     * Available issue states.
     */
    const STATE_OPEN    = 'open';
    const STATE_CLOSED  = 'closed';

    /**
     * Issue number.
     *
     * @var string
     */
    private $number;

    /**
     * Issue title.
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * Issue body.
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * Issue state.
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $state;

    /**
     * Issue create datetime stamp.
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Issue update datetime stamp.
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Issue
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get created at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at.
     *
     * @param \DateTime $createdAt
     *
     * @return Issue
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number.
     *
     * @param string $number
     *
     * @return Issue
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param string $state
     *
     * @return Issue
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Issue
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get updated at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updated at.
     *
     * @param \DateTime $updatedAt
     *
     * @return Issue
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
