<?php

namespace App\Controllers;

use App\Models\DinertableModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Dinertable extends BaseController {

    /**
     * Get all Dinertables
     * @return Response
     */
    public function index() {
        $model = new DinertableModel();
        return $this->getResponse(
                        [
                            'message' => 'Dinertable retrieved successfully',
                            'Dinertable' => $model->findAll()
                        ]
        );
    }

    /**
     * Create a new Dinertable
     */
    public function create() {


        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'min_diner' => 'required|decimal[0]|numeric|greater_than[0]|less_than[100]',
            'max_diner' => 'required|decimal[0]|numeric|greater_than[0]|less_than[100]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                            ->getResponse(
                                    $this->validator->getErrors(),
                                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        if ($input['min_diner'] > $input['max_diner']) {
            return $this->getResponse(
                            [
                                'message' => 'The minimum number of diners cannot be greater than the maximum',
                            ]
            );
        }
        
        $model = new DinertableModel();

        $dinertable = $model->where('name', $input['name'])->first();

        //if exist table
        if ($dinertable) {
            return $this->getResponse(
                            [
                                'message' => 'The table already exists',
                                'dinertable' => $dinertable
                            ]
            );
        }

        $model->save($input);
        $dinertable = $model->where('name', $input['name'])->first();


        return $this->getResponse(
                        [
                            'message' => 'Table added successfully',
                            'dinertable' => $dinertable
                        ]
        );
    }

    /**
     * Get a single dinertable by ID
     */
    public function show() {
        try {

            $rules = [
                'id' => 'required|decimal[0]|numeric|greater_than[0]',
            ];

            $input = $this->getRequestInput($this->request);

            if (!$this->validateRequest($input, $rules)) {
                return $this
                                ->getResponse(
                                        $this->validator->getErrors(),
                                        ResponseInterface::HTTP_BAD_REQUEST
                );
            }


            $model = new DinertableModel();
            $id = $input['id'];
            $dinertable = $model->findDinertableById($id);

            return $this->getResponse(
                            [
                                'message' => 'Table retrieved successfully',
                                'dinertable' => $dinertable
                            ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                            [
                                'message' => 'Could not find table for specified ID'
                            ],
                            ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
   
    public function destroy() {
        try {
            $rules = [
                'id' => 'required|decimal[0]|numeric|greater_than[0]',
            ];

            $input = $this->getRequestInput($this->request);
            
            var_dump($input);

            if (!$this->validateRequest($input, $rules)) {
                return $this
                                ->getResponse(
                                        $this->validator->getErrors(),
                                        ResponseInterface::HTTP_BAD_REQUEST
                );
            }


            $model = new DinertableModel();
            
            $dinertable = $model->findDinertableById($input['id']);
            $model->delete($dinertable);

            return $this
                            ->getResponse(
                                    [
                                        'message' => 'Table deleted successfully',
                                    ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                            [
                                'message' => $exception->getMessage()
                            ],
                            ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

}
