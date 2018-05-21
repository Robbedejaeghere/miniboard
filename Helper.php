<?php

class Helper
{
    public static function zuiverData($data)
    {
        $data = trim($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }

}