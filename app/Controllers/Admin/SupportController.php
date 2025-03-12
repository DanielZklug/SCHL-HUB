<?php

namespace App\Controllers\Admin;

use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class SupportController extends Controller{
    
    public function index(){
        return $this->viewAdmin('admin.support.index');
    }

}