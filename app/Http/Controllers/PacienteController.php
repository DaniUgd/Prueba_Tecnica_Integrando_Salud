<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


abstract class PacienteController extends Controller
{
    public function index(){
        $paciente = Paciente::all();
        return view("", compact(""));
    }
}