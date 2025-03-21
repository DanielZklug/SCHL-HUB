<?php

namespace App\Controllers\Admin;

use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class CalendarController extends Controller{

    public function index(){
        $this->isAdmin();

        return $this->viewAdmin('admin.calendar.index',compact('post'));
    }

}