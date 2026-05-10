<?php

namespace QuickPOS\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Page Load / File Existence Tests
 *
 * Jira tickets covered:
 *   SPMPR-27 — index.php file must exist
 *   SPMPR-27 — contact.php file must exist
 *   SPMPR-27 — thankyou.php file must exist
 *   SPMPR-27 — index.php must contain all required section IDs
 */
class PageLoadTest extends TestCase
{
    // ----------------------------------------------------------------
    // SPMPR-27 — core PHP files must exist
    // ----------------------------------------------------------------
    public function testIndexFileExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../index.php',
            'index.php must exist in the project root'
        );
    }

    public function testContactFileExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../contact.php',
            'contact.php must exist in the project root'
        );
    }

    public function testThankyouFileExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../thankyou.php',
            'thankyou.php must exist in the project root'
        );
    }

    // ----------------------------------------------------------------
    // SPMPR-27 — index.php must contain all required section IDs
    // ----------------------------------------------------------------
    public function testIndexContainsAllRequiredSections(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');

        $this->assertStringContainsString('id="features"', $content, 'Features section must exist');
        $this->assertStringContainsString('id="pricing"',  $content, 'Pricing section must exist');
        $this->assertStringContainsString('id="contact"',  $content, 'Contact section must exist');
    }

    // ----------------------------------------------------------------
    // SPMPR-27 — contact form must POST to contact.php
    // ----------------------------------------------------------------
    public function testContactFormActionIsCorrect(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');

        $this->assertStringContainsString('action="contact.php"', $content, 'Form must POST to contact.php');
        $this->assertStringContainsString('method="POST"',         $content, 'Form method must be POST');
    }

    // ----------------------------------------------------------------
    // SPMPR-27 — FormValidator class file must exist
    // ----------------------------------------------------------------
    public function testFormValidatorClassExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../src/FormValidator.php',
            'FormValidator.php must exist in src/'
        );
    }
}
