<?php

namespace App\Dto\V1;

use Symfony\Component\Validator\Constraints as Assert;

class UserDto
{
    #[Assert\NotBlank]
    public string $email;
}
