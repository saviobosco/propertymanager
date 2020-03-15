<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\UnitRentPayment;

class UnitRentPaymentRepository extends Repository
{

    public function model()
    {
        return UnitRentPayment::class;
    }

    /**
     * @param $id
     * This method is used to generate receipts
     * for the active tenants in the unit
     * @return bool
     */
    public function generateReceipts($id)
    {
        return true;
    }
}
