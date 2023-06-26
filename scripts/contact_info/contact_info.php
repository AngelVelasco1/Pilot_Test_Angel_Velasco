<?php
namespace App\contact_info;
use App\db\connect;
use App\Singleton;
class contact_info extends connect
{
    private $queryPost = 'INSERT INTO contact_info(id, id_staff, whatsapp, instagram, linkedin, email, address, cel_number) VALUES (:identification, :staffId, :whatsapp, :instagram, :linkedin, :email, :address, :cel)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "staffId", SELECT whatsapp AS "whatsapp", SELECT instagram AS :instagram, SELECT linkedin AS "linkedin", SELECT email AS "email", SELECT address AS "address", SELECT cel_number AS "cel" FROM contact_info';
    private $queryUpdate = 'UPDATE contact_info SET id_staff = :staffId, whatsapp = :whatsapp, instagram = :instagram, linkedin = :linkedin, email = :email, address = :address, cel_number = :cel WHERE id = :identification';
    private $queryDelete = 'DELETE FROM contact_info WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $id_staff= 1, private $whatsapp= 1, public $instagram = 1, public $linkedin = 1, private $email = 1, private $address = 1, private $cel_number = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function contactInfoPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("whatsapp", $this->whatsapp);
            $sentence->bindValue("instagram", $this->instagram);
            $sentence->bindValue("linkedin", $this->linkedin);
            $sentence->bindValue("email", $this->email);
            $sentence->bindValue("address", $this->address);
            $sentence->bindValue("cel", $this->cel_number);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function contactInfoGet()
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
    function contactInfoUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("whatsapp", $this->whatsapp);
            $sentence->bindValue("instagram", $this->instagram);
            $sentence->bindValue("linkedin", $this->linkedin);
            $sentence->bindValue("email", $this->email);
            $sentence->bindValue("address", $this->address);
            $sentence->bindValue("cel", $this->cel_number);

            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function contactInfoDelete()
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