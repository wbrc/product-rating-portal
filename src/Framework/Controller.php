<?php
namespace Framework;

class Controller
{
    final public function hasParam($id)
    {
        return isset($_REQUEST[$id]);
    }

    final public function getParam($id, $defaultValue = null)
    {
        return isset($_REQUEST[$id]) ? $_REQUEST[$id] : $defaultValue;
    }

    final public function renderView($view, $model = array())
    {
        ViewRenderer::renderView($view, $model);
    }

    final public function redirectToUrl($url)
    {
        header("Location: $url");
    }

    final public function redirect($action, $controller, $params = null)
    {
        $this->redirectToUrl($this->buildActionLink($action, $controller, $params));
    }
    
    final public function buildActionLink($action, $controller, $params)
    {
        return MVC::buildActionLink($action, $controller, $params);
    }
}
