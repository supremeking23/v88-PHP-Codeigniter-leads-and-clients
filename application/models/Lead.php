<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends CI_Model {
    public function get_all_leads(){
        $query = "SELECT CONCAT(clients.first_name,' ',clients.last_name) AS client_name, COUNT(sites.domain_name) AS number_of_leads FROM leads INNER JOIN sites INNER JOIN clients ON sites.site_id = leads.site_id AND clients.client_id = sites.client_id GROUP BY client_name; ";
        return $this->db->query($query)->result_array();
    }

    // public function get_all_leads(){
    //     $query = "SELECT CONCAT(clients.first_name,' ',clients.last_name) AS client_name, COUNT(sites.domain_name) AS number_of_leads FROM leads INNER JOIN sites INNER JOIN clients ON sites.site_id = leads.site_id AND clients.client_id = sites.client_id WHERE registered_datetime >= '2011-01-01' AND registered_datetime <= '2011-11-01' GROUP BY client_name; ";
    //     return $this->db->query($query)->result_array();
    // }

    public function get_all_leads_with_date_params($dates){
        $query = "SELECT CONCAT(clients.first_name,' ',clients.last_name) AS client_name, COUNT(sites.domain_name) AS number_of_leads FROM leads 
        INNER JOIN sites INNER JOIN clients
            ON sites.site_id = leads.site_id AND clients.client_id = sites.client_id
        WHERE registered_datetime >= ? AND registered_datetime <= ?
        GROUP BY client_name; ";

        $values = array($dates['from'],$dates['to']); 
        return $this->db->query($query, $values)->result_array();
    }
    
}

?>