<?php
require_once __DIR__ . '/../config/Database.php';

class Property {
    private $conn;
    private $table_name = "properties";

    public $id;
    public $title;
    public $description;
    public $property_type;
    public $listing_type;
    public $price;
    public $address;
    public $city;
    public $state;
    public $zip_code;
    public $bedrooms;
    public $bathrooms;
    public $area_sqft;
    public $status;
    public $is_featured;
    public $main_image;
    public $added_by;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Read all properties (with filters)
    public function read($filters = []) {
        $query = "SELECT p.*, u.full_name as agent_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.added_by = u.id
                  WHERE 1=1";

        // Apply filters
        if (!empty($filters['listing_type'])) {
            $query .= " AND list_type = :listing_type";
        }
        if (!empty($filters['property_type'])) {
            $query .= " AND property_type = :property_type";
        }
        if (!empty($filters['location'])) {
            $query .= " AND (city LIKE :location OR state LIKE :location OR address LIKE :location)";
        }
        if (!empty($filters['price_min'])) {
            $query .= " AND price >= :price_min";
        }
        if (!empty($filters['price_max'])) {
            $query .= " AND price <= :price_max";
        }
        if (!empty($filters['bedrooms'])) {
            $query .= " AND bedrooms >= :bedrooms";
        }
        if (!empty($filters['bathrooms'])) {
            $query .= " AND bathrooms >= :bathrooms";
        }

        $query .= " ORDER BY p.created_at DESC";

        $stmt = $this->conn->prepare($query);

        if (!empty($filters['listing_type'])) {
            $stmt->bindParam(":listing_type", $filters['listing_type']);
        }
        if (!empty($filters['property_type'])) {
            $stmt->bindParam(":property_type", $filters['property_type']);
        }
        if (!empty($filters['location'])) {
            $loc = "%{$filters['location']}%";
            $stmt->bindParam(":location", $loc);
        }
        if (!empty($filters['price_min'])) {
            $stmt->bindParam(":price_min", $filters['price_min']);
        }
        if (!empty($filters['price_max'])) {
            $stmt->bindParam(":price_max", $filters['price_max']);
        }
        if (!empty($filters['bedrooms'])) {
            $stmt->bindParam(":bedrooms", $filters['bedrooms']);
        }
        if (!empty($filters['bathrooms'])) {
            $stmt->bindParam(":bathrooms", $filters['bathrooms']);
        }


        $stmt->execute();
        return $stmt;
    }

    // Read single property
    public function readOne() {
        $query = "SELECT p.*, u.full_name as agent_name, u.email as agent_email, u.phone as agent_phone
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.added_by = u.id
                  WHERE p.id = ?
                  LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create property
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (title, description, property_type, listing_type, price, address, city, state, zip_code, 
                 bedrooms, bathrooms, area_sqft, status, is_featured, main_image, added_by) 
                VALUES (:title, :description, :property_type, :listing_type, :price, :address, :city, :state, :zip_code,
                        :bedrooms, :bathrooms, :area_sqft, :status, :is_featured, :main_image, :added_by)";

        $stmt = $this->conn->prepare($query);

        // Sanitize and bind
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":property_type", $this->property_type);
        $stmt->bindParam(":listing_type", $this->listing_type);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":zip_code", $this->zip_code);
        $stmt->bindParam(":bedrooms", $this->bedrooms);
        $stmt->bindParam(":bathrooms", $this->bathrooms);
        $stmt->bindParam(":area_sqft", $this->area_sqft);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":is_featured", $this->is_featured);
        $stmt->bindParam(":main_image", $this->main_image);
        $stmt->bindParam(":added_by", $this->added_by);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Update property
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, 
                      description = :description, 
                      property_type = :property_type, 
                      listing_type = :listing_type, 
                      price = :price, 
                      address = :address, 
                      city = :city, 
                      state = :state, 
                      zip_code = :zip_code, 
                      bedrooms = :bedrooms, 
                      bathrooms = :bathrooms, 
                      area_sqft = :area_sqft, 
                      status = :status, 
                      is_featured = :is_featured,
                      main_image = :main_image
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize and bind
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":property_type", $this->property_type);
        $stmt->bindParam(":listing_type", $this->listing_type);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":zip_code", $this->zip_code);
        $stmt->bindParam(":bedrooms", $this->bedrooms);
        $stmt->bindParam(":bathrooms", $this->bathrooms);
        $stmt->bindParam(":area_sqft", $this->area_sqft);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":is_featured", $this->is_featured);
        $stmt->bindParam(":main_image", $this->main_image);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
