<?php

class mod_mnettransparent_mnettransparent
{

	public static function mnettransparent($args)
	{
		global $CFG, $USER, $DB;

		$data = $args->get_data();
		$object = $args->get_record_snapshot($data['objecttable'], $data['objectid']);
		$url = parse_url($object->externalurl);
		$baseUrl = $url['scheme'] . '://' . $url['host'];
		$path = $url['path'];
		$sql = "
            SELECT
            	h.id,
                h.wwwroot
            FROM
                {mnet_host} h
            WHERE
                h.deleted = ? AND
                h.wwwroot = ?";
        $data = $DB->get_records_sql($sql, array(0, $baseUrl));
        if(is_array($data) && count($data) > 0){
        	$data = current($data);
        	$id = $data->id;
        	redirect($CFG->wwwroot . '/auth/mnet/jump.php?hostid=' . $id . '&wantsurl=' . $path);
        }
	}
}