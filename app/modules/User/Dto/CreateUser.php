<?php

namespace App\modules\User\Dto;

readonly class CreateUser
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?array $teams,
    ) {}

    /**
     * @param array $validatedData
     * @return self
     */
    public static function fromValidatedRequest(array $validatedData): self
    {
        return new self(
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['password'],
            $validatedData['teams'],
        );
    }
}
