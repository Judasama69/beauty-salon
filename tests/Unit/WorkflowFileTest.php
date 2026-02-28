<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class WorkflowFileTest extends TestCase
{
    private string $workflowPath;
    private string $workflowContent;

    protected function setUp(): void
    {
        parent::setUp();
        $this->workflowPath = base_path('.github/workflows/laravel.yml');

        if (file_exists($this->workflowPath)) {
            $this->workflowContent = file_get_contents($this->workflowPath);
        }
    }

    /**
     * Test that the workflow file exists.
     */
    public function test_workflow_file_exists(): void
    {
        $this->assertFileExists(
            $this->workflowPath,
            'Laravel workflow file should exist at .github/workflows/laravel.yml'
        );
    }

    /**
     * Test that the workflow file is not empty.
     */
    public function test_workflow_file_is_not_empty(): void
    {
        $this->assertFileExists($this->workflowPath);
        $this->assertNotEmpty($this->workflowContent, 'Workflow file should not be empty');
        $this->assertGreaterThan(100, strlen($this->workflowContent), 'Workflow file should contain substantial content');
    }

    /**
     * Test that the workflow file is readable.
     */
    public function test_workflow_file_is_readable(): void
    {
        $this->assertFileIsReadable($this->workflowPath, 'Workflow file should be readable');
    }

    /**
     * Test that the workflow defines a name.
     */
    public function test_workflow_has_name(): void
    {
        $this->assertStringContainsString('name:', $this->workflowContent, 'Workflow should have a name field');
        $this->assertStringContainsString('name: Laravel', $this->workflowContent, 'Workflow should be named "Laravel"');
    }

    /**
     * Test that the workflow has trigger events.
     */
    public function test_workflow_has_trigger_events(): void
    {
        $this->assertStringContainsString('on:', $this->workflowContent, 'Workflow should define trigger events');
        $this->assertStringContainsString('push:', $this->workflowContent, 'Workflow should trigger on push');
        $this->assertStringContainsString('pull_request:', $this->workflowContent, 'Workflow should trigger on pull requests');
    }

    /**
     * Test that the workflow triggers on main branch.
     */
    public function test_workflow_triggers_on_main_branch(): void
    {
        $this->assertStringContainsString('branches: [ "main" ]', $this->workflowContent, 'Workflow should trigger on main branch');
    }

    /**
     * Test that the workflow defines jobs.
     */
    public function test_workflow_has_jobs(): void
    {
        $this->assertStringContainsString('jobs:', $this->workflowContent, 'Workflow should define jobs');
        $this->assertStringContainsString('laravel-tests:', $this->workflowContent, 'Workflow should have laravel-tests job');
    }

    /**
     * Test that the job runs on Ubuntu.
     */
    public function test_job_runs_on_ubuntu(): void
    {
        $this->assertStringContainsString('runs-on: ubuntu-latest', $this->workflowContent, 'Job should run on ubuntu-latest');
    }

    /**
     * Test that the workflow includes PHP setup.
     */
    public function test_workflow_includes_php_setup(): void
    {
        $this->assertStringContainsString('setup-php', $this->workflowContent, 'Workflow should include PHP setup action');
        $this->assertStringContainsString("php-version: '8.4'", $this->workflowContent, 'Workflow should use PHP 8.4');
    }

    /**
     * Test that the workflow checks out code.
     */
    public function test_workflow_checks_out_code(): void
    {
        $this->assertStringContainsString('actions/checkout@v4', $this->workflowContent, 'Workflow should check out code using checkout@v4');
    }

    /**
     * Test that the workflow copies .env file.
     */
    public function test_workflow_copies_env_file(): void
    {
        $this->assertStringContainsString('Copy .env', $this->workflowContent, 'Workflow should include .env copy step');
        $this->assertStringContainsString('.env.example', $this->workflowContent, 'Workflow should copy from .env.example');
    }

    /**
     * Test that the workflow installs Composer dependencies.
     */
    public function test_workflow_installs_composer_dependencies(): void
    {
        $this->assertStringContainsString('Install Dependencies', $this->workflowContent, 'Workflow should include dependency installation step');
        $this->assertStringContainsString('composer install', $this->workflowContent, 'Workflow should run composer install');
    }

    /**
     * Test that the workflow generates application key.
     */
    public function test_workflow_generates_app_key(): void
    {
        $this->assertStringContainsString('Generate key', $this->workflowContent, 'Workflow should include key generation step');
        $this->assertStringContainsString('php artisan key:generate', $this->workflowContent, 'Workflow should run artisan key:generate');
    }

    /**
     * Test that the workflow includes Node.js setup.
     */
    public function test_workflow_includes_nodejs_setup(): void
    {
        $this->assertStringContainsString('Setup Node.js', $this->workflowContent, 'Workflow should include Node.js setup');
        $this->assertStringContainsString('setup-node', $this->workflowContent, 'Workflow should use setup-node action');
        $this->assertStringContainsString("node-version: '18'", $this->workflowContent, 'Workflow should use Node.js 18');
    }

    /**
     * Test that the workflow installs NPM dependencies.
     */
    public function test_workflow_installs_npm_dependencies(): void
    {
        $this->assertStringContainsString('Install NPM Dependencies', $this->workflowContent, 'Workflow should include NPM installation step');
        $this->assertStringContainsString('npm install', $this->workflowContent, 'Workflow should run npm install');
    }

    /**
     * Test that the workflow builds assets.
     */
    public function test_workflow_builds_assets(): void
    {
        $this->assertStringContainsString('Build Assets', $this->workflowContent, 'Workflow should include asset build step');
        $this->assertStringContainsString('npm run build', $this->workflowContent, 'Workflow should run npm build');
    }

    /**
     * Test that the workflow sets directory permissions.
     */
    public function test_workflow_sets_directory_permissions(): void
    {
        $this->assertStringContainsString('Directory Permissions', $this->workflowContent, 'Workflow should include permissions step');
        $this->assertStringContainsString('chmod -R 777 storage bootstrap/cache', $this->workflowContent, 'Workflow should set storage and cache permissions');
    }

    /**
     * Test that the workflow creates SQLite database.
     */
    public function test_workflow_creates_sqlite_database(): void
    {
        $this->assertStringContainsString('Create Database', $this->workflowContent, 'Workflow should include database creation step');
        $this->assertStringContainsString('database.sqlite', $this->workflowContent, 'Workflow should create SQLite database');
    }

    /**
     * Test that the workflow executes tests.
     */
    public function test_workflow_executes_tests(): void
    {
        $this->assertStringContainsString('Execute tests', $this->workflowContent, 'Workflow should include test execution step');
        $this->assertStringContainsString('php artisan test', $this->workflowContent, 'Workflow should run artisan test command');
    }

    /**
     * Test that the test step uses SQLite database.
     */
    public function test_workflow_test_step_uses_sqlite(): void
    {
        $this->assertStringContainsString('DB_CONNECTION: sqlite', $this->workflowContent, 'Test step should use SQLite connection');
        $this->assertStringContainsString('DB_DATABASE: database/database.sqlite', $this->workflowContent, 'Test step should use correct database path');
    }

    /**
     * Test that the workflow file has proper indentation (YAML requirement).
     */
    public function test_workflow_has_proper_indentation(): void
    {
        $lines = explode("\n", $this->workflowContent);
        $hasIndentation = false;

        foreach ($lines as $line) {
            if (preg_match('/^  \S/', $line)) {
                $hasIndentation = true;
                break;
            }
        }

        $this->assertTrue($hasIndentation, 'Workflow should use proper YAML indentation');
    }

    /**
     * Test that the workflow uses secure action versions (pinned or tagged).
     */
    public function test_workflow_uses_versioned_actions(): void
    {
        $this->assertStringContainsString('setup-php@', $this->workflowContent, 'PHP setup action should be versioned');
        $this->assertStringContainsString('checkout@v4', $this->workflowContent, 'Checkout action should use v4');
        $this->assertStringContainsString('setup-node@v3', $this->workflowContent, 'Node setup action should use v3');
    }

    /**
     * Test that workflow steps are properly ordered (checkout before install).
     */
    public function test_workflow_steps_are_properly_ordered(): void
    {
        $checkoutPos = strpos($this->workflowContent, 'actions/checkout');
        $composerPos = strpos($this->workflowContent, 'composer install');
        $testPos = strpos($this->workflowContent, 'php artisan test');

        $this->assertLessThan($composerPos, $checkoutPos, 'Checkout should come before composer install');
        $this->assertLessThan($testPos, $composerPos, 'Composer install should come before running tests');
    }

    /**
     * Test that the workflow file doesn't contain common YAML syntax errors.
     */
    public function test_workflow_has_no_tabs(): void
    {
        $this->assertStringNotContainsString("\t", $this->workflowContent, 'Workflow file should use spaces, not tabs (YAML requirement)');
    }

    /**
     * Test that environment variables are properly set for tests.
     */
    public function test_workflow_sets_test_environment_variables(): void
    {
        $envSection = substr($this->workflowContent, strpos($this->workflowContent, 'Execute tests'));

        $this->assertStringContainsString('env:', $envSection, 'Test execution should define environment variables');
        $this->assertStringContainsString('DB_CONNECTION:', $envSection, 'Should set DB_CONNECTION environment variable');
        $this->assertStringContainsString('DB_DATABASE:', $envSection, 'Should set DB_DATABASE environment variable');
    }

    /**
     * Test that composer install uses recommended flags.
     */
    public function test_composer_install_uses_recommended_flags(): void
    {
        $this->assertStringContainsString('--no-ansi', $this->workflowContent, 'Composer install should use --no-ansi');
        $this->assertStringContainsString('--no-interaction', $this->workflowContent, 'Composer install should use --no-interaction');
        $this->assertStringContainsString('--prefer-dist', $this->workflowContent, 'Composer install should use --prefer-dist');
    }
}