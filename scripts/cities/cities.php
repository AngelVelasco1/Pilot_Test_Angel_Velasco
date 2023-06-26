<?php
namespace App\cities;
use App\db\connect;
use App\Singleton;
class cities extends connect
{
    private $queryPost = 'INSERT INTO cities(id, name_city, id_region) VALUES (:identification, :name_city, :regionId)';
    private $queryGet = 'SELECT id AS "identification", SELECT name_city AS "name_city", SELECT id_region AS "regionId" FROM cities
        INNER JOIN regions ON cities.id_region = regions.id';
    private $queryUpdate = 'UPDATE cities SET name_city = :name_city, id_region = :regionId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM cities WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $name_city= 1, private $regionId = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function citiesPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("name_city", $this->name_city);
            $sentence->bindValue("staffId", $this->id_staff);
         
            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function citiesGet()
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
    function citiesUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("positionId", $this->id_position);
            $sentence->bindValue("journeyId", $this->id_journey);
            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function citiesDelete()
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