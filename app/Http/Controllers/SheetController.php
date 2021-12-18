<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function index(){
        return "index";
    }

    public function create(){
        return "create";
    }

    // public function store($req){
    //     return "store";
    // }

    public function show($id){
        return "show method $id";
    }
    public function edit($id){
        return "edit method $id";
    }
}

