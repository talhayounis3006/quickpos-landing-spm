<?php

namespace QuickPOS;

class FormValidator
{
    private array $errors = [];

    public function validate(array $data): bool
    {
        $this->errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $this->errors['name'] = 'Name is required.';
        }

        if (empty(trim($data['email'] ?? ''))) {
            $this->errors['email'] = 'Email is required.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if (empty(trim($data['message'] ?? ''))) {
            $this->errors['message'] = 'Message is required.';
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
