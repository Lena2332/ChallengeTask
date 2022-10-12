<?php

declare(strict_types=1);

namespace Project\Controllers;

use Project\Models\Company;
use Project\Repositories\RepositoryIntrface;

class StoreController extends Controller implements ControllerInterface
{
    const TEMPL = __DIR__ . '/../../templates/store.php';
    const TEXT_ADD_SUCCESS = 'Store data was successfully added';
    const TEXT_CHANGE_SUCCESS = 'Store data was successfully changed';

    public function __construct(RepositoryIntrface $repository)
    {
        $this->repository = $repository;
    }

    public function add(?int $id): void
    {
        $title = 'Store add';

        $companyList = $this->repository->getCompanies();

        /* Check if isset such company */
        $companyId = $this->getCompanyId($id, $companyList);

        $blockTemplate = '_store_form';

        require_once self::TEMPL;
    }

    public function edit(int $id): void
    {
        $title = 'Store edit';

        $storeData = $this->repository->getById($id);

        if (!$storeData) {
            header('Location: ' . '/404');
            exit();
        }

        $companyId = $storeData->getCompanyId();

        $companyList = $this->repository->getCompanies();

        $blockTemplate = '_store_form';

        require_once self::TEMPL;
    }

    public function getAll(): void
    {
        $title = 'Store list';

        $list = $this->repository->getAll();

        $blockTemplate = '_store_list';

        require_once self::TEMPL;
    }

    public function getAllByCompany(int $id): void
    {
        $title = 'Store list';

        $companyList = $this->repository->getCompanies();

        /* Check if isset such company */
        $companyId = $this->getCompanyId($id, $companyList);

        $list = $this->repository->getAllByCompanyId($companyId);

        $blockTemplate = '_store_list';

        require_once self::TEMPL;
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

            header('Location: ' . '/store/');
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

            header('Location: ' . '/store/');
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

        if ( !is_numeric($array['company_id']) ) {
            $_SESSION['errors']['company_id'] = 'It is string, this field allowed only numbers';
        }

        if ( $array['company_id'] === '' ) {
            $_SESSION['errors']['company_id'] = 'Please, choose company';
        }

        if ( $array['name'] === '' ) {
            $_SESSION['errors']['name'] = 'Please, fill the Name field';
        }

        if ( strlen($array['name']) > 100 ) {
            $_SESSION['errors']['name'] = 'Too long string, max string length is 255 characters';
        }

        if ( !is_string($array['name']) ) {
            $_SESSION['errors']['name'] = 'Field name must be type of string';
        }

        if ( $array['address'] === '' ) {
            $_SESSION['errors']['address'] = 'Please, fill the Address field';
        }

        if ( !is_string($array['address']) ) {
            $_SESSION['errors']['address'] = 'Field Name must be type of string';
        }

        if ( strlen($array['address']) > 512 ) {
            $_SESSION['errors']['address'] = 'Address field is too long';
        }

        if ( $array['city'] === '' ) {
            $_SESSION['errors']['city'] = 'Please, fill the City field';
        }

        if ( !is_string($array['city']) ) {
            $_SESSION['errors']['city'] = 'Field City must be type of string';
        }

        if ( strlen($array['city']) > 512 ) {
            $_SESSION['errors']['city'] = 'City field is too long';
        }

        if ( $array['country'] === '' ) {
            $_SESSION['errors']['country'] = 'Please, fill the Country field';
        }

        if ( !is_string($array['country']) ) {
            $_SESSION['errors']['country'] = 'Field Country must be type of string';
        }

        if ( strlen($array['country']) > 50 ) {
            $_SESSION['errors']['country'] = 'Country field is too long';
        }

        if ( $array['zip'] === '' ) {
            $_SESSION['errors']['zip'] = 'Please, fill the Zip field';
        }

        if ( !is_numeric($array['zip']) ) {
            $_SESSION['errors']['zip'] = 'It is string, this field allowed only numbers';
        }

        if ( strlen($array['zip']) > 10 ) {
            $_SESSION['errors']['zip'] = 'Zip is too long';
        }

        return ( empty($_SESSION['errors']) ) ? true : false;
    }

    /**
     * @param int|null $id
     * @param array $companyList
     * @return int|null
     */
    private function getCompanyId(?int $id, array $companyList): ?int
    {
        $companyId = null;

        if ( $id && !empty($companyList) ) {
            foreach ($companyList as $company) {
                if ($company->getId() === $id) {
                    $companyId = $id;
                    break;
                }
            }
        }

        return $companyId;
    }
}