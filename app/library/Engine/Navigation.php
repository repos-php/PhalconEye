<?php

class Navigation
{

    /** @var \Phalcon\DiInterface */
    protected $_di = null;

    /** @var array Items in navigation */
    protected $_items = array();

    /** @var string Html/Text before item title */
    protected $_itemPrependContent = '';

    /** @var string Html/Text after item title */
    protected $_itemAppendContent = '';

    /** @var string Class of navigation */
    protected $_listClass = 'nav';

    /** @var string Class of dropdown item */
    protected $_dropDownItemClass = "dropdown";

    /** @var string Class of dropdown item title */
    protected $_dropDownItemMenuClass = "dropdown-menu";

    /** @var string Class of dropdown item switcher */
    protected $_dropDownItemToggleClass = "dropdown-toggle";

    /** @var string Class of dropdown header item */
    protected $_dropDownItemHeaderClass = "nav-header";

    /** @var string Class of dropdown divider item */
    protected $_dropDownItemDividerClass = "divider";

    /** @var string Currently active item, it can be name or href */
    protected $_activeItem = '';

    /** @var string Tag of the navigation */
    protected $_listTag = 'ul';

    /** @var string Tag of navigation item */
    protected $_listItemTag = 'li';


    public function __construct($di)
    {
        $this->_di = $di;
    }

    /** Set list class
     *
     * @param string $class
     *
     * @return Navigation
     * */
    public function setListClass($class)
    {
        $this->_listClass = $class;

        return $this;
    }

    /** Set before content
     *
     * @param string $content
     *
     * @return Navigation
     */
    public function setItemPrependContent($content)
    {
        $this->_itemPrependContent = $content;

        return $this;
    }

    /** Set after content
     *
     * @param string $content
     *
     * @return Navigation
     */
    public function setItemAppendContent($content)
    {
        $this->_itemAppendContent = $content;

        return $this;
    }

    /** Set navigation list
     *
     * @param array $items
     *
     * @return Navigation
     */
    public function setItems($items = array())
    {
        if (empty($items))
            return $this;

        $this->_items = $items;
        return $this;
    }

    /** Set active item. It can be name or href.
     *
     * @param string $item
     *
     * @return Navigation
     */
    public function setActiveItem($item = '')
    {
        $this->_activeItem = $item;

        return $this;
    }

    /** Render navigation html
     *
     * @return string
     */
    public function render()
    {
        $content = '';
        if (empty($this->_items))
            return $content;

        // short names
        $lt = $this->_listTag;
        $lit = $this->_listItemTag;
        $lc = $this->_listClass;
        $pc = $this->_itemPrependContent;
        $ac = $this->_itemAppendContent;
        $ddic = $this->_dropDownItemClass;
        $ddimc = $this->_dropDownItemMenuClass;
        $dditc = $this->_dropDownItemToggleClass;
        $ddihc = $this->_dropDownItemHeaderClass;
        $ddidc = $this->_dropDownItemDividerClass;

        $content = "<{$lt} class='{$lc}'>";
        foreach ($this->_items as $name => $item) {
            if (isset($item['items']) && !empty($item['items'])) { // dropdown menu item
                $active = ($name == $this->_activeItem || array_key_exists($this->_activeItem, $item['items']) ? ' active' : '');
                $content .= "<{$lit} class='{$ddic}{$active}'>";
                $content .= sprintf('<a href="javascript:;" class="%s" data-toggle="dropdown">%s%s%s<b class="caret"></b></a>', $dditc, $pc, $this->_di->get('trans')->query($item['title']), $ac);
                $content .= "<{$lt} class='{$ddimc}'>";
                foreach ($item['items'] as $key => $subitem) {
                    if (is_numeric($key)) {
                        if ($subitem == 'divider') {
                            $content .= "<{$lit} class='{$ddidc}'></{$lit}>";
                        } else {
                            $content .= "<{$lit} class='{$ddihc}'>";
                            $content .= $this->_di->get('trans')->query($subitem);
                            $content .= "</{$lit}>";
                        }
                    } else {
                        $itemLink = $this->_di->get('url')->get($key);
                        $content .= "<{$lit}>";
                        $content .= sprintf('<a href="%s">%s%s%s</a>', $itemLink, $pc, $this->_di->get('trans')->query($subitem), $ac);
                        $content .= "</{$lit}>";
                    }

                }
                $content .= "</{$lt}>";
                $content .= "</{$lit}>";
            } else { // normal item
                $active = ($name == $this->_activeItem || $item['href'] == $this->_activeItem ? ' class="active"' : '');
                $itemLink = $this->_di->get('url')->get($item['href']);

                $content .= "<{$lit}{$active}>";
                $content .= sprintf('<a href="%s">%s%s%s</a>', $itemLink, $pc, $this->_di->get('trans')->query($item['title']), $ac);
                $content .= "</{$lit}>";
            }
        }
        $content .= "</{$lt}>";

        return $content;
    }
}