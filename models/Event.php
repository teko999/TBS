<?php

class Event extends Model
{
    public function getEvents()
    {
        $sql = 'SELECT * FROM events';
        return $this->db->query($sql);
    }

    public function getCategories()
    {
        $sql = 'SELECT * FROM categories';
        return $this->db->query($sql);
    }

    public function getLocations()
    {
        $sql = 'SELECT location, id FROM events';
        return $this->db->query($sql);
    }

    public function getEventById($id)
    {
        $id = (int)$id;
        $sql = 'SELECT e.id, e.name, e.description, e.location, e.date, c.name as `category` FROM events e
                INNER JOIN categories c ON e.category_id = c.id
                WHERE e.id =' . $id;

        $event = $this->db->query($sql);

        $sql = 'SELECT price, quantity, disscount FROM tickets
                WHERE event_id =' . $id;
        $event[0]['tickets'] = $this->db->query($sql);
        return $event[0];
    }

    public function getSearchResults($category = null, $location = null, $keyword = null)
    {
        $where = [];
        $sql = 'SELECT e.id, e.name, e.description, e.location, e.`date`,
                (SELECT min(t.price) as price FROM tickets t WHERE t.event_id = e.id) as minPrice,
                (SELECT max(t.price) as price FROM tickets t WHERE t.event_id = e.id) as maxPrice
                FROM events e
                WHERE 1 ';
        if($category != null) {
            $where['category_id'] = (int)$category;
        }
        if($location != null) {
            $where['location'] = $this->db->escape($location);
        }
        if($keyword != null) {
            $where['description'] = $this->db->escape($keyword);
        }

        if(count($where)) {
            foreach($where as $tableColumn => $value) {
                $condition = ($tableColumn === 'description')
                    ? ' AND ' . $tableColumn . ' LIKE "%' . $value . '%"'
                    : ' AND ' . $tableColumn . '="' . $value . '"';
                $sql.= $condition;
            }
        }
        return $this->db->query($sql);
    }

    public function getAllTickets()
    {
        $sql = 'SELECT t.event_id, t.price, t.quantity, t.disscount, e.name
                FROM tickets t
                INNER JOIN events e ON e.id = t.event_id';

        return $this->db->query($sql);
    }

    public function getTicketBYPks($eventID, $price)
    {
        $sql = "SELECT t.event_id, t.price, t.quantity, t.disscount, e.name
                FROM tickets t
                INNER JOIN events e ON e.id = t.event_id
                WHERE t.event_id = $eventID AND t.price = $price LIMIT 1";

        return $this->db->query($sql);
    }

    public function updateTicket()
    {
        if(Session::get('login')) {
            $eventID    = (int) is($_POST, 'event_id');
            $oldPrice   = (float) is($_POST, 'old_price');
            $price      = (float) is($_POST, 'price');
            $disscount  = (int) is($_POST, 'disscount');
            $quantity   = (int) is($_POST, 'quantity');
            $sql = 'UPDATE tickets SET '
                    ." price =" . $price
                    .", disscount =" . $disscount
                    .", quantity =" . $quantity
                    ." WHERE event_id = {$eventID}
                    AND price = {$oldPrice}";
        }
        $this->db->query($sql);
        return [$eventID, $oldPrice];
    }

    public function addCategories($categories)
    {

        foreach($categories as $category)
        {
            $category = $this->db->escape($category);
            $this->db->query("INSERT INTO `categories` (id, name) VALUES (null, '{$category}') ON DUPLICATE KEY UPDATE name=name");
        }

        return true;
    }

    public function addEvents($data)
    {

        foreach($data as $event)
        {
            $name = $this->db->escape($event['name']);
            $description = $this->db->escape($event['description']);
            $location = $this->db->escape($event['location']);
            $date = $this->db->escape($event['date']);
            $category = $this->db->escape($event['category']);
            $this->db->query("INSERT INTO `events` (id, name, description, location, `date`, category_id)
                VALUES ( null, '{$name}', '{$description}', '{$location}', '{$date}',
                (SELECT id FROM categories WHERE name = '{$category}'))"
            );
            foreach($event['tickets'] as $ticket)
            {
                $event_id = $this->db->lastID;
                $price = (float) $ticket['price'];
                $quantity = (int) $ticket['quantity'];
                $disscount = (float) $ticket['disscount'];
                if($disscount > $price) $disscount = $price;
                $this->db->query("INSERT INTO `tickets` (event_id, price , quantity, disscount) VALUES($event_id, $price, $quantity, $disscount) ON DUPLICATE KEY UPDATE event_id = event_id");
            }
        }

        return true;
    }
}
