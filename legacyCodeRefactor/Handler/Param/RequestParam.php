<?php

namespace App\Handler\Param;

class RequestParam
{
    private ?string $masterEmail = null;

    private ?string $email = null;

    public function getMasterEmail(): string
    {
        return $this->email ?? $this->masterEmail;
    }

    public function setMasterEmail(?string $masterEmail): RequestParam
    {
        $this->masterEmail = $masterEmail;

        return $this;
    }

    public function setEmail(?string $email): RequestParam
    {
        $this->email = $email;

        return $this;
    }
}
