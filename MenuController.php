<?php
namespace WtMenu\Controller;

class MenuController
{

    /**
     * @var string
     */
    protected $init = "ul";

    /**
     * @var string
     */
    protected $item = "li";

    /**
     * @var string
     */
    protected $array_menu;

    /**
     * @var string
     */
    protected $output;

    /**
     * @param array $array_menu
     */
    public function __construct(array $array_menu)
    {
        $this->setArrayMenu($array_menu);
    }

    /**
     * @return $this
     */
    public function start()
    {
        $this->make($this->getArrayMenu());
        return $this;
    }

    /**
     * @return string
     */
    public function show()
    {
        return $this->getOutput();
    }

    /**
     * @param array $array_level
     * @return void
     */
    protected function make(array $array_level)
    {

        $this->setOutput("<" . $this->getInit() . ">\n");

        foreach ($array_level as $itens) {

            $this->makeItens($itens);

            if (isset($itens['level']))
                if (is_array($itens['level']))
                    $this->make($itens['level']);

            $this->setOutput("</" . $this->closeTag($this->getItem()) . ">\n");

        }

        $this->setOutput("</" . $this->closeTag($this->getInit()) . ">\n");

    }

    /**
     * @param array $array_item
     * @return void
     */
    protected function makeItens(array $array_item)
    {
        $this->setOutput("<" . $this->getItem() . ">");

        if (isset($array_item['link']))
            $this->setOutput("<a href='" . $array_item['link'] . "'>");

        $this->setOutput($array_item['name']);

        if (isset($array_item['link']))
            $this->setOutput("</a>");

    }

    public function closeTag($string)
    {
        $tag = explode(" ", $string);
        return $tag[0];
    }

    /**
     * @param mixed $array_menu
     * @return void
     */
    public function setArrayMenu($array_menu)
    {
        $this->array_menu = $array_menu;
    }

    /**
     * @param string $init
     * @return void
     */
    public function setInit($init)
    {
        $this->init = $init;
    }

    /**
     * @param string $item
     * @return void
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @param mixed $output
     * @return void
     */
    public function setOutput($output)
    {
        $this->output .= $output;
    }

    /**
     * @return mixed
     */
    public function getArrayMenu()
    {
        return $this->array_menu;
    }

    /**
     * @return string
     */
    public function getInit()
    {
        return $this->init;
    }

    /**
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

} 