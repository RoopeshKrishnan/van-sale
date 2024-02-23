<?php
class Admin_model extends CI_Model
{
    public function all_users()
    {
        $query = $this->db->query('SELECT upd.user_name,ucd.user_id,ucd.type_of_scheme,ucd.prefix,ucd.profile_status,ucd.last_bill_number,a.area FROM user_company_details ucd 
        JOIN user_personal_details upd USING(user_id)
        LEFT JOIN area a USING(area_id) WHERE ucd.deleted=0
        ');
        return $query;
    }

    public function edit_user($user_id)
    {
        $query = $this->db->query('SELECT ucd.*,upd.* FROM user_company_details ucd 
        JOIN user_personal_details upd USING(user_id)
         WHERE upd.user_id= ' . $user_id . '
        ');
        return $query->row();
    }

    public function all_customers()
    {
        $query = $this->db->query('SELECT cpd.customer_name,cpd.phone,a.area,ccd.customer_id,ccd.price_list,ccd.ob,ccd.alias_code,ccd.profile_status,u.user_name FROM customer_company_details ccd 
        JOIN customer_personal_details cpd USING(customer_id)
        JOIN user_personal_details u ON u.user_id=ccd.created_user_id
        LEFT JOIN area a USING(area_id) WHERE ccd.deleted=0
        ');
        return $query;
    }

    public function edit_customer($customer_id)
    {
        $query = $this->db->query('SELECT ccd.*,cpd.* FROM customer_company_details ccd 
        JOIN customer_personal_details cpd USING(customer_id)
        WHERE ccd.customer_id= ' . $customer_id . '
        ');
        return $query->row();
    }

    public function fetch_sub_category()
    {
        $query = $this->db->query('SELECT sc.sub_category_id,sc.sub_category,sc.status,sc.created_date,c.category FROM sub_category sc
      JOIN category c USING(category_id)
      WHERE sc.deleted = 0 ORDER BY sub_category_id desc
      ');
        return $query;
    }

    public function check_subcategory_validation($sub_category, $category_id)
    {
        return  $this->db->where('deleted', 0)->where('sub_category', $sub_category)->where('category_id', $category_id)->get('sub_category');
    }
    public function check_categoryType_validation($sub_category_id, $category_id, $category_type)
    {
        return  $this->db->where('deleted', 0)->where('sub_category_id', $sub_category_id)->where('category_id', $category_id)->where('category_type', $category_type)->get('category_type');
    }
    public function fetch_category_type()
    {
        $query = $this->db->query('SELECT ct.category_type_id,ct.category_type,ct.created_date,ct.status,c.category,sc.sub_category FROM category_type ct
    JOIN category c USING(category_id)
    JOIN sub_category sc USING(sub_category_id)
    WHERE ct.deleted = 0 ORDER BY category_type_id desc
    ');
        return $query;
    }

    public function fetch_tax()
    {
        $query = $this->db->query('SELECT t.tax_id ,t.tax,t.status,t.created_date,t.tax_name,ty.tax_type FROM tax t
      JOIN tax_type ty USING(tax_type_id)
      WHERE t.deleted = 0 ORDER BY tax_id  desc
      ');
        return $query;
    }

    public function check_tax_validation($tax, $tax_type_id)
    {
        return  $this->db->where('deleted', 0)->where('tax', $tax)->where('tax_type_id', $tax_type_id)->get('tax');
    }

    public function all_items()
    {
        $query = $this->db->query('SELECT  i.item_id,i.item_name,i.item_code,i.hsn_code,i.status,c.category,sc.sub_category,ct.category_type,t.tax_name FROM item i 
        LEFT JOIN category c USING (category_id)
        LEFT JOIN sub_category sc USING(sub_category_id)
        LEFT JOIN category_type ct USING(category_type_id)
        LEFT JOIN tax t USING(tax_id)
        WHERE i.deleted =0
        ');
        return $query;
    }
    public function stock_user()
    {
        $query = $this->db->query('SELECT up.user_id,up.user_name FROM user_personal_details up
        JOIN user_company_details uc USING(user_id)
        WHERE up.deleted = 0 AND uc.profile_status = 1 AND uc.deleted = 0
        ');
        return $query;
    }
    public function fetch_stock($stock_id)
    {
        $query = $this->db->query('SELECT s.stock_id,s.	stock_date,up.user_name,v.vehicle_number,d.driver_name FROM stock s 
        LEFT JOIN user_personal_details up ON s.executive_id = up.user_id
        LEFT JOIN vehicle v USING(vehicle_id)
        LEFT JOIN driver d USING(driver_id)
        WHERE s.deleted = 0 AND s.stock_id = ' . $stock_id . '
        ');
        return $query;
    }
    public function filter_items($category_id, $sub_category_id, $category_type_id)
    {
        // return $this->db->where('category_id', $category_id)->where('sub_category_id', $sub_category_id)->where('category_type_id', $category_type_id)->get('item')->result();
        $this->db->where('category_id',$category_id);
        if ($sub_category_id) {
            $this->db->where('sub_category_id', $sub_category_id);
        }
        if ($category_type_id) {
            $this->db->where('category_type_id', $category_type_id);
        }
        $query = $this->db->get('item');
        $results = $query->result();
        return $results;
    }

    public function stock_temp_data($stock_id)
    {
        $query = $this->db->query('SELECT ast.*, i.item_name, i.minimum_sale_unit_id, iu.item_unit
        FROM add_stock_temp ast
        JOIN item i USING(item_id)
        JOIN item_unit iu ON i.minimum_sale_unit_id = iu.item_unit_id
        WHERE ast.stock_id = '.$stock_id.' AND ast.status = 1
        ');
        return $query;
    }

    public function stock_close_temp_data($stock_id)
    {
        $query = $this->db->query('SELECT st.*,i.item_id,i.item_name FROM close_stock_temp st
        JOIN item i USING(item_id)
        WHERE st.stock_id = '.$stock_id.' AND st.status = 1
        ');
        return $query;
    }
    public function item_net_weight($item_id){
        $query = $this->db->select('net_weight')->where('item_id', $item_id)->get('item');
        return $query;
    }

    public function stock_data_confirmation()
    {
        $query = $this->db->where('status', 1)->get('add_stock_temp');
        return $query;
    }

    public function truncateTable($table_name)
    {
        $sql = "TRUNCATE TABLE " . $table_name;

        if ($this->db->query($sql)) {
            return true; // Truncate successful
        } else {
            // Handle any errors
            return false; // Truncate failed
        }
    }

    public function close_stock_data_confirmation()
    {
        $query = $this->db->where('status', 1)->get('close_stock_temp');
        return $query;
    }
    public function all_stock()
    {
        $query = $this->db->query('SELECT s.*,up.user_name,v.vehicle_number,d.driver_name FROM stock s
        JOIN user_personal_details up ON s.executive_id = up.user_id
        JOIN vehicle v USING(vehicle_id)
        JOIN driver d USING(driver_id)
        WHERE s.deleted =0 AND s.status = 1  ORDER BY s.stock_id ASC
        ');
        return $query;
    }
    public function fetch_stock_by_id($stock_id)
    {
        $query = $this->db->query('SELECT s.*,up.user_name,v.vehicle_number,d.driver_name FROM stock s
        JOIN user_personal_details up ON s.executive_id = up.user_id
        JOIN vehicle v USING(vehicle_id)
        JOIN driver d USING(driver_id)
        WHERE s.deleted =0 AND s.stock_id = ' . $stock_id . '
        ');
        return $query;
    }
    public function stock_item_data($stock_id)
    {
        $query = $this->db->query('SELECT ads.*,i.item_name FROM add_stock ads
        JOIN item i USING(item_id)
        WHERE ads.deleted =0 AND ads.stock_id = ' . $stock_id . '
        ');
        return $query;
    }

    public function item_no_stock($item_id,$stock_id){
      return  $this->db->select('number_of_stock')->where('item_id',$item_id)->where('stock_id',$stock_id)->get('add_stock');
    }

    public function item_stock_validation($item_id,$stock_id){
        $this->db->from('add_stock_temp'); // Replace with your table name
        $this->db->where('stock_id', $stock_id);
        $this->db->where('item_id', $item_id);
        $this->db->where('status', 1);
        
        $row_count = $this->db->count_all_results();
        return $row_count;
    }
    public function fetch_item_with_pricelist()
    {
        $query = $this->db->query('SELECT pi.*,i.item_id,i.item_name FROM pricelist_item pi
        JOIN item i USING(item_id)
        WHERE pi.deleted=0
        ');
        return $query;
    }

    public function updateStatus($pricelistId, $newStatus)
    {
        // Assuming you have a table named 'pricelist' and a column 'status'
        $this->db->where('price_list_name_id', $pricelistId);
        $this->db->update('price_list_name', array('status' => $newStatus));
    }

    public function pricelist_update_or_insert($item_id)
    {
        $this->db->select('COUNT(*) as id_count');
        $this->db->from('pricelist_item');
        $this->db->where('item_id', $item_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->id_count; // Return the count value
    }
    // public function find_item_tax($item_id)
    // {
    //     $query = $this->db->query('SELECT t.tax FROM item i 
    //     JOIN tax t USING(tax_id)
    //     WHERE i.item_id = '.$item_id.'
    //     ');
    //     return $query->row();
    // }

//     SELECT t.tax AS tax
// FROM item i
// LEFT JOIN tax t ON i.have_tax <> 0 AND i.tax_id = t.tax_id
// WHERE i.item_id = 24
public function find_item_tax($item_id)
{
    $query = $this->db->query('SELECT COALESCE(t.tax, 0) AS tax
    FROM item i
    LEFT JOIN tax t ON (i.have_tax = 0 AND t.tax_id = 0) OR (i.have_tax <> 0 AND i.tax_id = t.tax_id)
    WHERE i.item_id = '.$item_id.'
    ');
    return $query->row();
}

public function find_price_list_tax($pricelist_id){
   $query = $this->db->where('	price_list_name_id',$pricelist_id)->get('price_list_name')->row();
   return $query;
}

public function item_with_tax()
{
    $query = $this->db->query('SELECT i.item_id,i.item_name,t.tax FROM item i 
    LEFT JOIN tax t using(tax_id)  ORDER BY item_id ASC
    ');
    return $query;
}

public function fetch_customer_based_area($area_id)
{
    $query = $this->db->query('SELECT cpd.customer_id,cpd.customer_name FROM customer_personal_details cpd 
    LEFT JOIN customer_company_details ccd USING(customer_id)
    WHERE ccd.area_id = '.$area_id.'
    ');
    return $query;
}

public function fetch_customer_details($customer_id)
{
    $query = $this->db->query('SELECT cpd.customer_id,cpd.customer_name,a.area,ccd.ob FROM customer_personal_details cpd 
    LEFT JOIN customer_company_details ccd USING(customer_id)
    LEFT JOIN area a ON a.area_id = ccd.area_id
    WHERE cpd.customer_id = '.$customer_id.'
    ');
    return $query;
}
public function verify_customer_order($customer_order_id){
    $query = $this->db->query('SELECT cio.*,i.item_name FROM customer_item_order cio
    JOIN item i USING(item_id)
    WHERE cio.customer_order_id = '.$customer_order_id.'  AND cio.status= 1
    ');
    return $query;
}
public function all_orders(){
    $query = $this->db->query('SELECT co.*,cpd.customer_id,cpd.customer_name,a.area,ccd.ob FROM customer_order co
    JOIN customer_personal_details cpd USING(customer_id)
    JOIN customer_company_details ccd USING(customer_id)
    JOIN area a ON a.area_id = co.area_id
    
    ');
    return $query;
}
public function consolidate_customer_order(){
    $query = $this->db->query("SELECT co.customer_order_id, cpd.customer_name, GROUP_CONCAT(CONCAT(i.item_name, ' ', cio.item_order_count) SEPARATOR ', ') AS ordered_items 
    FROM customer_order co
    JOIN customer_personal_details cpd USING(customer_id)
    JOIN customer_item_order cio USING(customer_order_id)
    JOIN item i ON cio.item_id = i.item_id
    WHERE co.status=1 AND cio.status = 1
    GROUP BY co.customer_order_id,cpd.customer_name
    ");
    return $query;
}

public function customer_order_by_area($from_date,$to_date,$area_id){
    $this->db->select('co.*, cpd.customer_id, cpd.customer_name, ccd.ob');
    $this->db->from('customer_order co');
    $this->db->join('customer_personal_details cpd', 'cpd.customer_id = co.customer_id');
    $this->db->join('customer_company_details ccd', 'ccd.customer_id = cpd.customer_id');
    $this->db->where('co.deleted', 0);
    $this->db->where('co.status', 1);
    $this->db->where('co.is_order_coverted_to_van_stock', 0);
    $this->db->where('co.area_id', $area_id);
    $this->db->where('co.delivery_date >=', $from_date);
    $this->db->where('co.delivery_date <=', $to_date);

    $query = $this->db->get();
    return $query;
}

public function all_consolidated_orders(){
    $query = $this->db->query("SELECT co.*,a.area,upd.user_name FROM consolidate_orders co 
    LEFT JOIN area  a USING(area_id)
    LEFT JOIN user_personal_details upd ON upd.user_id = co.exicutive_id
    WHERE co.status = 1
    ");
    return $query;
}

public function fetch_consolidated_item_order_count_by_item_id($consolidate_orders_id, $item_id) {
    $query = $this->db->query("
        SELECT COALESCE(SUM(coi.item_order_count), 0) AS total_item_count
        FROM consolidate_orders co
        LEFT JOIN customer_order coo ON FIND_IN_SET(coo.customer_order_id, co.order_ids)
        LEFT JOIN customer_item_order coi ON coo.customer_order_id = coi.customer_order_id
        WHERE co.consolidate_orders_id = ? AND coi.item_id = ?
    ", array($consolidate_orders_id, $item_id));

    return $query;
}


// SELECT co.customer_order_id, cpd.customer_name, GROUP_CONCAT(CONCAT(i.item_name, ' ', cio.item_order_count) SEPARATOR ', ') AS ordered_items 
// FROM customer_order co
// JOIN customer_personal_details cpd USING(customer_id)
// JOIN customer_item_order cio USING(customer_order_id)
// JOIN item i ON cio.item_id = i.item_id
// GROUP BY co.customer_order_id,cpd.customer_name


// SELECT 
//     COALESCE(SUM(coi.item_order_count), 0) AS total_item_count
// FROM 
//     consolidate_orders co
// LEFT JOIN 
//     customer_order coo ON FIND_IN_SET(coo.customer_order_id, co.order_ids)
// LEFT JOIN 
//     customer_item_order coi ON coo.customer_order_id = coi.customer_order_id
// WHERE 
//     co.consolidate_orders_id = 9
//     AND coi.item_id = 10;




public function fetch_customer_by_type($customer_type){
    $this->db->select('ccd.customer_id, cpd.customer_name');
    $this->db->from('customer_company_details ccd');
    $this->db->join('customer_personal_details cpd', 'ccd.customer_id = cpd.customer_id');
    $this->db->where('ccd.bill_type', $customer_type);
    $this->db->where('ccd.profile_status', 1);
    $this->db->where('ccd.deleted', 0);
    $this->db->where('cpd.deleted', 0);

    $query = $this->db->get();
    return $query;
}

public function fetch_selected_customer_details($customer_id)
{
    $query = $this->db->query('SELECT cpd.customer_id,cpd.customer_name,a.area,cpd.phone,pla.price_list_name,ccd.gst_number FROM customer_personal_details cpd 
    LEFT JOIN customer_company_details ccd USING(customer_id)
    LEFT JOIN area a ON a.area_id = ccd.area_id
    LEFT JOIN price_list_name pla ON pla.price_list_name_id = ccd.price_list
    WHERE cpd.customer_id = '.$customer_id.'
    ');
    return $query;
}

    // end of model
}
