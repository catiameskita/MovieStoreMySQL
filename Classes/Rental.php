<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 24/10/2017
 * Time: 15:34
 */

class Rental{

    private $idRental;
    private $idUser;
    private $idCustomer;
    private $idMovie;
    private $date;
    private $devolution;

    /**
     * @return mixed
     */
 /*   public function __construct($idUser, $idCustomer,$idMovie)
    {
        $this->idUser = $idUser;
        $this->idCustomer = $idCustomer;
        $this->idMovie = $idMovie;
        $this->date = new DateTime();
        $date = new DateTime();
        $this->devolution = $date->add(new DateInterval('PT30S'));
    }*/


    public function getIdRental()
    {
        return $this->idRental;
    }

    /**
     * @param mixed $idRental
     */
    public function setIdRental($idRental)
    {
        $this->idRental = $idRental;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    /**
     * @param mixed $idMovie
     */
    public function setIdMovie($idMovie)
    {
        $this->idMovie = $idMovie;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDevolution()
    {
        return $this->devolution;
    }

    /**
     * @param mixed $devolution
     */
    public function setDevolution($devolution)
    {
        $this->devolution = $devolution;
    }



}