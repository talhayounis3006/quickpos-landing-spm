# QuickPOS Landing Page

![CI Pipeline](https://github.com/talhayounis3006/quickpos-landing-spm/actions/workflows/ci.yml/badge.svg)

> **SPM Course Project** — A professional landing page for the QuickPOS Point of Sale system,
> built with PHP, tested with PHPUnit, and automated with a GitHub Actions CI/CD pipeline.

---

## Team

| Name | Role |
|------|------|
| Maleeha Saleem (23F-3018) | Project Manager & QA |
| Talha Younas (23F-3006) | Tech Lead |

---

## Project Structure

```
quickpos-landing/
├── .github/
│   └── workflows/
│       └── ci.yml          ← GitHub Actions CI/CD pipeline
├── src/
│   └── FormValidator.php   ← PHP form validation class
├── tests/
│   ├── ContactFormTest.php ← PHPUnit tests for form validation
│   └── PageLoadTest.php    ← PHPUnit tests for page structure
├── index.php               ← Main landing page (all 6 sections)
├── contact.php             ← Form POST handler + PHP redirect
├── thankyou.php            ← Thank-you page after form submission
├── composer.json           ← PHP dependencies
├── phpunit.xml             ← PHPUnit configuration
├── phpstan.neon            ← PHPStan code quality configuration
└── README.md
```

---

## How to Run Locally

**Requirements:** PHP 8.0+, Composer

```bash
# 1. Clone the repository
git clone https://github.com/talhayounis3006/quickpos-landing-spm.git
cd quickpos-landing

# 2. Install dependencies
composer install

# 3. Start the PHP development server
php -S localhost:8000

# 4. Open in your browser
# Visit: http://localhost:8000
```

---

## How to Run Tests

```bash
# Run all tests with readable output
./vendor/bin/phpunit --testdox

# Run PHPStan code quality check
./vendor/bin/phpstan analyse --no-progress

# Run PHP syntax check on all files
find . -name "*.php" -not -path "./vendor/*" -exec php -l {} \;
```

---

## CI/CD Pipeline Stages

| Stage | Description |
|-------|-------------|
| Stage 1  | Checkout code |
| Stage 2  | Setup PHP 8.3 |
| Stage 3  | PHPStan static analysis |
| Stage 4  | PHPUnit automated tests |
| Stage 5  | PHP syntax check |
| Stage 6  | Upload test results artifact |
| Stage 7  | Status badge in README |
| Stage 8  | PR blocked if any check fails |
| Stage 9  | Branch protection — PR review required |
| Stage 10 | Commit message must contain `[SPMPR-xxx]` |
| Stage 11 | Code quality & tests run in **parallel** |

---

## Jira Project

Project Key: **SPMPR**  
All commits follow the format: `[SPMPR-XX] Description of change`
