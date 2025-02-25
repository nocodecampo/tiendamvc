<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Phone;

class PhoneController extends Controller{
    public function index(...$params){
        $phone = new Phone();
        $phone->number = "123456789";
        $phone->save();
    }
}

?>