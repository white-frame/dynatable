<?php namespace WhiteFrame\Dynatable\Widgets;

/**
 * Class DynatableWidget
 * @package WhiteFrame\Dynatable\Widgets
 */
class DynatableWidget
{
    protected $entity;
    protected $slug;
    protected $options;

    /**
     * @param $entity
     * @param array $attributes
     * @internal param $contents
     */
    public function register($entity, $attributes = [])
    {
        $this->entity = new $entity();
        $this->options = array_merge([
            'sorts' => [
                'id' => -1
            ]
        ], $attributes);

        $this->slug = strtolower(str_replace('\\', '_', get_class($this->entity)));

        return $this;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function script()
    {
        return view('white-frame-dynatable::script', [
            'dynatable' => $this,
            'options' => $this->options
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function html()
    {
        return view('white-frame-dynatable::html', [
            'dynatable' => $this,
            'options' => $this->options
        ]);
    }

    /**
     * @return string
     */
    public function getContainerId()
    {
        return "dynatable_container_" . $this->slug;
    }

    /**
     * @return string
     */
    public function getTableId()
    {
        return "dynatable_" . $this->slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->entity->present()->columns();
    }

    public function getSearches()
    {
        return $this->entity->present()->searches();
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return url(trim($this->entity->getEndpoint(), '/')) . '?dynatable=true';
    }
}