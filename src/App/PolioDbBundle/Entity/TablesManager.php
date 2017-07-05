<?php
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 6/5/2017
 * Time: 3:29 PM
 */

namespace App\PolioDbBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="tables_manager")
 */
class TablesManager
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="table_name", type="string", length=100)
     */
    private $tableName;

    /**
     * @var string
     * @ORM\Column(name="table_long_name", type="string", length=100)
     */
    private $tableLongName;

    /**
     * @var string
     * @ORM\Column(name="table_type", type="string", length=100)
     */
    private $tableType;


    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $source;


    /**
     * @var integer
     * @ORM\Column(name="dashboard", type="integer", length=1)
     */
    private $dashboard;

    /**
     * @var integer
     * @ORM\Column(name="upload_form", type="integer", length=1)
     */
    private $uploadForm;

    /**
     * @var integer
     * @ORM\Column(name="entry_form", type="integer", length=1)
     */
    private $entryForm;

    /**
     * @var integer
     * @ORM\Column(name="download_form", type="integer", length=1)
     */
    private $downloadForm;

    /**
     * @var string
     * @ORM\Column(name="data_level", type="string", length=100)
     */
    private $dataLevel;

    /**
     * @var integer
     * @ORM\Column(name="sort_no", type="integer", length=3)
     */
    private $sort_no;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=1)
     */
    private $enabled;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_date", type="datetime", nullable=true)
     */
    private $entryDate = 'CURRENT_TIMESTAMP';


    /**
     * @return string
     */
    public function getTableLongName()
    {
        return $this->tableLongName;
    }

    /**
     * @param string $tableLongName
     */
    public function setTableLongName($tableLongName)
    {
        $this->tableLongName = $tableLongName;
    }


    /**
     * @return string
     */
    public function getDataLevel()
    {
        return $this->dataLevel;
    }

    /**
     * @param string $dataLevel
     */
    public function setDataLevel($dataLevel)
    {
        $this->dataLevel = $dataLevel;
    }

    /**
     * @return int
     */
    public function getSortNo()
    {
        return $this->sort_no;
    }

    /**
     * @param int $sort_no
     */
    public function setSortNo($sort_no)
    {
        $this->sort_no = $sort_no;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getTableType()
    {
        return $this->tableType;
    }

    /**
     * @param mixed $tableType
     */
    public function setTableType($tableType)
    {
        $this->tableType = $tableType;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getDashboard()
    {
        return $this->dashboard;
    }

    /**
     * @param mixed $dashboard
     */
    public function setDashboard($dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * @return mixed
     */
    public function getUploadForm()
    {
        return $this->uploadForm;
    }

    /**
     * @param mixed $uploadForm
     */
    public function setUploadForm($uploadForm)
    {
        $this->uploadForm = $uploadForm;
    }

    /**
     * @return mixed
     */
    public function getEntryForm()
    {
        return $this->entryForm;
    }

    /**
     * @param mixed $entryForm
     */
    public function setEntryForm($entryForm)
    {
        $this->entryForm = $entryForm;
    }

    /**
     * @return mixed
     */
    public function getDownloadForm()
    {
        return $this->downloadForm;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param mixed $downloadForm
     */
    public function setDownloadForm($downloadForm)
    {
        $this->downloadForm = $downloadForm;
    }

    /**
     * @return \DateTime
     */
    public function getEntryDate()
    {
        return $this->entryDate;
    }

    /**
     * @param \DateTime $entryDate
     */
    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;
    }

    public function __construct()
    {
        $this->entryDate = new \DateTime();
    }


}