<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class FrontsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		
		$this->loadModel('Slide');
		 $slides=$this->Slide->find('all',array('conditions'=>array('status'=>'Active'),'order'=>array('ordering'=>'asc')));
		 $this->set('slides',$slides);
		$this->loadModel('Project');
		$allProject=$this->Project->find('all',array('order'=>array('Project.id'=>'desc'),'limit'=>6));
		$this->set('allProject',$allProject);
		$this->loadModel('Property');
		$allviewedProperty=$this->Property->find('all',array('order'=>array('views'=>'desc'),'limit'=>8));
		$allProperty=$this->Property->find('all',array('conditions'=>array('Property.featured'=>'Yes'),
							       'order'=>array('rand()'),'limit'=>10));
		$this->loadModel('Type');
		$this->Type->virtualFields= array('total_count' => 'Count(Property.id)');
		$propertyType=$this->Type->find('all',array('joins'=>array(array('table'=>'properties','alias'=>'Property','conditions'=>array('Type.id=Property.type_id'))),
							       'fields'=>array('Type.*','total_count'),
							       'group'=>array('Type.id')
							       ));
		$this->set('propertyType',$propertyType);
		$this->set('allProperty',$allProperty);
		$this->set('allviewedProperty',$allviewedProperty);
		$this->loadModel('Content');
		$contentValue=$this->Content->find('first',array('conditions'=>array('id'=>1,'published'=>'published')));
		$this->set('contentValue',$contentValue);
		
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
		
		

		
		
		
		
		
	}
}
