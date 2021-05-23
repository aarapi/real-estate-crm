<?php
class Agency extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable='projects';
    public $belongsTo=array('User'=>array('foreignKey'=>false,'type'=>'INNER','conditions'=> array('Agency.id=User.project_id')),
                            'Ugroup'=>array('foreignKey'=>false,'type'=>'INNER','conditions'=> array('User.ugroup_id=Ugroup.id')),
                            'Location'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Location.id=User.location_id')));
    public $actsAs = array('search-master.Searchable');
    
}