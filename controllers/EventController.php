<?php

class EventController extends Controller
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new Event();
    }

    public function index()
    {
        $searchResults = $categories = $locations = [];
        if(isset($_POST) && !empty($_POST)) {

            $category = trim(is($_POST, 'category_id'));
            $location = trim(is($_POST, 'location'));
            $keyword  = trim(is($_POST, 'keyword'));
            $searchResults = $this->model->getSearchResults($category, $location, $keyword);
        }

        $categories = simplfyArrayByKey($this->model->getCategories());
        $locations = simplfyArrayByKey($this->model->getLocations(), 'location');
        $this->data = [
            'categories' => $categories,
            'locations'  => $locations,
            'searchResults' => $searchResults,
        ];
    }

    public function view()
    {
        $id = (int) is($this->params, 0);
        if($id === 0) {
            Router::redirect('/event');
            exit;
        }

        $this->data = $this->model->getEventById($id);
    }

    public function admin_index()
    {
        $this->data = $this->model->getAllTickets();
    }

    public function admin_edit()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->updateTicket();
            Router::redirect('/admin/event');
            exit;
        }
        $eventID = (int) is($this->params, 0);
        $price = (float) is($this->params, 1);

        $this->data = $this->model->getTicketBYPks($eventID, $price);
    }

    public function admin_import()
    {
        $error = array();
        $authorizedExtensions = array("xml", "csv","json");
        $maxFileSize = 10000;
        if(isset($_FILES) && is($_FILES, 'file'))
        {
            $uploadedFile = filter($_FILES['file']['name']);
            $tempName = $_FILES['file']['tmp_name'];
            $fileSize = (int)$_FILES['file']['size'];
            $fileExtension = pathinfo($uploadedFile ,PATHINFO_EXTENSION);

            if(in_array($fileExtension, $authorizedExtensions) && $fileSize <= $maxFileSize)
            {
                $method = 'parse' . strtoupper($fileExtension);
                $this->$method(file_get_contents($tempName));
            }
        }
    }

    public function parseJSON($jsonData)
    {
        $categories = [];
        $data = json_decode($jsonData, true);

        foreach($data as $item)
        {
            $categories[] = $item['category'];
        }
        $this->model->addCategories($categories);
        $this->model->addEvents($data);
        Router::redirect('/admin/event');
        exit;
    }
}
