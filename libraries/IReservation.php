<?php

interface IReservation
{
    public function getUnique($item, $value);
    // public function create($obj);
    public function delete($item, $value);
    // public function update($obj);
    public function getALl();
}