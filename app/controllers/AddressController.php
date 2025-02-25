<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Address;

class AddressController extends Controller{
    public function index(...$params){
        $address = new Address();
        $address->street = "Calle 123";
        $address->zip_code = "36350";
        $address->city = "Madrid";
        $address->country = "España";
        $address->save();
    }
}

?>