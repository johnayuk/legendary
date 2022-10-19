<?php

namespace App\Interface;

interface AdminInterface
{
    public function getAllDatas();
    public function getData($Id);
    public function changeStatus($Id);
    public function createDatas($request);
    public function updateData($request, $Id);
    // public function search($request);
}