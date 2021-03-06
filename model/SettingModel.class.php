<?php

class SettingModel extends Model {

	protected $tableName = 'webim_settings';

	protected $fields = array(
			0 => 'id',
			1 => 'uid',
			2 => 'data',
			4 => 'created_at',
			5 => 'updated_at',
	);

	public function set($uid, $data) {
		$setting = $this->where("uid='$uid'")->find();
		if( $setting ) {
			if ( !is_string( $data ) ){
				$data = json_encode( $data );
			}
			$setting['data'] = $data;
			$this->save($setting);
		} else {
			$setting = $this->create(array(
				'uid' => $uid,
				'data' => $data,
				'created_at' => date( 'Y-m-d H:i:s' ),
			));
			$this->add();
		}
	}

	public function get($uid) {
		$setting = $this->where("uid='$uid'")->find();	
		if($setting) {
			return json_decode($setting['data']);
		} 
		return new stdClass();
	}
	
}
