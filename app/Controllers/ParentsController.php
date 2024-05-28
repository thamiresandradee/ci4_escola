<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Address;
use App\Entities\ParentStudent;
use App\Models\ParentModel;
use App\Validation\AddressValidation;
use App\Validation\ParentValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class ParentsController extends BaseController
{
    private const VIEWS_DIRECTORY = 'parents/';
    private ParentModel $parentModel;

    public function __construct()
    {
        $this->parentModel = model(ParentModel::class);
    }
    
    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os responsáveis';

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    public function new(): string
    {
        $this->dataToView['title'] = 'Novo responsável';
        $this->dataToView['parent'] = new ParentStudent([
            'address' => new Address()
        ]);

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        //dd($this->request->getPost());

        $rules = (new ParentValidation)->getRules();

        if(!$this->validate($rules)){
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // instanciamos o responsável com os dados validados
        $parent = new ParentStudent($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if(!$this->validate($rules)){
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // instanciamos o endereço do responsável com os dados validados
        $address = new Address($this->validator->getValidated());

        $success = $this->parentModel->store(parent: $parent, address: $address);

        if(!$success){
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro nja criação do responsável');
        }

        return redirect()
            ->route('parents')
            ->with('success', 'Cadastro realizado com sucesso');
    }
}