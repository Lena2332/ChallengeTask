<?php

declare(strict_types=1);

namespace Project\Controllers;

use Project\Repositories\RepositoryIntrface;

class CompanyController extends Controller implements ControllerInterface
{
    const TEMPL = __DIR__ . '/../../templates/company.php';
    const TEXT_ADD_SUCCESS = 'Company data was successfully added';
    const TEXT_CHANGE_SUCCESS = 'Company data was successfully changed';

    public function __construct(RepositoryIntrface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|null $id
     * @return void
     * Show add company page
     */
    public function add(?int $id): void
    {
        ob_start();

        $title = 'Company add';

        $blockTemplate = '_company_form';

        require_once self::TEMPL;

        $output = ob_get_contents();
        ob_end_clean();

        $this->render($output);
    }

    /**
     * @param int $id
     * @return void
     * Show company edit page
     */
    public function edit(int $id): void
    {
        $companyData = $this->repository->getById($id);

        if (!$companyData) {
            header('Location: ' . '/404');
            exit();
        }

        ob_start();

        $title = 'Company edit';

        $blockTemplate = '_company_form';

        require_once self::TEMPL;

        $output = ob_get_contents();
        ob_end_clean();

        $this->render($output);
    }

    /**
     * @return void
     * Show list of companies
     */
    public function getAll(): void
    {
        ob_start();

        $title = 'Company list';

        $list = $this->repository->getAll();

        $blockTemplate = '_company_list';

        require_once self::TEMPL;

        $output = ob_get_contents();
        ob_end_clean();

        $this->render($output);
    }

    public function store(array $data): void
    {
        if ( !$this->validate($data) ) {

            $_SESSION['old_form_data'] = $data;

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        unset($_SESSION['old_form_data']);

        $insertId = $this->repository->store($data);

        if ($insertId) {

            $_SESSION['success'] = self::TEXT_ADD_SUCCESS;

            header('Location: ' . '/company/');
        }
    }

    public function update(int $id, array $data): void
    {
        if ( !$this->validate($data) ) {

            $_SESSION['old_form_data'] = $data;

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        unset($_SESSION['old_form_data']);

        $result = $this->repository->update($id, $data);

        if ($result) {

            $_SESSION['success'] = self::TEXT_CHANGE_SUCCESS;

            header('Location: ' . '/company/');
            exit();
        }
    }

    public function delete(int $id): void
    {
        if (  $this->repository->delete($id) ) {
            echo 'deleted';
        };
    }

    /**
     * @param array $array $_POST
     * @return bool
     * Add errors to session
     */
    private function validate(array $array): bool
    {
        $_SESSION['errors'] = [];

        if ( $array['name'] === '' ) {
            $_SESSION['errors']['name'] = 'Please, fill the Name field';
        }

        if ( strlen($array['name']) > 255 ) {
            $_SESSION['errors']['name'] = 'Too long string, max string length is 255 characters';
        }

        if ( !is_string($array['name']) ) {
            $_SESSION['errors']['name'] = 'Field name must be type of string';
        }

        if ( $array['organization_number'] === '' ) {
            $_SESSION['errors']['organization_number'] = 'Please, fill the Organization Number field';
        }

        if ( !is_numeric($array['organization_number']) ) {
            $_SESSION['errors']['organization_number'] = 'It is string, this field allowed only numbers';
        }

        if ( strlen($array['organization_number']) > 10 ) {
            $_SESSION['errors']['organization_number'] = 'Organization number is too long';
        }

        return ( empty($_SESSION['errors']) ) ? true : false;
    }
}