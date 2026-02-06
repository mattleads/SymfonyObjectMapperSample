<?php

namespace App\Controller;

use App\Dto\ApiUserDto;
use App\Dto\EventDto;
use App\Dto\UserDto;
use App\Dto\UserDtoV1;
use App\Dto\UserProfileDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/mapping')]
class MappingController extends AbstractController
{
    public function __construct(
        private readonly ObjectMapperInterface $objectMapper
    ) {
    }

    #[Route('/immutable', name: 'app_immutable')]
    public function immutableDto(): Response
    {
        $userData = [
            'id' => 123,
            'email' => 'contact@example.com',
            'isActive' => true,
        ];

        $userDto = $this->objectMapper->map((object)$userData, UserDto::class);

        return $this->render('mapping/dump.html.twig', ['result' => $userDto]);
    }

    #[Route('/nested', name: 'app_nested')]
    public function nestedObjects(): Response
    {
        $payload = [
            'userId' => 42,
            'username' => 'symfonylead',
            'shippingAddress' => [
                'street' => '123 Symfony Ave',
                'city' => 'Paris',
            ],
            'posts' => [
                ['postId' => 101, 'title' => 'Mastering ObjectMapper'],
                ['postId' => 102, 'title' => 'Advanced Normalizers'],
            ],
        ];

        $userProfile = $this->objectMapper->map((object)$payload, UserProfileDto::class);

        return $this->render('mapping/dump.html.twig', ['result' => $userProfile]);
    }

    #[Route('/normalizer', name: 'app_normalizer')]
    public function customNormalizer(): Response
    {
        $data = [
            'name' => 'Symfony Conference',
            'startTime' => '2025-10-18T18:15:00+04:00'
        ];

        $eventDto = $this->objectMapper->map((object)$data, EventDto::class);

        return $this->render('mapping/dump.html.twig', ['result' => $eventDto]);
    }

    #[Route('/naming', name: 'app_naming')]
    public function namingConvention(): Response
    {
        $data = [
            'user_id' => 99,
            'first_name' => 'Jane',
            'last_name' => 'Doe'
        ];

        $apiUser = $this->objectMapper->map((object)$data, ApiUserDto::class);

        return $this->render('mapping/dump.html.twig', ['result' => $apiUser]);
    }

    #[Route('/validation', name: 'app_validation')]
    public function validation(ValidatorInterface $validator): Response
    {
        $rawData = ['email' => 'invalid-email', 'name' => 'J'];
        $userDto = $this->objectMapper->map((object)$rawData, UserDtoV1::class);
        $violations = $validator->validate($userDto);

        $errors = [];
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath().': '.$violation->getMessage();
            }
        }

        $rawDataValid = ['email' => 'valid@email.com', 'name' => 'John Doe'];
        $userDtoValid = $this->objectMapper->map((object)$rawDataValid, UserDtoV1::class);
        $violationsValid = $validator->validate($userDtoValid);

        return $this->render('mapping/validation.html.twig', [
            'dto' => $userDto,
            'errors' => $errors,
            'dto_valid' => $userDtoValid,
            'violations_valid_count' => count($violationsValid),
        ]);
    }

    #[Route('/versioning', name: 'app_versioning')]
    public function versioning(ValidatorInterface $validator): Response
    {
        $dataV1 = ['email' => 'test@example.com'];
        $userDtoV1 = $this->objectMapper->map((object)$dataV1, \App\Dto\V1\UserDto::class);
        $violationsV1 = $validator->validate($userDtoV1);

        $dataV2 = ['email' => 'invalid', 'fullName' => 'Jo'];
        $userDtoV2 = $this->objectMapper->map((object)$dataV2, \App\Dto\V2\UserDto::class);
        $violationsV2 = $validator->validate($userDtoV2);

        $errorsV2 = [];
        if (count($violationsV2) > 0) {
            foreach ($violationsV2 as $violation) {
                $errorsV2[] = $violation->getPropertyPath().': '.$violation->getMessage();
            }
        }

        return $this->render('mapping/versioning.html.twig', [
            'dtoV1' => $userDtoV1,
            'violationsV1_count' => count($violationsV1),
            'dtoV2' => $userDtoV2,
            'errorsV2' => $errorsV2,
        ]);
    }
}
