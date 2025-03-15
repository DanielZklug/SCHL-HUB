<?php

namespace App\Controllers\Admin;

use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class ProfileController extends Controller{
    
    public function index(){

        return $this->viewAdmin('admin.profile.index');
    }

}