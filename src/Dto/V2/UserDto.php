<?php

namespace App\Dto\V2;

use Symfony\Component\Validator\Constraints as Assert;

class UserDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    public string $fullName;
}
