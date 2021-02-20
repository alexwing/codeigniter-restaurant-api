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

        $reservation = $model->where('name', $input['name'])->first();

        //if exist table
        if ($reservation) {
            return $this->getResponse(
                            [
                                'message' => 'The table already exists',
                                'reservation' => $reservation
                            ]
            );
        }

        $model->save($input);
        $reservation = $model->where('name', $input['name'])->first();


        return $this->getResponse(
                        [
                            'message' => 'Table added successfully',
                            'reservation' => $reservation
                        ]
        );
    }

    /**
     * Get a single reservation by ID
     */
    public function show($id) {
        try {

            $model = new DinertableModel();
            $reservation = $model->findDinertableById($id);

            return $this->getResponse(
                            [
                                'message' => 'reservation retrieved successfully',
                                'reservation' => $reservation
                            ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                            [
                                'message' => 'Could not find reservation for specified ID'
                            ],
                            ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id) {
        try {

            $model = new DinertableModel();
            $model->findDinertableById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $reservation = $model->findDinertableById($id);

            return $this->getResponse(
                            [
                                'message' => 'Dinertable updated successfully',
                                'reservation' => $reservation
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

    public function destroy() {
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
            
            $reservation = $model->findDinertableById($id);
            $model->delete($reservation);

            return $this
                            ->getResponse(
                                    [
                                        'message' => 'Dinertable deleted successfully',
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
