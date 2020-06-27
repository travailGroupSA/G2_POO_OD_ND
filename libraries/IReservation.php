<?php

interface IReservation
{
    public function getUnique($item, $value);
    public function delete($item, $value);
    // public function update($obj);
    public function getDataByLimitAndOffset($condition, $limit, $offset);
}