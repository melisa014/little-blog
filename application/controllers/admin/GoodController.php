<?php
namespace application\controllers\admin;
use \application\models\Good as Good;
use \application\models\Image as Image;
//use \ItForFree\SimpleMVC\FileUploader as FileUploader;
use \ItForFree\FileUploader as FileUploader;

/**
 * Контроллер для управления товарами
 * @author qwegram
 */
class GoodController extends \ItForFree\SimpleMVC\mvc\Controller
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

        $viewGood = $Good->getById($_GET['id'], 'goods');
        
        $this->view->addVar('viewGood', $viewGood);
        
        $this->view->render('good/index.php');
    }
    
    /**
     * Выводит на экран форму для создания нового товара (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewGood'])) {
                $newGood = (new Good())->loadFromArray($_POST);
                $newGood->insert(); 
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newGood, 'товар после инсерта');
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newGood->id);
//                die();
                //--- добавить изображение
                $additionalPath = 'goodsImages/' . $newGood->id;
                $uploadedFiles = (new FileUploader())->uploadToRelativePath($_FILES, $additionalPath);
//                \ItForFree\SimpleMVC\DebugPrinter::debug($uploadedFiles ,'добавленные в папку файлы');
                
                $newImage = (new Image())->loadFromArray($_POST);
                $newImage->id_goods = $newGood->id;
                
                $pathArray = [];
                foreach ($uploadedFiles as $image) {
                    $pathArray[] = $image['filepath'];
                }
                $newImage->path = $pathArray;
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newImage, 'объект изображения перед инсертом');
//               die();
                $newImage->insert();
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newImage, 'объект изображения после инсерта');
//                die();
                
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allGoods"));
            
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allGoods"));
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
        
        if (!empty($_POST)) { 
            
            if (!empty($_POST['saveChanges'])) {
//                \DebugPrinter::debug('$_POST'); 
                $Good = new Good();
                $newGood = $Good->loadFromArray($_POST);
//                \DebugPrinter::debug($newGood);
//                \DebugPrinter::debug($id);
                $newGood->update();
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newGood, 'после апдейт');
                //--- добавить изображение
                $additionalPath = 'goodsImages/' . $newGood->id;
                $uploadedFiles = (new FileUploader())->uploadToRelativePath($_FILES, $additionalPath);
//                \ItForFree\SimpleMVC\DebugPrinter::debug($uploadedFiles ,'добавленные в папку файлы');
                
                $newImage = (new Image())->loadFromArray($_POST);
                $newImage->id_goods = $newGood->id;
                
                $pathArray = [];
                foreach ($uploadedFiles as $image) {
                    $pathArray[] = $image['filepath'];
                }
                $newImage->path = $pathArray;
//                \ItForFree\SimpleMVC\DebugPrinter::debug($newImage, 'объект изображения перед инсертом');
//               die();
                $newImage->insert();
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/good/index&id=$id"));
                 
            } 
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/good/index&id=$id"));
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
                
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allGoods"));
              
            }
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/good/edit&id=$id"));
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
