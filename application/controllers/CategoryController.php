<?php
namespace application\controllers;
use \application\models\Category as Category;

class CategoryController extends \ItForFree\SimpleMVC\mvc\Controller
{ 
    /**
     * Список правил, ограничивающих доступ пользователей с разными ролями
     * @var type array
     */
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin', 'auth_user', 'guest']], // общее правило
        'delete' => ['deny' => ['auth_user', 'guest']], //исключения
        'edit' => ['deny' => ['guest']], 
        'add' => ['deny' => ['guest']],
        
    ];
    
    /**
     * Выводит на экран страницу "Категория" для просмотра
     */
    public function indexAction()
    {
        $Category = new Category();

        $viewCategory = $Category->getById($_GET['id']);
        
        $this->view->addVar('viewCategory', $viewCategory);
        
        $this->view->render('category/index.php');
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewCategory'])) {
                $Category = new Category();
                $newCategory = $Category->loadFromArray($_POST);
                \DebugPrinter::debug($newCategory);
                $newCategory->insert();
                \DebugPrinter::debug($newCategory, 'после инсерта');
                $this->header(\ItForFree\SimpleMVC\Url::link("homepage/index"));
            
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("homepage/index"));
            }
        }
        else {
            $addCategoryTitle = "Создание категории";
            $this->view->addVar('addCategoryTitle', $addCategoryTitle);
            
            $this->view->render('category/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования категории (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if (!empty($_POST['saveChanges'])) {
                \DebugPrinter::debug("Привет)");
                $Category = new Category();
                $newCategory = $Category->loadFromArray($_POST);
                $newCategory->update();
                \DebugPrinter::debug($newCategory, 'после апдейта');
                $this->header(\ItForFree\SimpleMVC\Url::link("category/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("category/index&id=$id"));
            }
        }
        else {
            $Category = new Category();
            $viewCategory = $Category->getById($id);
            $editCategoryTitle = "Редактирование категории";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewCategory', $viewCategory);
            $this->view->addVar('editCategoryTitle', $editCategoryTitle);
            
            $this->view->render('category/edit.php');   
        }
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if (!empty($_POST['deleteCategory'])) {
                $Category = new Category();
                $newCategory = $Category->loadFromArray($_POST);
                $newCategory->delete();
                $this->header(\ItForFree\SimpleMVC\Url::link("homepage/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("category/edit&id=$id"));
            }
        }
        else {
            $deleteCategoryTitle = "Удаление категории";
            $this->view->addVar('deleteCategoryTitle', $deleteCategoryTitle);
            
            $this->view->render('category/delete.php');
        }
    }
}

