<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		PyroCMS Development Team
 * @package 	PyroCMS
 * @subpackage 	Social Module
 * @since		v2.1
 *
 */
class Credential_m extends MY_Model
{
	public function save($input)
	{
		return $this->db->replace('credentials', $input);
	}
	
	public function save_token($provider, $input)
	{
		$this->db->where('provider', $provider);
		
		return $this->db->update('credentials', array(
			'access_token' => $input['access_token'],
			'secret' => $input['secret'],
			'expires' => $input['expires'],
			'refresh_token' => $input['refresh_token'],
		));
	}
	
	public function get_active_provider($provider)
	{
		return $this->db
			->select('client_key, client_secret, scope, access_token, secret')
			->where('provider', $provider)
			->where('client_key IS NOT NULL')
			->where('client_secret IS NOT NULL')
			->get('credentials')
			->row();
	}
}