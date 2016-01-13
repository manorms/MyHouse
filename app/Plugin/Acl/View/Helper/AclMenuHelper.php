<?php
App::uses('HtmlHelper', 'View/Helper');

class AclMenuHelper extends AppHelper
{
    var $helpers = array( 'Html', 'Session');

    protected $_group = null;

	protected $_depth = 0;

    public $defaults = array(
		'separator' => false,
		'children' => null,
		'title' => null,
		'url' => null,
		'ulId' => null,
		'alias' => array(),
		'partialMatch' => false,
		'permissions' => array(),
		'id' => null,
		'class' => null,
	);

    public $settings = array(
		'activeClass' => 'active',
		'firstClass' => 'first-item',
		'childrenClass' => 'dropdown',
		'evenOdd' => false,
		'itemFormat' => '<li%s>%s%s</li>',
		'wrapperFormat' => '<ul%s>%s</ul>',
		'noLinkFormat' => '<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">%s<b class="caret"></b></a>',
		'menuVar' => 'menu',
		'authVar' => 'user',
		'authModel' => 'User',
		'authField' => 'group',
        'ulChildren' => 'dropdown-menu',
	);

    function build( $id = null, $options = array( 'class' => 'nav navbar-nav' ), &$data = null, &$isActive = false)
    {
        if (is_null($data)) {
			$data = $this->Session->read('Alaxos.Acl.menu');
		}

        if (!empty($options)) {
			$this->settings = array_merge($this->settings, $options);
		}

        if (isset($data[$id])) {
			$parent =& $data[$id];
		} else {
			$parent =& $data;
		}

        $out = '';
		$offset = 0;
		$nowIsActive = false;
		if (is_array($parent)) {
			foreach ($parent as $pos => $item) {
				$this->_depth++;

				$ret = $this->_buildItem($item, $pos-$offset, $nowIsActive);

				if ($ret==='') {
					$offset++;
				}

				$out .= $ret;

				$this->_depth--;

				$isActive = $isActive || $nowIsActive;
			}
		}

		if ($out==='') {
			return '';
		}

		$ulId = (isset($this->settings['ulId'])) ? $this->settings['ulId'] : $id;
		$class = (isset($id) && ($id != 'children')) ? ' id="'.$ulId.'"' : '';
        $class = (isset($id) && ($id == 'children')) ? ' class="'.$this->settings['ulChildren'].'"' : '';
		if (isset($options['class'])) {
			$class .= ' class="'.$options['class'].'"';
		}

		$pad = str_repeat("\t", $this->_depth);

		return sprintf('%s'.$this->settings['wrapperFormat']."\n", $pad, $class, "\n".$out.$pad);

    }

    protected function _buildItem(&$item, $pos = -1, &$isActive = false) {
		$item = array_merge($this->defaults, $item);

		if ($item['separator']) {
			return $item['separator'];
		}

		if (is_null($item['title'])) {
			return '';
		}

		if (!empty($item['permissions']) && !in_array($this->_group, (array)$item['permissions'])) {
			return '';
		}

		$children = '';
		$nowIsActive = false;
		if ($hasChildren = is_array($item['children'])) {
			$this->_depth++;

			$children = $this->build('children', array(), $item, $nowIsActive);

			$this->_depth--;
		}

		if ($children==='') {
			$hasChildren = false;
		}

		$check = false;
		if (isset($item['url'])) {
			if ($item['partialMatch']) {
				$check = (strpos(Router::normalize($this->here), Router::normalize($item['url']))===0);
			} else {
				$check = Router::normalize($this->here) === Router::normalize($item['url']);
			}
		}

		$isActive = $nowIsActive || $check;

		$arrClass = array();

		if ($pos===0) {
			$arrClass[] = $this->settings['firstClass'];
		}

		if ($isActive) {
			$arrClass[] = $this->settings['activeClass'];
		}

		if ($hasChildren) {
			$arrClass[] = $this->settings['childrenClass'];
		}

		if ($this->settings['evenOdd']) {
			$arrClass[] = (($pos&1)?'even':'odd');
		}

		$class = '';
		$arrClass = array_filter($arrClass);
		if (isset($item['class'])) {
			if (is_array($item['class'])) {
				$arrClass = array_merge($arrClass, $item['class']);
			}

			else $arrClass[] = $item['class'];
		}

		if (!empty($arrClass)) {
			$class = ' class="'.implode(' ', $arrClass).'"';
		}

		if (isset($item['id'])) {
			$class = ' id="'.$item['id'].'"'.$class;
		}

		if (is_null($item['url'])) {
			$url = sprintf($this->settings['noLinkFormat'], ( isset( $item['icon'] ) && $item['icon'] != '' ? "<i class='{$item['icon']}'></i> " : "" ) . "{$item['title']}");
		} else {
            $title = ( set::classicExtract( $item, 'icon' ) ? "<i class=\"{$item['icon']}\"></i> " : "" ) . "<span>{$item['title']}</span>";
		    $url = $this->Html->link( $title,  $item['url'], array( 'escape' => false ) );
		}

		$pad = str_repeat("\t", $this->_depth);
		if ($hasChildren) {
			$urlPad = str_repeat("\t", $this->_depth+1);
			$url = "\n".$urlPad.$url;
			$children = "\n".$children.$pad;
		}

		return sprintf('%s'.$this->settings['itemFormat']."\n", $pad, $class, $url, $children);
	}
}