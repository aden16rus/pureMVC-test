<?

include_once('../app/Core/View.php');
include_once('../app/Core/Mysql.php');
include_once ('../app/Models/Model.php');


class MainController {

    private $view;

    function __construct()
    {
        $this->view = new View;
    }

    public function index(int $page = 1, array $form = null, string $msg = null, string $msgType = null)
    {

        session_start();
        $model = new Model();
        $pagesCount =ceil($model->getPages()/3);
        if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
            $page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
            if ($page > $pagesCount) {
                $page = $pagesCount;
            }
        }

        $sort = (Helper::getString('sort'))??'id';
        $order = (Helper::getString('order'))??'asc';

        $data = $model->getJobs($page, $sort, $order);
        $pagenator = array(
            'current' => $page,
            'count' => $pagesCount,
        );

        $data = array('jobs' => $data, 'pagenator' => $pagenator, 'form' => $form);
        $this->view->generate('index', $data, $msg, $msgType);
    }

    public function create()
    {

        $job = new Model();

        if(!$job->fillFields($_POST)) {
            $this->index(1, $job->getdata());
            return false;
        }


        try {
            $last = $job->save();
        } catch (Exception $e) {
            $this->index(1, null, $e->getMessage(), 'danger');
            return false;
        }

        $this->index(1, null, 'Job '.$last['id'].' created', 'success');

    }

    public function edit($id)
    {
        $jobData = (new Model)->getById($id);
        $this->view->generate('edit', $jobData);
    }

    public function update($id)
    {
        $job = new Model();
        if($job->update($id)) {
            header('Location: /');
        } else {
            echo $job->getLastError();
        }

    }

}