<?php

namespace QuickPOS\Tests;

use PHPUnit\Framework\TestCase;
use QuickPOS\FormValidator;

/**
 * Contact Form Validation Tests
 *
 * Jira tickets covered:
 *   SPMPR-22 — test fails when name is empty
 *   SPMPR-23 — test fails when email is empty
 *   SPMPR-24 — test fails for invalid email format
 *   SPMPR-25 — test passes when all fields are valid   (Sprint 2)
 *   SPMPR-26 — test fails when all fields are empty    (Sprint 2)
 */
class ContactFormTest extends TestCase
{
    private FormValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new FormValidator();
    }

    // ----------------------------------------------------------------
    // SPMPR-22 — empty name must fail
    // ----------------------------------------------------------------
    public function testEmptyNameFails(): void
    {
        $data = [
            'name'    => '',
            'email'   => 'test@example.com',
            'message' => 'Hello there',
        ];

        $result = $this->validator->validate($data);

        $this->assertFalse($result, 'Validation should fail when name is empty');
        $this->assertArrayHasKey('name', $this->validator->getErrors());
    }

    // ----------------------------------------------------------------
    // SPMPR-23 — empty email must fail
    // ----------------------------------------------------------------
    public function testEmptyEmailFails(): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => '',
            'message' => 'Hello there',
        ];

        $result = $this->validator->validate($data);

        $this->assertFalse($result, 'Validation should fail when email is empty');
        $this->assertArrayHasKey('email', $this->validator->getErrors());
    }

    // ----------------------------------------------------------------
    // SPMPR-24 — invalid email format must fail
    // ----------------------------------------------------------------
    public function testInvalidEmailFormatFails(): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => 'not-a-valid-email',
            'message' => 'Hello there',
        ];

        $result = $this->validator->validate($data);

        $this->assertFalse($result, 'Validation should fail for invalid email format');
        $this->assertArrayHasKey('email', $this->validator->getErrors());
    }

    // ----------------------------------------------------------------
    // SPMPR-25 — valid data must pass (success case)
    // ----------------------------------------------------------------
    public function testValidDataPasses(): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => 'john@example.com',
            'message' => 'I am interested in QuickPOS',
        ];

        $result = $this->validator->validate($data);

        $this->assertTrue($result, 'Validation should pass when all fields are valid');
        $this->assertEmpty($this->validator->getErrors());
    }

    // ----------------------------------------------------------------
    // SPMPR-26 — all empty fields must fail with exactly 3 errors
    // ----------------------------------------------------------------
    public function testAllEmptyFieldsFail(): void
    {
        $data = [
            'name'    => '',
            'email'   => '',
            'message' => '',
        ];

        $result = $this->validator->validate($data);

        $this->assertFalse($result, 'Validation should fail when all fields are empty');
        $this->assertCount(3, $this->validator->getErrors(), 'Should have exactly 3 error messages');
    }

    // ----------------------------------------------------------------
    // SPMPR-24 (data-driven) — multiple invalid email formats
    // ----------------------------------------------------------------
    /**
     * @dataProvider invalidEmailProvider
     */
    public function testMultipleInvalidEmailFormats(string $email): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => $email,
            'message' => 'Hello there',
        ];

        $result = $this->validator->validate($data);

        $this->assertFalse($result, "Email '{$email}' should be invalid");
        $this->assertArrayHasKey('email', $this->validator->getErrors());
    }

    public static function invalidEmailProvider(): array
    {
        return [
            'missing @'        => ['johndoe.com'],
            'missing domain'   => ['john@'],
            'missing local'    => ['@example.com'],
            'has spaces'       => ['john doe@example.com'],
            'double @'         => ['john@@example.com'],
        ];
    }
}
