<?php
namespace application\controllers\admin;
use \application\models\Good as Good;
use \application\models\Image as Image;
use \application\models\FileUploader as FileUploader;

/**
 * Контроллер для управления товарами
 * @author qwegram
 */
class GoodController extends \core\mvc\Controller
{
    
        /**
     * Список правил, ограничивающих доступ пользователей с разными ролями
     * По общему правилу всем разрешено всё. 
     * Частные правила иллюстрируют исключения, и они более приоритетны
     * @var type array
     */
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin'], 'deny' => ['auth_user', 'guest']] // общее правило , 'deny' => ['guest']
    ];
    
    /**
     * Выводит на экран страницу "Товар" для просмотра
     */
    public function indexAction()
    {

        $Good = new Good();

        $viewGood = $Good->getById($_GET['id']);
        
        $this->view->addVar('viewGood', $viewGood);
        
        $this->view->render('good/index.php');
    }
    
    /**
     * Выводит на экран форму для создания нового товара (только для Администратора)
     */
    public function addAction()
    {
//        \core\DebugPrinter::debug($_POST, 'post');
//        \core\DebugPrinter::debug($_FILES, 'files');
//        die();
        
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewGood'])) {
                $Good = new Good();
                $newGood = $Good->loadFromArray($_POST);
                $newGood->insert(); 
//                \core\DebugPrinter::debug($newGood, 'товар после инсерта');
                \core\DebugPrinter::debug($newGood->id);
                die();
                
                $basePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images';
                $additionalPath = 'goodsImages/' . $newGood->id;
                $uploader = new FileUploader();
                $uploadedFiles = $uploader->uploadToRelativePath($_FILES, 
                   $basePath, $additionalPath);
                \core\DebugPrinter::debug($uploadedFiles ,'добавленные в папку файлы');
                
                $Image = new Image();
                $newImage = $Image->loadFromArray($_POST);
                $newImage->id_goods = $newGood->id;
                $newImage->path = $uploadedFiles['filepath'];
                \core\DebugPrinter::debug($newImage, 'объект изображения перед инсертом');
                $newImage->insert();
                \core\DebugPrinter::debug($newImage, 'объект изображения после инсерта');
                die();
                
                $this->header(\core\mvc\view\Url::link("archive/allGoods"));
            
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\core\mvc\view\Url::link("archive/allGoods"));
            }
        }
        else {
            $addGoodTitle = "Новая товарная позиция";
            
            $this->view->addVar('addGoodTitle', $addGoodTitle);
                        
            $this->view->render('good/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования товара (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
//        \DebugPrinter::debug($_POST); 
//        \DebugPrinter::debug($id); 
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'])) {
//                \DebugPrinter::debug('$_POST'); 
                $Good = new Good();
                $newGood = $Good->loadFromArray($_POST);
//                \DebugPrinter::debug($newGood);
//                \DebugPrinter::debug($id);
                $newGood->update();
//                \DebugPrinter::debug($newGood, 'после апдейт');
                $this->header(\core\mvc\view\Url::link("admin/good/index&id=$id"));
                 
            } 
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\core\mvc\view\Url::link("admin/good/index&id=$id"));
            }
        }
        else {
            $Good = new Good();
            $viewGood = $Good->getById($id);
            $editGoodTitle = "Изменение информации о товаре";
//            \DebugPrinter::debug($this->viewGood);
            
            $this->view->addVar('viewGood', $viewGood);
            $this->view->addVar('editGoodTitle', $editGoodTitle);
            
            $this->view->render('good/edit.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
//        \DebugPrinter::debug("Hello");
        
        if (!empty($_POST)) {
            
            if (!empty($_POST['deleteGood'])) {
//                \DebugPrinter::debug('$_POST');
//                die();
                $Good = new Good();
                $newGood = $Good->loadFromArray($_POST);
                $newGood->delete();
                
                $this->header(\core\mvc\view\Url::link("archive/allGoods"));
              
            }
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\core\mvc\view\Url::link("admin/good/edit&id=$id"));
            }
        }
        else {
            
            $Good = new Good();
            $deletedGood = $Good->getById($id);
            $deleteGoodTitle = "Удаление товара";
//            \DebugPrinter::debug($deletedGood); 
            
            $this->view->addVar('deleteGoodTitle', $deleteGoodTitle);
            $this->view->addVar('deletedGood', $deletedGood);
            
            $this->view->render('good/delete.php');
        }
    }
    
    
}
