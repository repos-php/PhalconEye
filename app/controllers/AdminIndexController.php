<?php

class AdminIndexController extends Controller
{
    public function init()
    {
        // dispatch admin routes
        $controller = $this->dispatcher->getParam('admin_controller');
        $action = $this->dispatcher->getParam('admin_action');
        $admin_id = $this->dispatcher->getParam('admin_id');
        if (!is_array($admin_id))
            $admin_id = array($admin_id);

        if (!$action)
            $action = 'index';

        if ($controller && $action) {
            $this->dispatcher->forward(array(
                "controller" => 'admin-' . $controller,
                "action" => $action,
                "params" => $admin_id
            ));
        }

        if ($controller == null){
            $activeItem = "index";
        }
        else{
            $activeItem = "admin/{$controller}";
        }

        $navigation = new Navigation($this->di);
        $navigation
            ->setItems(array(
            'index' => array(
                'href' => 'admin',
                'title' => 'Dashboard'
            ),
            'users' => array(
                'title' => 'Manage',
                'items' => array( // type - dropdown
                    'admin/users' => 'Users',
                    'admin/pages' => 'Pages'
                )
            ),
            'settings' => array( // type - dropdown
                'title' => 'Settings',
                'items' => array(
                    1 => 'Main settings',
                    'admin/1' => 'Menu item 1',
                    'admin/2' => 'Menu item 2',
                    2 => 'divider',
                    3 => 'Other settings',
                    'admin/3' => 'Menu item 3',
                    'admin/4' => 'Menu item 4',
                )
            )))
            ->setActiveItem($activeItem);

        $this->view->setVar('headerNavigation', $navigation);

    }

    public function indexAction()
    {

    }
}

