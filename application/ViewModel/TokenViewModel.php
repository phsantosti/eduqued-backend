<?php

namespace Application\ViewModel;

/**
 * Class Token View Model
 */
class TokenViewModel
{
    /**
     * @var string
     */
    private string $type;
    /**
     * @var string
     */
    private string $token;

    /**
     * @param string $type
     * @param string $token
     */
    public function __construct(string $type, string $token)
    {
        $this->type = $type;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}