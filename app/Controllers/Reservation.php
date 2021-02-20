<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Reservation extends BaseController {

    /**
     * Get all Reservations
     * @return Response
     */
    public function index() {
        $model = new ReservationModel();
        return $this->getResponse(
                        [
                            'message' => 'Reservation retrieved successfully',
                            'Reservation' => $model->findAll()
                        ]
        );
    }

    /**
     * Create a CheckAvailability
     */
    public function checkavailability() {
       
        $rules = [
            'date' => 'required|valid_date',
            'num' => 'required|decimal[0]|numeric|greater_than[0]|less_than[100]',
        ];

        $input = $this->getRequestInput($this->request);
        

        if (!$this->validateRequest($input, $rules)) {
            return $this
                            ->getResponse(
                                    $this->validator->getErrors(),
                                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $model = new ReservationModel();

        $available = $model->CheckAvailability($input['date'], $input['num']);


        return $this->getResponse(
                        [
                            'message' => count($available).'Tables available',
                            'reservation' => $available
                        ]
        );
    }

    /**
     * Create a new Reservation
     */
    public function create() {


        $rules = [
            'dinertable_id' => 'required|decimal[0]|numeric|greater_than[0]',
            'name' => 'required|min_length[3]|max_length[255]',
            'date' => 'required|valid_date',
            'num' => 'required|decimal[0]|numeric|greater_than[0]|less_than[100]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                            ->getResponse(
                                    $this->validator->getErrors(),
                                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $model = new ReservationModel();

        $availables = $model->CheckAvailability($input['date'], $input['num']);

        $found = false;
        foreach ($availables as $available) {
            if ($available['dinertable_id'] == $input['dinertable_id']) {
                $found = true;
            }
        }
        if (!$found) {
            return $this->getResponse(
                            [
                                'message' => 'That table is not available for that date',
                            ]
            );
        }

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


            $model = new ReservationModel();
            $id = $input['id'];
            $reservation = $model->findReservationById($id);

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


            $model = new ReservationModel();
            $id = $input['id'];

            $reservation = $model->findReservationById($id);
            $model->delete($reservation);

            return $this
                            ->getResponse(
                                    [
                                        'message' => 'Reservation deleted successfully',
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
