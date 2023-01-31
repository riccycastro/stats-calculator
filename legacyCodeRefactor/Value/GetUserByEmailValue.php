<?php

namespace App\Value;

use App\Handler\Param\RequestParam;
use Webmozart\Assert\Assert;

final class GetUserByEmailValue
{
    private string $email;

    private function __construct(string $email)
    {
        Assert::email($email);

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public static function fromRequestParam(RequestParam $requestParam): self
    {
        return new self($requestParam->getMasterEmail());
    }
}
