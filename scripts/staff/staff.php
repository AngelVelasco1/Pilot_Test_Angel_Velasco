<?php
namespace App\staff;

use App\db\connect;
use App\Singleton;

class staff extends connect
{
    private $queryPost = 'INSERT INTO staff(id, doc, first_name, second_name, first_surname, second_surname, eps, id_area, id_city) VALUES(:identificacion, :doc, :firstName, :secondname, :firstSurname, :secondSurname, :eps, :areaId, :cityId)';
    private $queryGet = 'SELECT id AS "identification", SELECT doc AS "doc", SELECT first_name AS "firstName",  SELECT second_name AS "secondName",  SELECT first_surname AS "firstSurname",  SELECT second_surname AS "secondSurname",  SELECT eps AS "eps", SELECT id_area AS "areaId", SELECT id_city AS "cityId" FROM staff';
    private $queryUpdate = 'UPDATE staff SET doc = :doc, first_name = :firstName, second_name = :secondName, first_surname = :firstSurname, second_surname = :secondSurname, eps = :eps, id_area = :areaId, id_city = :cityId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM staff WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $doc = 1, private $first_name = 1, private $second_name = 1, private $first_surname = 1, private $second_surname = 1, private $eps = 1, private $id_area = 1, private $id_city = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function staffPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("doc", $this->doc);
            $sentence->bindValue("firstName", $this->first_name);
            $sentence->bindValue("secondName", $this->second_name);
            $sentence->bindValue("firstSurname", $this->first_surname);
            $sentence->bindValue("secondSurname", $this->second_surname);
            $sentence->bindValue("eps", $this->eps);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("cityId", $this->id_city);
            
            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function staffGet()
    {
        try {
            $sentence = $this->conx->prepare($this->queryGet);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => $sentence->fetchAll(\PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //? UPDATE Function */
    function staffUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("doc", $this->doc);
            $sentence->bindValue("firstName", $this->first_name);
            $sentence->bindValue("secondName", $this->second_name);
            $sentence->bindValue("firstSurname", $this->first_surname);
            $sentence->bindValue("secondSurname", $this->second_surname);
            $sentence->bindValue("eps", $this->eps);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("cityId", $this->id_city);

            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function staffDelete()
    {
        try {
            $sentence = $this->conx->prepare($this->queryDelete);
            $sentence->bindValue("identification", $this->id);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => "Deleted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }



}
?>