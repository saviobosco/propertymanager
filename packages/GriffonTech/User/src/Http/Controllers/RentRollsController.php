<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Unit\Repositories\LeaseRepository;

class RentRollsController extends Controller
{
    protected $_config;

    protected $leaseRepository;

    public function __construct(
        LeaseRepository $leaseRepository
    )
    {
        $this->_config = request('_config');

        $this->leaseRepository = $leaseRepository;
    }

    public function index()
    {
        return view($this->_config['view']);
    }

}
