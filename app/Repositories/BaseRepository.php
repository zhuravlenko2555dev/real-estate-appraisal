<?php


namespace App\Repositories;


class BaseRepository
{
    protected const SUCCESS_STATUS_CODE = 200;
    protected const CREATED_STATUS_CODE = 201;
    protected const UNAUTHORISED_STATUS_CODE = 401;
    protected const UNAUTHORISED_STATUS_TEXT = 'Unauthorised';

    public function response($data, int $statusCode) {
        $response = ["data" => $data, "statusCode" => $statusCode];
        return $response;
    }
}
