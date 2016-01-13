<?php
/**
 * @property AclReflectorComponent $AclReflector
 */

App::import('Model', 'Item');

class AclMenuComponent extends Component
{

    public $components = array('Auth', 'Session');

    protected $permissions = array();

    protected $menu = null;

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->menu = array(
            array(
                'title' => __('Home'),
                'url' => array('controller' => 'users', 'action' => 'home'),
            ),
            array(
                'title' => __('ACL'),
                'children' => array(
                    array(
                        'title' => __('Profile Permissions'),
                        'url' => array( 'plugin' => 'acl', 'controller' => 'aros', 'action' => 'ajax_role_permissions'),
                    ),
                    array(
                        'title' => __('User Permissions'),
                        'url' => array( 'plugin' => 'acl', 'controller' => 'aros', 'action' => 'user_permissions'),
                    )
                )
            ),
            array(
                'title' => __('Catalogs'),
                'children' => array(
                    array(
                        'title' => __('Profiles'),
                        'url' => array( 'controller' => 'profiles', 'action' => 'index'),
                    ),
                    array(
                        'title' => __('Departaments'),
                        'url' => array( 'controller' => 'departaments', 'action' => 'index'),
                    ),
                    array(
                        'title' => __('Log Types'),
                        'url' => array( 'controller' => 'log_types', 'action' => 'index'),
                    ),
                    array(
                        'title' => __('Document Origins'),
                        'url' => array( 'controller' => 'document_origins', 'action' => 'index'),
                    ),
                    array(
                        'title' => __('Document Types'),
                        'url' => array( 'controller' => 'document_types', 'action' => 'index'),
                    ),
                    array(
                        'title' => __('Tool Categories'),
                        'url' => array( 'controller' => 'tool_categories', 'action' => 'index'),
                    )
                )
            ),
            array(
                'title' => __('Documents'),
                'url' => array('controller' => 'documents', 'action' => 'index'),
            ),
            array(
                'title' => __('Registers'),
                'children' => array(
                    array(
                        'title' => __('Non-Conforming Product'),
                        'url' => array('controller' => 'ncp_registers', 'action' => 'index')
                    )
                )
            ),
            array(
                'title' => __('Stock'),
                'children' => array(
                    array(
                        'title' => __('Tools'),
                        'url' => array('controller' => 'tools', 'action' => 'index')
                    ),
                    array(
                        'title' => __('Tool Items'),
                        'url' => array('controller' => 'tool_inventories', 'action' => 'index')
                    ),
                    array(
                        'title' => __('Software'),
                        'url' => array('controller' => 'softwares', 'action' => 'index')
                    ),
                    array(
                        'title' => __('Software Licenses'),
                        'url' => array('controller' => 'licenses', 'action' => 'index')
                    )
                )
            ),
            array(
                'title' => __('Reports'),
                'children' => array(
                    array(
                        'title' => __('SGC Status'),
                        'url' => array('controller' => 'pages', 'action' => 'development_status_sgc')
                    ),
                    array(
                        'title' => __('Document Implatations'),
                        'url' => array('controller' => 'pages', 'action' => 'implantation_status_sgc')
                    )
                )
            ),
        );
		parent::__construct($collection, $settings);
	}

	public function set_session_menu()
    {
        if( !$this->Session->check( 'Alaxos.Acl.menu' ) )
        {
            $user = $this->Auth->user();
            if(!empty($user))
            {
                $this->permissions = $this->Session->read('Alaxos.Acl.permissions');
                if( !isset( $this->permissions ) )
                {
                    $this->permissions = array();
                }
                if( $this->menu ){
                    $this->Session->write( 'Alaxos.Acl.menu', $this->_addItem( $this->menu ) );
                }else{
                    $this->Item = new Item();
                    $this->Item->recursive = -1;
                    $this->Session->write( 'Alaxos.Acl.menu', $this->_addItem( $this->_extractItem( $this->Item->find( 'threaded' ) ) ) );
                }
            }
        }
    }

    public function _addItem( $items = array() ){
        $temp = array();
        foreach( (array)$items as $index => $item ){
            $aco_path = AclRouter :: aco_path( array( 'plugin' => set::classicExtract( $item, "url.plugin" ), 'controller' => set::classicExtract( $item, "url.controller" ), 'action' => set::classicExtract( $item, "url.action" )  ) );
            $children = $this->_addItem( set::classicExtract( $item, "children" ) );
            $hasChildren = count( $children ) > 0;
            if( set::classicExtract( $item, "url.controller" ) == '' && set::classicExtract( $item, "url.action" ) == '' && $hasChildren ){
                $temp[$index]['title'] = set::classicExtract( $item, "title" );
                $temp[$index]['icon'] = set::classicExtract( $item, "icon" );
                $temp[$index]['children'] = $children;
            }elseif(isset( $this->permissions[$aco_path] ) && $this->permissions[$aco_path] == 1){
                $temp[$index]['title'] = set::classicExtract( $item, "title" );
                $temp[$index]['icon'] = set::classicExtract( $item, "icon" );
                $temp[$index]['url']['plugin'] = set::classicExtract( $item, "url.plugin" ) ? set::classicExtract( $item, "url.plugin" ) : null;
                $temp[$index]['url']['controller'] = set::classicExtract( $item, "url.controller" );
                $temp[$index]['url']['action'] = set::classicExtract( $item, "url.action" );
                if( $hasChildren ) $temp[$index]['children'] = $children;
            }
        }
        return $temp;
	}

    public function _extractItem( $items ){
        $temp = array();
        foreach( $items as $index => $item ){
            $temp[$index]['title'] = set::classicExtract( $item, "Item.name" );
            $temp[$index]['url']['controller'] = set::classicExtract( $item, "Item.controller" );
            $temp[$index]['url']['action'] = set::classicExtract( $item, "Item.action" );
            if( set::classicExtract( $item, "children" ) ) $temp[$index]['children'] = $this->_extractItem( set::classicExtract( $item, "children" ) );
        }
        return $temp;
	}

}