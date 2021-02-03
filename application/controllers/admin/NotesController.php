<?php
namespace application\controllers\admin;
use application\models\Notes;
use ItForFree\SimpleMVC\Config;

/* 
 *   Class-controller notes
 * 
 * 
 */

class NotesController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    public $layoutPath = 'admin-main.php';
    
    
    public function indexAction()
    {
        $Notes = new Notes();

        $noteId = $_GET['id'] ?? null;
        
        if ($noteId) { // если указан конктреный пользователь
            $viewNotes = $Notes->getById($_GET['id']);
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->render('note/view-item.php');
        } else { // выводим полный список
            
            $notes = $Notes->getList()['results'];
            $this->view->addVar('notes', $notes);
            $this->view->render('note/index.php');
        }
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewNote'])) {
                $Notes = new Notes();
                $newNotes = $Notes->loadFromArray($_POST);
                $newNotes->insert(); 
                $this->redirect($Url::link("admin/notes/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/index"));
            }
        }
        else {
            $addNotesTitle = "Добавление новой заметки";
            $this->view->addVar('addNotesTitle', $addNotesTitle);
            
            $this->view->render('note/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
                $Notes = new Notes();
                $newNotes = $Notes->loadFromArray($_POST);
                $newNotes->update();
                $this->redirect($Url::link("admin/notes/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/index&id=$id"));
            }
        }
        else {
            $Notes = new Notes();
            $viewNotes = $Notes->getById($id);
            
            $editNotesTitle = "Редактирование заметки";
            
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->addVar('editNotesTitle', $editNotesTitle);
            
            $this->view->render('note/edit.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) {
            if (!empty($_POST['deleteNote'])) {
                $Notes = new Notes();
                $newNotes = $Notes->loadFromArray($_POST);
                $newNotes->delete();
                
                $this->redirect($Url::link("admin/notes/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/edit&id=$id"));
            }
        }
        else {
            
            $Notes = new Notes();
            $deletedNotes = $Notes->getById($id);
            $deleteNotesTitle = "Удалить заметку?";
            
            $this->view->addVar('deleteNotesTitle', $deleteNotesTitle);
            $this->view->addVar('deletedNotes', $deletedNotes);
            
            $this->view->render('note/delete.php');
        }
    }
    
    
}