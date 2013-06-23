<?php

class Items_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_search_categories() {
        $DB_Main = $this->load->database('default', TRUE);
        $query = $DB_Main->get('categories');
        return $query->result_array();
    }

    function get_items($search, $category) {
        $DB_Main = $this->load->database('default', TRUE);

        if (isset($category)) {
            $DB_Main->where('type', $category);
        }

        if (isset($search)) {
            $DB_Main->like('display_name', $search);
        }

        $query = $DB_Main->get('items');
        $item_array = $query->result_array();

        $i = 0;
        foreach ($item_array as $item) {
            $DB_Main->where('item_id', $item['id']);
            $query_item = $DB_Main->get('users_items');
            $item_array[$i]['amount'] = $query_item->num_rows();

            $i++;
        }

        return $item_array;
    }

    function get_item_info($item_id) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $item_id);
        $query = $DB_Main->get('items');
        return $query->row_array();
    }

    function get_item_users($item_id){
        $DB_Main = $this->load->database('default', TRUE);
        $this->load->model("users_model");
        
        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('users_items');
        $result = $query->result_array();
        $i = 0;
        foreach($result as $useritem){
            $user_array = $this->users_model->get_user($useritem["user_id"]);
            $result[$i]['user_name'] = $user_array['name'];
            $i++;
        }
        return $result;
    }
    
    function update_item($post) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $post['id']);

        if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4) { // Check if PHP 5.4
            if ($post['attrs'] != "") {
                $attrs = json_encode(json_decode($post['attrs']), JSON_UNESCAPED_SLASHES);
                echo "attrs :" . $attrs . ": ";
            } else {
                $attrs = NULL;
            }

            $data = array(
                'name' => $post['name'],
                'display_name' => $post['display_name'],
                'description' => $post['description'],
                'web_description' => $post['web_description'],
                'type' => $post['type'],
                'loadout_slot' => $post['loadout_slot'],
                'price' => $post['price'],
                'attrs' => $attrs,
                'is_buyable' => $post['is_buyable'],
                'is_tradeable' => $post['is_tradeable'],
                'is_refundable' => $post['is_refundable'],
                'category_id' => $post['category_id'],
                'expiry_time' => $post['expiry_time']
            );
        } else {
            $data = array(
                'name' => $post['name'],
                'display_name' => $post['display_name'],
                'description' => $post['description'],
                'web_description' => $post['web_description'],
                'type' => $post['type'],
                'loadout_slot' => $post['loadout_slot'],
                'price' => $post['price'],
                'attrs' => $post['attrs'],
                'is_buyable' => $post['is_buyable'],
                'is_tradeable' => $post['is_tradeable'],
                'is_refundable' => $post['is_refundable'],
                'category_id' => $post['category_id'],
                'expiry_time' => $post['expiry_time']
            );
        }

        foreach ($data as $key => $value) {
            if ($data[$key] == "")
                $data[$key] = NULL;
        }

        $DB_Main->update('items', $data);
    }

    function add_useritem($store_userid, $item_id) {
        $DB_Main = $this->load->database('default', TRUE);

        //Check for Duplicates
        $DB_Main->where('user_id', $store_userid);
        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('users_items');

        if ($query->num_rows() == 0) {
            $data = array(
                'user_id' => $store_userid,
                'item_id' => $item_id,
                'acquire_method' => 'web'
            );
            $DB_Main->set('acquire_date', 'NOW()', FALSE);
            $DB_Main->insert('users_items', $data);
        } else {
            log_message('error', 'store-add_useritem, User/Item Combo already exists');
        }
    }

    function add_item($name, $display_name, $description, $web_description, $type, $loadout_slot, $price, $attrs, $is_buyable, $is_tradeable, $is_refundable, $category_id, $expiry_time) {

        if ($expiry_time == 0)
            $expiry_time = NULL;

        $DB_Main = $this->load->database('default', TRUE);
        $data = array(
            'name' => $name,
            'display_name' => $display_name,
            'description' => $description,
            'web_description' => $web_description,
            'type' => $type,
            'loadout_slot' => $loadout_slot,
            'price' => $price,
            'attrs' => $attrs,
            'is_buyable' => $is_buyable,
            'is_tradeable' => $is_tradeable,
            'is_refundable' => $is_refundable,
            'category_id' => $category_id,
            'expiry_time' => $expiry_time
        );

        foreach ($data as $key => $value) {
            if ($data[$key] == "")
                $data[$key] = NULL;
        }

        $DB_Main->insert('items', $data);
    }

    function remove_item($item_id) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $item_id);
        $DB_Main->delete('items');
        $DB_Main->where('item_id', $item_id);
        $DB_Main->delete('users_items');
    }
    
    function remove_refund_item($item_id){
        $this->load->model('users_model');
        $DB_Main = $this->load->database('default', TRUE);
        
        //Query item data
        $DB_Main->where('id', $item_id);
        $query_item = $DB_Main->get('items');
        $row_item = $query_item->row_array();
        
        //Refund the item to the users who are using the item
        $item_users = $this->get_item_users($item_id);
        foreach($item_users as $row){
            $this->users_model->add_credits($row['user_id'], $row_item['price']);
        }
        
        //remove the item
        $this->remove_item($item_id);
        
    }
    
    function remove_useritem($store_userid, $item_id) {
        $DB_Main = $this->load->database('default', TRUE);

        //Check for Duplicates
        $DB_Main->where('user_id', $store_userid);
        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('users_items');

        if ($query->num_rows() >= 1) {
            $DB_Main->where('useritem_id', $query->id);
            $DB_Main->delete('users_items_loadouts');

            $DB_Main->where('user_id', $store_userid);
            $DB_Main->where('item_id', $item_id);
            $DB_Main->delete('users_items');
        } else {
            log_message('error', 'store-remove_useritem, User/Item Combo does not exists');
        }
    }

    function delete_items_by_type($type) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('type', $type);
        $DB_Main->delete('items');
    }

}

?>